<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.login_title') }} - {{ __('main.site_name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --accent-color: #5BBA6F;
            --dark-color: #333;
            --light-color: #f8f9fa;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            --transition: .3s ease;
            --header-bg: rgba(255, 255, 255, .9);
            --header-border: rgba(0, 0, 0, .06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* خلفية ناعمة */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(46, 134, 171, .08) 0%, rgba(241, 143, 1, .08) 100%);
            z-index: -1
        }

        .container {
            width: min(1200px, 92%);
            margin-inline: auto
        }

        /* هيدر لاصق */
        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--header-bg);
            backdrop-filter: saturate(140%) blur(6px);
            -webkit-backdrop-filter: saturate(140%) blur(6px);
            border-bottom: 1px solid var(--header-border);
            padding: 8px env(safe-area-inset-right) 8px env(safe-area-inset-left);
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0
        }

        .logo img {
            height: 52px;
            width: auto
        }

        .org-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        /* مبدّل اللغة */
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .language-btn {
            background: none;
            border: 0;
            cursor: pointer;
            font-size: .95rem;
            color: var(--dark-color);
            padding: 8px 10px;
            border-radius: 6px;
            transition: var(--transition);
            text-decoration: none
        }

        .language-btn:hover {
            background: rgba(0, 0, 0, .05)
        }

        .language-btn.active {
            color: var(--primary-color);
            font-weight: 700
        }

        /* صفحة تسجيل الدخول */
        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
            padding: 40px 0
        }

        .login-container {
            width: 100%;
            max-width: 520px;
            margin: 20px;
            background: rgba(255, 255, 255, .96);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: 36px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary-color);
        }

        .login-title {
            text-align: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-size: 1.75rem;
            position: relative
        }

        .login-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 14px auto 0;
            border-radius: 2px
        }

        .form-group {
            margin-bottom: 18px
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600
        }

        .input-container {
            position: relative
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: #f9f9f9;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, .2)
        }

        /* محاذاة الأيقونات بحسب الاتجاه */
        [dir="rtl"] .form-control {
            padding: 12px 14px 12px 42px;
            text-align: right
        }

        [dir="rtl"] .input-icon {
            left: 14px;
            right: auto
        }

        [dir="ltr"] .form-control {
            padding: 12px 42px 12px 14px;
            text-align: left
        }

        [dir="ltr"] .input-icon {
            right: 14px;
            left: auto
        }

        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #777
        }

        .btn {
            display: inline-block;
            width: 100%;
            background: var(--secondary-color);
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 12px 18px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            background: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1)
        }

        .login-footer {
            margin-top: 18px;
            text-align: center
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin: 0 8px;
            transition: var(--transition)
        }

        .login-footer a:hover {
            color: var(--secondary-color);
            text-decoration: underline
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 18px 0;
            color: #777
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd
        }

        .divider-text {
            padding: 0 12px;
            font-size: .9rem
        }

        .error-message {
            color: #dc3545;
            font-size: .85rem;
            margin-top: 6px
        }

        .has-error .form-control {
            border-color: #dc3545
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 1px solid #c3e6cb
        }

        /* فوتر */
        .footer {
            background: #222;
            color: #fff;
            text-align: center;
            padding: 18px 0;
            border-top: 1px solid rgba(255, 255, 255, .06)
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            color: #fff;
            margin: 0 5px;
            transition: var(--transition)
        }

        .social-icons a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px)
        }

        @media (max-width:768px) {
            .header .container {
                flex-direction: column;
                gap: 10px
            }

            .login-page {
                min-height: calc(100vh - 64px);
                padding: 30px 0
            }

            .login-container {
                padding: 24px 18px;
                margin: 16px 10px
            }

            .logo img {
                height: 46px
            }

            .org-name {
                font-size: 1rem
            }
        }
    </style>
</head>

<body>
    @php
        // اضبط اللغة الحالية
        $locale = $locale ?? app()->getLocale();

        // دالة تبديل بادئة اللغة مع الحفاظ على نفس الصفحة والـ query string
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثل: ['ar','login']
            if (!empty($segments) && in_array($segments[0], ['ar', 'en'], true)) {
                $segments[0] = $lang;
            } else {
                array_unshift($segments, $lang);
            }
            $path = implode('/', $segments);
            $qs = request()->getQueryString();
            return url($path) . ($qs ? '?' . $qs : '');
        };
    @endphp

    <!-- الهيدر -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}">
                </div>
                <div class="org-name">{{ __('main.site_name') }}  {{ __('main.site_subname') }}</div>
            </div>

            <!-- مبدّل اللغة (يحافظ على الصفحة) -->
            <div class="language-switcher">
                <a class="language-btn {{ $locale === 'ar' ? 'active' : '' }}"
                    href="{{ $swapLocaleUrl('ar') }}">العربية</a>
                <a class="language-btn {{ $locale === 'en' ? 'active' : '' }}"
                    href="{{ $swapLocaleUrl('en') }}">English</a>
            </div>
        </div>
    </header>

    <!-- صفحة تسجيل الدخول -->
    <div class="login-page">
        <div class="login-container">
            <h2 class="login-title">{{ __('auth.login_title') }}</h2>

            {{-- رسائل الخطأ العامة --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="margin-bottom:16px">
                    <ul style="margin:0;padding-inline-start:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- رسالة نجاح (إن وُجدت) --}}
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('login.submit', ['locale' => $locale]) }}">
                @csrf

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">{{ __('auth.email') }}</label>
                    <div class="input-container">
                        <i class="fas fa-user input-icon" aria-hidden="true"></i>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                    @if ($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">{{ __('auth.password') }}</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                        <input type="password" id="password" name="password" class="form-control" required
                            autocomplete="current-password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check" style="display:flex; align-items:center; gap:8px;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block">
                        {{ __('auth.login_button') }}
                    </button>
                </div>
            </form>

            <div class="divider"><span class="divider-text">{{ __('auth.or') }}</span></div>

            <div class="login-footer">
                <a href="{{ route('register', ['locale' => $locale]) }}">{{ __('auth.register_link') }}</a>
                <a href="{{ route('password.request', ['locale' => $locale]) }}">{{ __('auth.forgot_password') }}</a>
            </div>
        </div>
    </div>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ __('main.site_name') }}. {{ __('auth.rights_reserved') }}</p>
            <div class="social-icons" aria-label="social links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="X / Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // تعطيل زر الإرسال مؤقتاً أثناء المعالجة
        document.getElementById('loginForm')?.addEventListener('submit', function() {
            const btn = this.querySelector('button[type="submit"]');
            if (!btn) return;
            btn.disabled = true;
            btn.textContent = '{{ __('auth.logging_in') }}';
        });
    </script>
</body>

</html>
