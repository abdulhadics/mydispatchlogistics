<?php
// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: ' . APP_URL);
    exit();
}

$page_title = 'Sign Up - MyDispatch';
$page_description = 'Create your MyDispatch account to start managing your logistics operations.';
$body_class = 'signup-page';

include 'includes/header.php';
?>

<div class="signup-container">
    <div class="signup-card">
        <!-- Logo and Header -->
        <div class="signup-header">
            <div class="signup-logo">
                <div class="logo-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
            <h1 class="signup-title">Create Account</h1>
            <p class="signup-subtitle">Join MyDispatch and start your logistics journey</p>
        </div>

        <!-- Signup Form -->
        <form id="signupForm" class="signup-form" method="POST" action="/functions/auth.php">
            <input type="hidden" name="action" value="signup">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                </div>
            <?php endif; ?>
            
            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input" 
                        placeholder="Enter your full name"
                        value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                        required
                        autocomplete="name"
                    >
                </div>
                <div class="form-error"></div>
            </div>

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
                <div class="form-error"></div>
            </div>

            <!-- Phone Field -->
            <div class="form-group">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="form-input" 
                        placeholder="Enter your phone number"
                        value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                        autocomplete="tel"
                    >
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <label for="role" class="form-label">Account Type</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <select id="role" name="role" class="form-input" required>
                        <option value="">Select account type</option>
                        <option value="driver" <?php echo (($_POST['role'] ?? '') === 'driver') ? 'selected' : ''; ?>>Driver/Owner Operator</option>
                        <option value="customer" <?php echo (($_POST['role'] ?? '') === 'customer') ? 'selected' : ''; ?>>Customer/Shipper</option>
                    </select>
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Company Field (conditional) -->
            <div class="form-group" id="companyGroup" style="display: none;">
                <label for="company" class="form-label">Company Name</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <input 
                        type="text" 
                        id="company" 
                        name="company" 
                        class="form-input" 
                        placeholder="Enter your company name"
                        value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>"
                    >
                </div>
                <div class="form-error"></div>
            </div>

            <!-- MC Number (for drivers) -->
            <div class="form-group" id="mcNumberGroup" style="display: none;">
                <label for="mc_number" class="form-label">MC Number</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <input 
                        type="text" 
                        id="mc_number" 
                        name="mc_number" 
                        class="form-input" 
                        placeholder="Enter your MC number"
                        value="<?php echo htmlspecialchars($_POST['mc_number'] ?? ''); ?>"
                    >
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
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Create a password"
                        required
                        autocomplete="new-password"
                    >
                    <button 
                        type="button" 
                        class="password-toggle" 
                        onclick="togglePasswordVisibility('password')"
                    >
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input" 
                        placeholder="Confirm your password"
                        required
                        autocomplete="new-password"
                    >
                    <button 
                        type="button" 
                        class="password-toggle" 
                        onclick="togglePasswordVisibility('password_confirmation')"
                    >
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-group">
                <div class="checkbox-group">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms" 
                        class="checkbox"
                        required
                    >
                    <label for="terms" class="checkbox-label">
                        I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>
                    </label>
                </div>
                <div class="form-error"></div>
            </div>

            <!-- Signup Button -->
            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus"></i>
                Create Account
            </button>

            <!-- Login Link -->
            <div class="signup-footer">
                <p>Already have an account? 
                    <a href="?page=login" class="login-link">Sign in here</a>
                </p>
            </div>
        </form>
    </div>
</div>

<style>
.signup-page {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding: 2rem 0;
}

.signup-page::before {
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

.signup-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 500px;
    padding: 2rem;
}

.signup-card {
    background: rgba(23, 23, 23, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 24px;
    padding: 3rem 2rem;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.signup-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.signup-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.signup-logo .logo-icon {
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

.signup-title {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.signup-subtitle {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.signup-form {
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
    padding-left: 48px;
    padding-right: 48px;
    width: 100%;
}

.password-toggle {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #737373;
    cursor: pointer;
    padding: 4px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #a855f7;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.checkbox {
    width: 16px;
    height: 16px;
    accent-color: #a855f7;
    margin-top: 2px;
}

.checkbox-label {
    color: #a3a3a3;
    font-size: 0.875rem;
    cursor: pointer;
    line-height: 1.4;
}

.terms-link {
    color: #a855f7;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.terms-link:hover {
    color: #c084fc;
}

.btn-full {
    width: 100%;
    padding: 16px;
    font-size: 1.125rem;
    margin-top: 1rem;
}

.signup-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

.signup-footer p {
    color: #a3a3a3;
    margin: 0;
}

.login-link {
    color: #a855f7;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: #c084fc;
}

@media (max-width: 480px) {
    .signup-container {
        padding: 1rem;
    }
    
    .signup-card {
        padding: 2rem 1.5rem;
    }
    
    .signup-title {
        font-size: 2rem;
    }
    
    .signup-logo .logo-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>

<script>
// Show/hide conditional fields based on role selection
document.getElementById('role').addEventListener('change', function() {
    const role = this.value;
    const companyGroup = document.getElementById('companyGroup');
    const mcNumberGroup = document.getElementById('mcNumberGroup');
    
    if (role === 'driver') {
        companyGroup.style.display = 'block';
        mcNumberGroup.style.display = 'block';
    } else if (role === 'customer') {
        companyGroup.style.display = 'block';
        mcNumberGroup.style.display = 'none';
    } else {
        companyGroup.style.display = 'none';
        mcNumberGroup.style.display = 'none';
    }
});

// Password confirmation validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;
    const errorElement = this.parentNode.parentNode.querySelector('.form-error');
    
    if (confirmation && password !== confirmation) {
        errorElement.textContent = 'Passwords do not match';
        this.classList.add('error');
    } else {
        errorElement.textContent = '';
        this.classList.remove('error');
    }
});
</script>

<?php include 'includes/footer.php'; ?>
