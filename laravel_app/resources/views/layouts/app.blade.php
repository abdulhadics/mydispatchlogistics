<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Professional truck dispatch and logistics services')">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
</head>

<body class="@yield('body_class')">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>

    <!-- CSRF Token -->
    <script>
        window.csrfToken = '{{ csrf_token() }}';

        // Notification functions
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('active');
            if (dropdown.classList.contains('active')) {
                fetchNotifications();
            }
        }

        function fetchNotifications() {
            fetch('{{ route("notifications.unread") }}')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('notificationBadge');
                    const list = document.getElementById('notificationList');

                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }

                    if (data.notifications.length === 0) {
                        list.innerHTML = '<div class="notification-empty">No new notifications</div>';
                    } else {
                        list.innerHTML = data.notifications.map(n => `
                            <div class="notification-item unread" onclick="markAsRead(${n.id}, '${n.action_url || ''}')">
                                <div class="notification-icon ${n.type}">
                                    <i class="fas ${n.icon}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">${n.title}</div>
                                    <div class="notification-message">${n.message}</div>
                                </div>
                            </div>
                        `).join('');
                    }
                })
                .catch(err => console.log('Notifications not available'));
        }

        function markAsRead(id, url) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                if (url) window.location.href = url;
                else fetchNotifications();
            });
        }

        function markAllAsRead() {
            fetch('{{ route("notifications.markAllRead") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(() => fetchNotifications());
        }

        // Toast notification helper
        function showToast(message, type = 'info') {
            let container = document.querySelector('.toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            const icons = { success: 'fa-check', error: 'fa-times', warning: 'fa-exclamation', info: 'fa-info' };
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `<i class="fas ${icons[type]} toast-icon"></i><span class="toast-message">${message}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 5000);
        }

        // Poll for new notifications every 30 seconds
        @auth
            setInterval(fetchNotifications, 30000);
            document.addEventListener('DOMContentLoaded', fetchNotifications);
        @endauth

        // Close notification dropdown when clicking outside
        document.addEventListener('click', function (e) {
            const bell = document.getElementById('notificationBell');
            const dropdown = document.getElementById('notificationDropdown');
            if (bell && dropdown && !bell.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>