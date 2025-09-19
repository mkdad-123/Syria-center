<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('auth.verify_title') }} - {{ __('main.site_name') }}</title>

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
            overflow-x: hidden
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
            margin-bottom: 14px;
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

        .verify-message {
            text-align: center;
            margin: 12px 0 24px
        }

        .verify-message strong {
            color: var(--primary-color)
        }

        .code-inputs {
            display: flex;
            justify-content: space-between;
            margin: 22px 0 24px;
            direction: ltr
        }

        .code-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: var(--transition)
        }

        .code-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, .2)
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

        .resend {
            margin-top: 16px;
            text-align: center
        }

        .resend a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600
        }

        .resend a:hover {
            color: var(--secondary-color);
            text-decoration: underline
        }

        .resend a.disabled {
            color: #999;
            pointer-events: none
        }

        .countdown {
            color: #777;
            margin-top: 6px
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 10px 14px;
            border-radius: 8px;
            margin-top: 14px;
            border: 1px solid #c3e6cb
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 14px;
            border-radius: 8px;
            margin-top: 14px;
            border: 1px solid #f5c6cb
        }

        .d-none {
            display: none !important
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

            .code-input {
                width: 44px;
                height: 54px;
                font-size: 22px
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
            <h2 class="title">{{ __('auth.verify_title') }}</h2>

            <p class="verify-message">
                {{ __('auth.verify_message_prefix') }}
                <strong>{{ request('email') }}</strong>
            </p>

            @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert-danger" role="alert">
                    <ul style="margin:0;padding-inline-start:18px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- IMPORTANT: id="verifyCodeForm" --}}
            <form id="verifyCodeForm" method="POST"
                action="{{ route('password.verify.post', ['locale' => $locale]) }}">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="code-inputs">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text" maxlength="1" class="code-input" name="code{{ $i }}"
                            inputmode="numeric" pattern="[0-9]*" required>
                    @endfor
                </div>

                <button type="submit" class="btn" id="verifyBtn">{{ __('auth.verify_btn') }}</button>

                <div class="resend">
                    <a href="#" id="resendCode">{{ __('auth.resend_link') }}</a>
                    <div id="countdown" class="countdown d-none">
                        {{ __('auth.countdown_text') }} <span id="timer">60</span> {{ __('auth.seconds') }}
                    </div>
                </div>
            </form>

            <div class="alert-success d-none" id="successMessage"></div>
            <div class="alert-danger  d-none" id="errorMessage"></div>
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
        // نصوص الواجهة من Laravel
        const i18n = {
            verifying: @json(__('auth.verifying')),
            success_message: @json(__('auth.verification_success')),
            error_message: @json(__('auth.verification_error')),
            resend_success: @json(__('auth.resend_success')),
            resend_error: @json(__('auth.resend_error')),
        };

        // تنقّل تلقائي بين خانات الكود
        const codeInputs = document.querySelectorAll('.code-input');
        codeInputs.forEach((input, index) => {
            if (index === 0) input.focus();
            input.addEventListener('input', (e) => {
                if (/[^0-9]/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                if (e.target.value && index < codeInputs.length - 1) codeInputs[index + 1].focus();
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) codeInputs[index - 1].focus();
            });
        });

        // إرسال نموذج التحقق عبر fetch
        document.getElementById('verifyCodeForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = this.querySelector('input[name="email"]').value;
            const code = Array.from(document.querySelectorAll('.code-input')).map(i => i.value).join('');

            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            successMessage.classList.add('d-none');
            errorMessage.classList.add('d-none');

            if (code.length !== 6) {
                errorMessage.textContent = i18n.error_message;
                errorMessage.classList.remove('d-none');
                return;
            }

            const btn = document.getElementById('verifyBtn');
            const original = btn.textContent;
            btn.disabled = true;
            btn.textContent = i18n.verifying;

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email,
                        code
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        successMessage.textContent = i18n.success_message;
                        successMessage.classList.remove('d-none');
                        setTimeout(() => {
                            // التوجيه لصفحة تعيين كلمة المرور (مع نفس الـ locale)
                            const base = @json(route('password.reset', ['locale' => $locale]));
                            window.location.href =
                                `${base}?email=${encodeURIComponent(email)}&token=${encodeURIComponent(data.token)}`;
                        }, 1200);
                    } else {
                        errorMessage.textContent = data.message || i18n.error_message;
                        errorMessage.classList.remove('d-none');
                    }
                })
                .catch(() => {
                    errorMessage.textContent = i18n.error_message;
                    errorMessage.classList.remove('d-none');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = original;
                });
        });

        // إعادة إرسال الرمز (مع عدّاد) إلى راوت password.reset-code بالـ locale
        document.getElementById('resendCode').addEventListener('click', function(e) {
            e.preventDefault();

            const email = document.querySelector('input[name="email"]').value;
            const link = this;
            const cd = document.getElementById('countdown');
            const timer = document.getElementById('timer');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            link.classList.add('disabled');
            cd.classList.remove('d-none');

            let t = 60;
            timer.textContent = String(t);
            const intv = setInterval(() => {
                t--;
                timer.textContent = String(t);
                if (t <= 0) {
                    clearInterval(intv);
                    link.classList.remove('disabled');
                    cd.classList.add('d-none');
                }
            }, 1000);

            const resendUrl = @json(route('password.reset-code', ['locale' => $locale]));
            fetch(resendUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        successMessage.textContent = i18n.resend_success;
                        successMessage.classList.remove('d-none');
                    } else {
                        errorMessage.textContent = data.message || i18n.resend_error;
                        errorMessage.classList.remove('d-none');
                    }
                })
                .catch(() => {
                    errorMessage.textContent = i18n.resend_error;
                    errorMessage.classList.remove('d-none');
                });
        });
    </script>
</body>

</html>
