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
                <a href="?page=fleet" class="nav-link <?php echo ($page ?? '') === 'fleet' ? 'active' : ''; ?>">Fleet</a>
                <a href="?page=tracking" class="nav-link <?php echo ($page ?? '') === 'tracking' ? 'active' : ''; ?>">Tracking</a>
                <a href="?page=about" class="nav-link <?php echo ($page ?? '') === 'about' ? 'active' : ''; ?>">About</a>
                <a href="?page=carrier-setup" class="nav-link <?php echo ($page ?? '') === 'carrier-setup' ? 'active' : ''; ?>">Carrier Setup</a>
                <a href="?page=blog" class="nav-link <?php echo ($page ?? '') === 'blog' ? 'active' : ''; ?>">Blog</a>
                <a href="?page=contact" class="nav-link <?php echo ($page ?? '') === 'contact' ? 'active' : ''; ?>">Contact</a>
            </div>
            
            <!-- User Actions -->
            <div class="navbar-actions">
                <?php if (isLoggedIn()): ?>
                    <!-- User Menu -->
                    <div class="user-menu">
                        <div class="user-info">
                            <span class="user-name">Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                            <div class="user-dropdown">
                                <button class="user-dropdown-toggle">
                                    <i class="fas fa-user-circle"></i>
                                    <span>Account</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="user-dropdown-menu">
                                    <?php if (isDriver()): ?>
                                        <a href="?page=dashboard" class="dropdown-link">
                                            <i class="fas fa-tachometer-alt"></i>
                                            Driver Dashboard
                                        </a>
                                    <?php elseif (isCustomer()): ?>
                                        <a href="?page=dashboard" class="dropdown-link">
                                            <i class="fas fa-tachometer-alt"></i>
                                            Customer Dashboard
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if (isAdmin()): ?>
                                        <a href="?page=admin" class="dropdown-link">
                                            <i class="fas fa-cog"></i>
                                            Admin Panel
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="?page=profile" class="dropdown-link">
                                        <i class="fas fa-user"></i>
                                        Profile
                                    </a>
                                    
                                    <hr class="dropdown-divider">
                                    
                                    <a href="?page=logout" class="dropdown-link logout">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Sign Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Guest Actions -->
                    <div class="guest-actions">
                        <a href="?page=login" class="btn btn-outline">Sign In</a>
                        <a href="?page=signup" class="btn btn-primary">Sign Up</a>
                    </div>
                <?php endif; ?>
                
                <!-- CTA Button -->
                <a href="?page=contact" class="btn btn-cta">
                    <i class="fas fa-phone"></i>
                    Get Quote
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-content">
                <a href="?page=home" class="mobile-nav-link <?php echo ($page ?? '') === 'home' ? 'active' : ''; ?>">Home</a>
                <a href="?page=services" class="mobile-nav-link <?php echo ($page ?? '') === 'services' ? 'active' : ''; ?>">Services</a>
                <a href="?page=pricing" class="mobile-nav-link <?php echo ($page ?? '') === 'pricing' ? 'active' : ''; ?>">Pricing</a>
                <a href="?page=fleet" class="mobile-nav-link <?php echo ($page ?? '') === 'fleet' ? 'active' : ''; ?>">Fleet</a>
                <a href="?page=tracking" class="mobile-nav-link <?php echo ($page ?? '') === 'tracking' ? 'active' : ''; ?>">Tracking</a>
                <a href="?page=about" class="mobile-nav-link <?php echo ($page ?? '') === 'about' ? 'active' : ''; ?>">About</a>
                <a href="?page=carrier-setup" class="mobile-nav-link <?php echo ($page ?? '') === 'carrier-setup' ? 'active' : ''; ?>">Carrier Setup</a>
                <a href="?page=blog" class="mobile-nav-link <?php echo ($page ?? '') === 'blog' ? 'active' : ''; ?>">Blog</a>
                <a href="?page=contact" class="mobile-nav-link <?php echo ($page ?? '') === 'contact' ? 'active' : ''; ?>">Contact</a>
                
                <div class="mobile-actions">
                    <?php if (isLoggedIn()): ?>
                        <a href="?page=dashboard" class="btn btn-outline">Dashboard</a>
                        <?php if (isAdmin()): ?>
                            <a href="?page=admin" class="btn btn-secondary">Admin Panel</a>
                        <?php endif; ?>
                        <a href="?page=logout" class="btn btn-danger">Sign Out</a>
                    <?php else: ?>
                        <a href="?page=login" class="btn btn-outline">Sign In</a>
                        <a href="?page=signup" class="btn btn-primary">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
