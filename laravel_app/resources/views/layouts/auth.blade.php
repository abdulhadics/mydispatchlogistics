<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyDispatch')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0a0a0a;
            height: 100vh;
            overflow: hidden;
        }

        .auth-layout {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* Left Side - Brand/Visual */
        .auth-brand {
            flex: 1;
            background: linear-gradient(135deg, #0f0f10 0%, #1a1a1c 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4rem;
            overflow: hidden;
        }

        .auth-brand::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(20, 184, 166, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 2rem;
        }

        .brand-logo i {
            color: #8b5cf6;
            font-size: 2rem;
        }

        .brand-hero-text h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #fff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-hero-text p {
            font-size: 1.25rem;
            color: #9ca3af;
            max-width: 500px;
        }

        /* Right Side - Form */
        .auth-form-container {
            width: 100%;
            max-width: 600px;
            background: #0a0a0a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 4rem;
            border-left: 1px solid rgba(255, 255, 255, 0.05);
            overflow-y: auto;
            position: relative;
            z-index: 10;
        }

        .auth-header {
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: #6b7280;
        }

        /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .auth-brand {
                display: none;
            }

            .auth-form-container {
                max-width: 100%;
                border-left: none;
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-layout">
        <!-- Left Side -->
        <div class="auth-brand">
            <div class="brand-content">
                <div class="brand-logo">
                    <i class="fas fa-truck-fast"></i>
                    MyDispatch
                </div>
                <div class="brand-hero-text">
                    <h1>Streamline Your<br>Logistics Operations</h1>
                    <p>Join thousands of carriers and shippers managing their fleet with our advanced dispatching
                        platform.</p>
                </div>
            </div>

            <!-- Abstract Visual Element -->
            <div
                style="position: absolute; bottom: -10%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139,92,246,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;">
            </div>
        </div>

        <!-- Right Side -->
        <div class="auth-form-container">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>