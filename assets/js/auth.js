// Authentication JavaScript functionality

// Login form handling
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', handleSignup);
    }
    
    const logoutLinks = document.querySelectorAll('a[href*="logout"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', handleLogout);
    });
});

// Handle login form submission
async function handleLogin(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const email = form.querySelector('input[name="email"]').value;
    const password = form.querySelector('input[name="password"]').value;
    const rememberMe = form.querySelector('input[name="remember_me"]')?.checked || false;
    
    // Validate form
    if (!validateForm(form)) {
        return;
    }
    
    // Show loading state
    setButtonLoading(submitButton, true);
    
    try {
        const response = await makeRequest('functions/auth.php', {
            method: 'POST',
            body: JSON.stringify({
                action: 'login',
                email: email,
                password: password,
                remember_me: rememberMe
            })
        });
        
        if (response.success) {
            showAlert('Login successful! Redirecting...', 'success');
            
            // Redirect based on user role
            setTimeout(() => {
                const redirectPath = getRedirectPath(response.user.role);
                window.location.href = redirectPath;
            }, 1500);
        } else {
            showAlert(response.message || 'Login failed', 'error');
        }
    } catch (error) {
        showAlert('Login failed. Please try again.', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

// Handle signup form submission
async function handleSignup(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    // Validate form
    if (!validateForm(form)) {
        return;
    }
    
    // Check password confirmation
    if (data.password !== data.password_confirmation) {
        showAlert('Passwords do not match', 'error');
        return;
    }
    
    // Show loading state
    setButtonLoading(submitButton, true);
    
    try {
        const response = await makeRequest('functions/auth.php', {
            method: 'POST',
            body: JSON.stringify({
                action: 'signup',
                ...data
            })
        });
        
        if (response.success) {
            showAlert('Account created successfully! Please log in.', 'success');
            form.reset();
            
            // Redirect to login page
            setTimeout(() => {
                window.location.href = '?page=login';
            }, 2000);
        } else {
            showAlert(response.message || 'Signup failed', 'error');
        }
    } catch (error) {
        showAlert('Signup failed. Please try again.', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

// Handle logout
async function handleLogout(event) {
    event.preventDefault();
    
    if (confirm('Are you sure you want to sign out?')) {
        try {
            await makeRequest('functions/logout.php', {
                method: 'POST'
            });
            
            showAlert('Signed out successfully', 'success');
            window.location.href = '?page=home';
        } catch (error) {
            // Even if request fails, redirect to home
            window.location.href = '?page=home';
        }
    }
}

// Get redirect path based on user role
function getRedirectPath(role) {
    const baseUrl = window.location.origin + window.location.pathname;
    
    switch (role) {
        case 'admin':
            return `${baseUrl}?page=admin`;
        case 'driver':
            return `${baseUrl}?page=dashboard`;
        case 'customer':
            return `${baseUrl}?page=dashboard`;
        default:
            return `${baseUrl}?page=home`;
    }
}

// Check authentication status
async function checkAuthStatus() {
    try {
        const response = await makeRequest('functions/auth.php?action=check');
        
        if (response.authenticated) {
            // Update UI for authenticated user
            updateAuthUI(response.user);
        } else {
            // Update UI for guest user
            updateGuestUI();
        }
    } catch (error) {
        console.error('Auth check failed:', error);
        updateGuestUI();
    }
}

// Update UI for authenticated user
function updateAuthUI(user) {
    // Update user name in navigation
    const userNameElements = document.querySelectorAll('.user-name');
    userNameElements.forEach(el => {
        el.textContent = `Welcome, ${user.name}`;
    });
    
    // Show/hide authenticated elements
    const authElements = document.querySelectorAll('.auth-required');
    authElements.forEach(el => {
        el.style.display = 'block';
    });
    
    const guestElements = document.querySelectorAll('.guest-required');
    guestElements.forEach(el => {
        el.style.display = 'none';
    });
    
    // Update role-specific elements
    if (user.role === 'admin') {
        const adminElements = document.querySelectorAll('.admin-required');
        adminElements.forEach(el => {
            el.style.display = 'block';
        });
    }
    
    if (user.role === 'driver') {
        const driverElements = document.querySelectorAll('.driver-required');
        driverElements.forEach(el => {
            el.style.display = 'block';
        });
    }
    
    if (user.role === 'customer') {
        const customerElements = document.querySelectorAll('.customer-required');
        customerElements.forEach(el => {
            el.style.display = 'block';
        });
    }
}

// Update UI for guest user
function updateGuestUI() {
    // Show/hide guest elements
    const authElements = document.querySelectorAll('.auth-required');
    authElements.forEach(el => {
        el.style.display = 'none';
    });
    
    const guestElements = document.querySelectorAll('.guest-required');
    guestElements.forEach(el => {
        el.style.display = 'block';
    });
    
    // Hide role-specific elements
    const roleElements = document.querySelectorAll('.admin-required, .driver-required, .customer-required');
    roleElements.forEach(el => {
        el.style.display = 'none';
    });
}

// Require authentication for protected pages
function requireAuth() {
    checkAuthStatus().then(response => {
        if (!response || !response.authenticated) {
            window.location.href = '?page=login';
        }
    });
}

// Require admin role
function requireAdmin() {
    checkAuthStatus().then(response => {
        if (!response || !response.authenticated || response.user.role !== 'admin') {
            window.location.href = '?page=403';
        }
    });
}

// Session timeout warning
function initSessionTimeout() {
    const timeout = 30 * 60 * 1000; // 30 minutes
    let timeoutWarning;
    
    function resetTimeout() {
        clearTimeout(timeoutWarning);
        timeoutWarning = setTimeout(() => {
            showAlert('Your session will expire in 5 minutes. Click to extend.', 'warning', 300000);
        }, timeout - 5 * 60 * 1000);
    }
    
    // Reset timeout on user activity
    ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
        document.addEventListener(event, resetTimeout, true);
    });
    
    resetTimeout();
}

// Initialize authentication features
document.addEventListener('DOMContentLoaded', function() {
    // Check auth status on page load
    checkAuthStatus();
    
    // Initialize session timeout for authenticated users
    if (document.body.classList.contains('authenticated')) {
        initSessionTimeout();
    }
    
    // Auto-focus login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        const emailInput = loginForm.querySelector('input[name="email"]');
        if (emailInput) {
            emailInput.focus();
        }
    }
});

// Export functions for global use
window.checkAuthStatus = checkAuthStatus;
window.requireAuth = requireAuth;
window.requireAdmin = requireAdmin;
window.handleLogin = handleLogin;
window.handleSignup = handleSignup;
window.handleLogout = handleLogout;
