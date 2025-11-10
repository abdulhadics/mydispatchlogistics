<?php
// Authentication handler
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/helpers_simple.php';

// Determine if this is a form submission or JSON API call
$isFormSubmission = !empty($_POST);
$isJsonRequest = !empty($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($isFormSubmission) {
        header('Location: ' . APP_URL . '/?page=signup&error=' . urlencode('Method not allowed'));
    } else {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    }
    exit();
}

// Get input data from either form POST or JSON
if ($isFormSubmission) {
    $input = $_POST;
    // For form submissions, we'll redirect instead of returning JSON
} else {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
}

$action = $input['action'] ?? '';

try {
    $db = getDB();
    
    switch ($action) {
        case 'login':
            handleLogin($db, $input, $isFormSubmission);
            break;
            
        case 'signup':
            handleSignup($db, $input, $isFormSubmission);
            break;
            
        case 'logout':
            handleLogout($isFormSubmission);
            break;
            
        case 'check':
            checkAuthStatus();
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    if ($isFormSubmission) {
        $errorPage = ($action === 'login') ? 'login' : 'signup';
        header('Location: ' . APP_URL . '/?page=' . $errorPage . '&error=' . urlencode($e->getMessage()));
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}

function handleLogin($db, $input, $isFormSubmission = false) {
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $rememberMe = isset($input['remember_me']) && ($input['remember_me'] === 'on' || $input['remember_me'] === true || $input['remember_me'] === '1');
    
    if (empty($email) || empty($password)) {
        throw new Exception('Email and password are required');
    }
    
    // Try database first
    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Update last login
            $stmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);
            
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['login_time'] = time();
            
            // Set remember me cookie if requested
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
            }
            
            if ($isFormSubmission) {
                // Redirect based on role
                $redirect = ($user['role'] === 'admin') ? 'admin' : 'dashboard';
                header('Location: ' . APP_URL . '/?page=' . $redirect);
                exit();
            } else {
                echo json_encode([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ]
                ]);
            }
            return;
        }
    } catch (Exception $e) {
        // Fall through to demo users if database fails
    }
    
    // Fallback to demo users for development
    $demoUsers = [
        'admin@logistics.com' => [
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@logistics.com',
            'password' => 'admin123',
            'role' => 'admin'
        ],
        'driver@example.com' => [
            'id' => 2,
            'name' => 'John Driver',
            'email' => 'driver@example.com',
            'password' => 'driver123',
            'role' => 'driver'
        ],
        'customer@example.com' => [
            'id' => 3,
            'name' => 'Jane Customer',
            'email' => 'customer@example.com',
            'password' => 'customer123',
            'role' => 'customer'
        ]
    ];
    
    if (isset($demoUsers[$email]) && $demoUsers[$email]['password'] === $password) {
        $user = $demoUsers[$email];
        
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['login_time'] = time();
        
        if ($isFormSubmission) {
            $redirect = ($user['role'] === 'admin') ? 'admin' : 'dashboard';
            header('Location: ' . APP_URL . '/?page=' . $redirect);
            exit();
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]
            ]);
        }
        return;
    }
    
    throw new Exception('Invalid email or password');
}

function handleSignup($db, $input, $isFormSubmission = false) {
    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $password_confirmation = $input['password_confirmation'] ?? '';
    $role = $input['role'] ?? 'customer';
    $phone = $input['phone'] ?? '';
    $company = $input['company'] ?? '';
    $mc_number = $input['mc_number'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        throw new Exception('All required fields must be filled');
    }
    
    if ($password !== $password_confirmation) {
        throw new Exception('Passwords do not match');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }
    
    if (strlen($password) < 6) {
        throw new Exception('Password must be at least 6 characters');
    }
    
    // Check if user already exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        throw new Exception('User with this email already exists');
    }
    
    // Create new user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $db->prepare("INSERT INTO users (name, email, password, role, phone, company, mc_number, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())");
    $result = $stmt->execute([$name, $email, $hashedPassword, $role, $phone, $company, $mc_number]);
    
    if ($result) {
        // Auto-login the user
        $userId = $db->lastInsertId();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $role;
        $_SESSION['login_time'] = time();
        
        if ($isFormSubmission) {
            header('Location: ' . APP_URL . '/?page=dashboard&success=' . urlencode('Account created successfully!'));
            exit();
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Account created successfully',
                'user' => [
                    'id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'role' => $role
                ]
            ]);
        }
    } else {
        throw new Exception('Failed to create account');
    }
}

function handleLogout($isFormSubmission = false) {
    // Clear session
    $_SESSION = [];
    session_destroy();
    
    // Clear remember me cookie
    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    
    if ($isFormSubmission) {
        header('Location: ' . APP_URL . '/?page=home');
        exit();
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}

function checkAuthStatus() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $authenticated = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    
    if ($authenticated) {
        echo json_encode([
            'authenticated' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role']
            ]
        ]);
    } else {
        echo json_encode([
            'authenticated' => false
        ]);
    }
}
?>