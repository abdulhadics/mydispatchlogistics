<?php
// User Management API
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../functions/helpers_simple.php';

header('Content-Type: application/json');

// Require admin authentication
if (!isLoggedIn() || getUserInfo()['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $db = getDB();
    
    switch ($method) {
        case 'GET':
            handleGetUsers($db);
            break;
            
        case 'POST':
            handleCreateUser($db, $input);
            break;
            
        case 'PUT':
            handleUpdateUser($db, $input);
            break;
            
        case 'DELETE':
            handleDeleteUser($db, $_GET['id'] ?? null);
            break;
            
        default:
            throw new Exception('Method not allowed');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function handleGetUsers($db) {
    $id = $_GET['id'] ?? null;
    
    if ($id) {
        // Get single user
        $stmt = $db->prepare("SELECT id, name, email, role, phone, company, mc_number, status, created_at, last_login FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            throw new Exception('User not found');
        }
        
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        // Get all users
        $limit = $_GET['limit'] ?? 100;
        $offset = $_GET['offset'] ?? 0;
        
        $stmt = $db->prepare("SELECT id, name, email, role, phone, company, mc_number, status, created_at, last_login FROM users ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->execute([$limit, $offset]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get total count
        $countStmt = $db->query("SELECT COUNT(*) as total FROM users");
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        echo json_encode(['success' => true, 'users' => $users, 'total' => $total]);
    }
}

function handleCreateUser($db, $input) {
    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $role = $input['role'] ?? 'customer';
    $phone = $input['phone'] ?? '';
    $company = $input['company'] ?? '';
    $mc_number = $input['mc_number'] ?? '';
    $status = $input['status'] ?? 'pending';
    
    if (empty($name) || empty($email)) {
        throw new Exception('Name and email are required');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }
    
    // Check if user already exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        throw new Exception('User with this email already exists');
    }
    
    // Hash password if provided
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : password_hash('temp123', PASSWORD_DEFAULT);
    
    $stmt = $db->prepare("INSERT INTO users (name, email, password, role, phone, company, mc_number, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $result = $stmt->execute([$name, $email, $hashedPassword, $role, $phone, $company, $mc_number, $status]);
    
    if ($result) {
        $userId = $db->lastInsertId();
        echo json_encode(['success' => true, 'message' => 'User created successfully', 'user_id' => $userId]);
    } else {
        throw new Exception('Failed to create user');
    }
}

function handleUpdateUser($db, $input) {
    $id = $input['id'] ?? null;
    
    if (!$id) {
        throw new Exception('User ID is required');
    }
    
    // Check if user exists
    $stmt = $db->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$id]);
    if (!$stmt->fetch()) {
        throw new Exception('User not found');
    }
    
    $updates = [];
    $params = [];
    
    if (isset($input['name'])) {
        $updates[] = "name = ?";
        $params[] = $input['name'];
    }
    
    if (isset($input['email'])) {
        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }
        $updates[] = "email = ?";
        $params[] = $input['email'];
    }
    
    if (isset($input['password']) && !empty($input['password'])) {
        $updates[] = "password = ?";
        $params[] = password_hash($input['password'], PASSWORD_DEFAULT);
    }
    
    if (isset($input['role'])) {
        $updates[] = "role = ?";
        $params[] = $input['role'];
    }
    
    if (isset($input['phone'])) {
        $updates[] = "phone = ?";
        $params[] = $input['phone'];
    }
    
    if (isset($input['company'])) {
        $updates[] = "company = ?";
        $params[] = $input['company'];
    }
    
    if (isset($input['mc_number'])) {
        $updates[] = "mc_number = ?";
        $params[] = $input['mc_number'];
    }
    
    if (isset($input['status'])) {
        $updates[] = "status = ?";
        $params[] = $input['status'];
    }
    
    if (empty($updates)) {
        throw new Exception('No fields to update');
    }
    
    $updates[] = "updated_at = NOW()";
    $params[] = $id;
    
    $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute($params);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } else {
        throw new Exception('Failed to update user');
    }
}

function handleDeleteUser($db, $id) {
    if (!$id) {
        throw new Exception('User ID is required');
    }
    
    // Don't allow deleting yourself
    if ($id == $_SESSION['user_id']) {
        throw new Exception('Cannot delete your own account');
    }
    
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $result = $stmt->execute([$id]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
    } else {
        throw new Exception('Failed to delete user');
    }
}
?>

