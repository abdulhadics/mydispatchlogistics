<nav class="navbar">
    <div class="container">
        <div class="navbar-content">
            <!-- Logo -->
            <a href="?page=home" class="navbar-logo">
                <div class="logo-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <span class="logo-text">MyDispatch</span>
            </a>
            
            <!-- Desktop Navigation -->
            <div class="navbar-nav desktop-nav">
                <a href="?page=home" class="nav-link <?php echo ($page ?? '') === 'home' ? 'active' : ''; ?>">Home</a>
                <a href="?page=services" class="nav-link <?php echo ($page ?? '') === 'services' ? 'active' : ''; ?>">Services</a>
                <a href="?page=pricing" class="nav-link <?php echo ($page ?? '') === 'pricing' ? 'active' : ''; ?>">Pricing</a>
                <a href="?page=tracking" class="nav-link <?php echo ($page ?? '') === 'tracking' ? 'active' : ''; ?>">Tracking</a>
                <a href="?page=carrier-setup" class="nav-link <?php echo ($page ?? '') === 'carrier-setup' ? 'active' : ''; ?>">Carrier Setup</a>
                <a href="?page=contact" class="nav-link <?php echo ($page ?? '') === 'contact' ? 'active' : ''; ?>">Contact</a>
            </div>
            
            <!-- User Actions -->
            <div class="navbar-actions">
                <a href="?page=login" class="btn btn-outline">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
                <a href="?page=signup" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Sign Up
                </a>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="mobile-nav" id="mobileNav">
            <a href="?page=home" class="mobile-nav-link <?php echo ($page ?? '') === 'home' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                Home
            </a>
            <a href="?page=services" class="mobile-nav-link <?php echo ($page ?? '') === 'services' ? 'active' : ''; ?>">
                <i class="fas fa-cogs"></i>
                Services
            </a>
            <a href="?page=pricing" class="mobile-nav-link <?php echo ($page ?? '') === 'pricing' ? 'active' : ''; ?>">
                <i class="fas fa-dollar-sign"></i>
                Pricing
            </a>
            <a href="?page=tracking" class="mobile-nav-link <?php echo ($page ?? '') === 'tracking' ? 'active' : ''; ?>">
                <i class="fas fa-map-marked-alt"></i>
                Tracking
            </a>
            <a href="?page=carrier-setup" class="mobile-nav-link <?php echo ($page ?? '') === 'carrier-setup' ? 'active' : ''; ?>">
                <i class="fas fa-truck"></i>
                Carrier Setup
            </a>
            <a href="?page=contact" class="mobile-nav-link <?php echo ($page ?? '') === 'contact' ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i>
                Contact
            </a>
            <div class="mobile-nav-actions">
                <a href="?page=login" class="btn btn-outline btn-block">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
                <a href="?page=signup" class="btn btn-primary btn-block">
                    <i class="fas fa-user-plus"></i>
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    mobileNav.classList.toggle('active');
}
</script>
