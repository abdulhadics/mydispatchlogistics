<?php
// Redirect if already logged in
if (isLoggedIn()) {
    $user = getUserInfo();
    $redirectPath = '?page=home';

    if ($user['role'] === 'admin') {
        $redirectPath = '?page=admin';
    } elseif ($user['role'] === 'driver') {
        $redirectPath = '?page=dashboard';
    } elseif ($user['role'] === 'customer') {
        $redirectPath = '?page=dashboard';
    }

    header('Location: ' . APP_URL . '/' . $redirectPath);
    exit();
}

$page_title = 'Sign In - MyDispatch';
$page_description = 'Sign in to your MyDispatch account to access your dashboard and manage your logistics operations.';
$body_class = 'login-page';

include 'includes/header.php';
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
        <form id="loginForm" class="login-form" method="POST" action="/functions/auth.php">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">


            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo htmlspecialchars($_GET['success']); ?></span>
                </div>
            <?php endif; ?>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required autocomplete="email">
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" id="password" name="password" class="form-input"
                        placeholder="Enter your password" required autocomplete="current-password">
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="form-options">
                <div class="checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me" class="checkbox">
                    <label for="remember_me" class="checkbox-label">Remember me</label>
                </div>

                <a href="?page=forgot-password" class="forgot-password">
                    Forgot your password?
                </a>
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



<?php include 'includes/footer.php'; ?>