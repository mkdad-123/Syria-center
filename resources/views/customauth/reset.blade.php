<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- مهم لطلبات fetch --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('auth.reset_password_title') }} - {{ __('main.site_name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --header-bg: rgba(255, 255, 255, .95);
            --header-border: rgba(0, 0, 0, .06)
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        body {
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
            background: var(--light-color)
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(46, 134, 171, .08) 0%, rgba(241, 143, 1, .08) 100%);
            z-index: -2
        }

        .bg-animation {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: .3;
            overflow: hidden;
            pointer-events: none
        }

        .bg-animation div {
            position: absolute;
            border-radius: 50%;
            background: rgba(46, 134, 171, .1);
            animation: float 15s linear infinite
        }

        .bg-animation div:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%
        }

        .bg-animation div:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 30%;
            animation-delay: 3s;
            animation-duration: 12s
        }

        .bg-animation div:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 30%;
            left: 70%;
            animation-delay: 5s
        }

        .bg-animation div:nth-child(4) {
            width: 180px;
            height: 180px;
            top: 70%;
            left: 80%;
            animation-delay: 7s;
            animation-duration: 18s
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0)
            }

            100% {
                transform: translateY(-1000px) rotate(720deg)
            }
        }

        .container {
            width: min(1200px, 92%);
            margin-inline: auto;
            padding: 0 12px
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--header-bg);
            backdrop-filter: saturate(140%) blur(6px);
            -webkit-backdrop-filter: saturate(140%) blur(6px);
            border-bottom: 1px solid var(--header-border);
            padding: 8px
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap
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

        .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
            padding: 40px 0
        }

        .card {
            background: rgba(255, 255, 255, .96);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 520px;
            padding: 36px;
            margin: 20px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary-color)
        }

        .title {
            text-align: center;
            margin-bottom: 24px;
            color: var(--primary-color);
            font-size: 1.75rem;
            position: relative
        }

        .title::after {
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
            background: #f9f9f9
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, .2)
        }

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
            color: #100f0f
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
            transition: var(--transition)
        }

        .btn:hover {
            background: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1)
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 1px solid #c3e6cb
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 1px solid #f5c6cb
        }

        .error-message {
            color: #dc3545;
            font-size: .85rem;
            margin-top: 6px
        }

        .has-error .form-control {
            border-color: #dc3545
        }

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

            .page {
                min-height: calc(100vh - 64px);
                padding: 30px 0
            }

            .card {
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

        /* أخفِ أي عنصر نضيف له d-none */
        .d-none {
            display: none !important;
        }

        /* ولو بقي عنصر تنبيه بلا نص، أخفِه تلقائياً */
        .alert-success:empty,
        .alert-danger:empty {
            display: none;
        }
    </style>
</head>

<body>
    @php
        $locale = $locale ?? app()->getLocale();
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments();
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

    <div class="bg-animation" aria-hidden="true">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo"><img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}"></div>
                <div class="org-name">{{ __('main.site_name') }} — {{ __('main.site_subname') }}</div>
            </div>
            <div class="language-switcher">
                <a class="language-btn {{ $locale === 'ar' ? 'active' : '' }}"
                    href="{{ $swapLocaleUrl('ar') }}">العربية</a>
                <a class="language-btn {{ $locale === 'en' ? 'active' : '' }}"
                    href="{{ $swapLocaleUrl('en') }}">English</a>
            </div>
        </div>
    </header>

    <main class="page">
        <section class="card">
            <h2 class="title">{{ __('auth.reset_password_title') }}</h2>

            {{-- تنبيهات عامة من السيرفر إن وُجدت --}}
            @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert-danger" role="alert" style="margin-bottom:16px">
                    <ul style="margin:0;padding-inline-start:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ملاحظة هامة: نرسل إلى راوت POST الصحيح --}}
            <form id="resetPasswordForm" method="POST"
                action="{{ route('password.reset.post', ['locale' => $locale]) }}">
                @csrf
                {{-- هذه القيم تأتي من رابط /{locale}/reset?email=...&token=... --}}
                <input type="hidden" name="email" value="{{ request('email') }}">
                <input type="hidden" name="token" value="{{ request('token') }}">

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">{{ __('auth.new_password') }}</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                        <input type="password" id="password" name="password" class="form-control" required
                            autocomplete="new-password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation">{{ __('auth.password_confirmation') }}</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required autocomplete="new-password">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-block" id="submitBtn">
                    <span id="submitText">{{ __('auth.reset_button') }}</span>
                </button>
            </form>

            {{-- رسائل واجهة لنتيجة الـ fetch --}}
            <div class="alert-success d-none" id="successMessage"></div>
            <div class="alert-danger d-none" id="errorMessage"></div>
        </section>
    </main>

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
        // نمنع ظهور JSON في الصفحة: نُرسل عبر fetch ونُعالج الرد
        document.getElementById('resetPasswordForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('submitBtn');
            const txt = document.getElementById('submitText');
            const successBox = document.getElementById('successMessage');
            const errorBox = document.getElementById('errorMessage');

            // إخفاء الرسائل
            successBox.classList.add('d-none');
            errorBox.classList.add('d-none');

            // تعطيل الزر
            btn.disabled = true;
            txt.textContent = '{{ __('auth.processing') }}';

            const payload = {
                email: document.querySelector('input[name="email"]').value,
                token: document.querySelector('input[name="token"]').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        successBox.textContent = '{{ __('auth.reset_success') }}';
                        successBox.classList.remove('d-none');
                        // إعادة التوجيه لتسجيل الدخول بعد ثانيتين
                        setTimeout(() => {
                            window.location.href = "{{ route('login', ['locale' => $locale]) }}";
                        }, 2000);
                    } else {
                        // أخطاء تحقق أو رسالة عامة
                        if (data.errors) {
                            const first = Object.values(data.errors)[0][0];
                            errorBox.textContent = first;
                        } else {
                            errorBox.textContent = data.message || '{{ __('auth.error_message') }}';
                        }
                        errorBox.classList.remove('d-none');
                    }
                })
                .catch(() => {
                    errorBox.textContent = '{{ __('auth.error_message') }}';
                    errorBox.classList.remove('d-none');
                })
                .finally(() => {
                    btn.disabled = false;
                    txt.textContent = '{{ __('auth.reset_button') }}';
                });
        });
    </script>
</body>

</html>
