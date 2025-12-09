<?php
// Demo login page that works without database
$page_title = 'Sign In - MyDispatch';
$page_description = 'Sign in to your MyDispatch account to access your dashboard and manage your logistics operations.';
$body_class = 'login-page';

// Handle demo login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Demo credentials
    $demoUsers = [
        'admin@logistics.com' => ['password' => 'admin123', 'role' => 'admin', 'name' => 'Admin User'],
        'driver@example.com' => ['password' => 'driver123', 'role' => 'driver', 'name' => 'John Driver'],
        'customer@example.com' => ['password' => 'customer123', 'role' => 'customer', 'name' => 'Jane Customer']
    ];
    
    if (isset($demoUsers[$email]) && $demoUsers[$email]['password'] === $password) {
        $user = $demoUsers[$email];
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $user['role'];
        
        header('Location: ' . APP_URL . '/?page=home');
        exit();
    } else {
        $error_message = 'Invalid email or password';
    }
}

include 'includes/header_demo.php';
?>

<div class="login-container">
    <div class="login-card">
        <!-- Logo and Header -->
        <div class="login-header">
            <div class="login-logo">
                <div class="logo-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to your MyDispatch account</p>
        </div>

        <!-- Login Form -->
        <form method="POST" class="login-form">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>
            
            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Enter your email"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        required
                        autocomplete="email"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-sign-in-alt"></i>
                Sign In
            </button>

            <!-- Sign Up Link -->
            <div class="login-footer">
                <p>Don't have an account? 
                    <a href="?page=signup" class="signup-link">Sign up here</a>
                </p>
            </div>
        </form>
        
        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <h3>Demo Credentials</h3>
            <div class="demo-account">
                <strong>Admin:</strong> admin@logistics.com / admin123
            </div>
            <div class="demo-account">
                <strong>Driver:</strong> driver@example.com / driver123
            </div>
            <div class="demo-account">
                <strong>Customer:</strong> customer@example.com / customer123
            </div>
        </div>
    </div>
</div>

<style>
.login-page {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.login-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.05) 0%, transparent 40%);
    pointer-events: none;
}

.login-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 450px;
    padding: 2rem;
}

.login-card {
    background: rgba(23, 23, 23, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 24px;
    padding: 3rem 2rem;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.login-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.login-logo .logo-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
}

.login-title {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.login-subtitle {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.input-group {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #737373;
    z-index: 2;
}

.form-input {
    width: 100%;
    padding: 12px 16px 12px 48px;
    background: rgba(23, 23, 23, 0.8);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 8px;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #a855f7;
    box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.form-input::placeholder {
    color: #737373;
}

.btn-full {
    width: 100%;
    padding: 16px;
    font-size: 1.125rem;
    margin-top: 1rem;
}

.login-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

.login-footer p {
    color: #a3a3a3;
    margin: 0;
}

.signup-link {
    color: #a855f7;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.signup-link:hover {
    color: #c084fc;
}

.demo-credentials {
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(38, 38, 38, 0.5);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 12px;
}

.demo-credentials h3 {
    color: #a855f7;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.demo-account {
    color: #a3a3a3;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    background: rgba(10, 10, 10, 0.5);
    border-radius: 6px;
    font-family: 'Courier New', monospace;
}

.demo-account:last-child {
    margin-bottom: 0;
}

.demo-account strong {
    color: #e5e5e5;
}

@media (max-width: 480px) {
    .login-container {
        padding: 1rem;
    }
    
    .login-card {
        padding: 2rem 1.5rem;
    }
    
    .login-title {
        font-size: 2rem;
    }
    
    .login-logo .logo-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
