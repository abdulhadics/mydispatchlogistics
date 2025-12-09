<nav class="navbar">
    <div class="container navbar-content">
        <a href="{{ route('home') }}" class="navbar-logo">
            <div class="logo-icon">
                <i class="fas fa-truck-fast"></i>
            </div>
            <span class="logo-text">MyDispatch</span>
        </a>

        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services') }}"
                class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('pricing') }}"
                class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
            <a href="{{ route('fleet') }}" class="nav-link {{ request()->routeIs('fleet') ? 'active' : '' }}">Fleet</a>
            <a href="{{ route('tracking') }}"
                class="nav-link {{ request()->routeIs('tracking') ? 'active' : '' }}">Tracking</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('carrier-setup') }}"
                class="nav-link {{ request()->routeIs('carrier-setup') ? 'active' : '' }}">Carrier Setup</a>
            <a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('contact') }}"
                class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        <div class="navbar-actions">
            @auth
                <!-- Notification Bell -->
                <div class="notification-bell" id="notificationBell">
                    <button class="notification-toggle" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                    </button>
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <h4>Notifications</h4>
                            <button onclick="markAllAsRead()" class="mark-all-read">Mark all read</button>
                        </div>
                        <div class="notification-list" id="notificationList">
                            <div class="notification-empty">No new notifications</div>
                        </div>
                        <a href="{{ route('notifications.index') }}" class="notification-view-all">View All
                            Notifications</a>
                    </div>
                </div>

                <div class="user-menu user-dropdown">
                    <button class="user-dropdown-toggle">
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="role-badge role-{{ Auth::user()->role }}">{{ ucfirst(Auth::user()->role) }}</span>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-dropdown-menu">
                        <a href="{{ route('dashboard') }}" class="dropdown-link">
                            <i class="fas fa-gauge-high"></i> Dashboard
                        </a>
                        <a href="#" class="dropdown-link">
                            <i class="fas fa-user-gear"></i> Profile
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.users') }}" class="dropdown-link">
                                <i class="fas fa-users-cog"></i> Manage Users
                            </a>
                            <a href="{{ route('admin.categories') }}" class="dropdown-link">
                                <i class="fas fa-folder-plus"></i> Categories
                            </a>
                            <a href="{{ route('admin.rules') }}" class="dropdown-link">
                                <i class="fas fa-gavel"></i> Rules
                            </a>
                        @endif
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-link logout">
                                <i class="fas fa-right-from-bracket"></i> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="guest-actions user-dropdown">
                    <button class="btn btn-primary user-dropdown-toggle">
                        Get Started <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div class="user-dropdown-menu">
                        <a href="{{ route('login') }}" class="dropdown-link">
                            <i class="fas fa-right-to-bracket"></i> Sign In
                        </a>
                        <a href="{{ route('signup') }}" class="dropdown-link">
                            <i class="fas fa-user-plus"></i> Sign Up
                        </a>
                        <hr class="dropdown-divider">
                        <a href="{{ route('contact') }}" class="dropdown-link">
                            <i class="fas fa-phone"></i> Get Quote
                        </a>
                    </div>
                </div>
            @endauth

            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>

<div class="mobile-nav" id="mobileNav">
    <div class="container mobile-nav-content">
        <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('services') }}"
            class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
        <a href="{{ route('pricing') }}"
            class="mobile-nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
        <a href="{{ route('fleet') }}"
            class="mobile-nav-link {{ request()->routeIs('fleet') ? 'active' : '' }}">Fleet</a>
        <a href="{{ route('tracking') }}"
            class="mobile-nav-link {{ request()->routeIs('tracking') ? 'active' : '' }}">Tracking</a>
        <a href="{{ route('about') }}"
            class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('carrier-setup') }}"
            class="mobile-nav-link {{ request()->routeIs('carrier-setup') ? 'active' : '' }}">Carrier Setup</a>
        <a href="{{ route('blog') }}" class="mobile-nav-link {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('contact') }}"
            class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

        <div class="mobile-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline w-full">Sign Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                <a href="{{ route('signup') }}" class="btn btn-primary">Sign Up</a>
                <a href="{{ route('contact') }}" class="btn btn-cta">Get Quote</a>
            @endauth
        </div>
    </div>
</div>