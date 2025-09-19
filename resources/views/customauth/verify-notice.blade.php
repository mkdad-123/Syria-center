<!doctype html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ __('verify.page_title') }}</title>
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
            position: relative;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f6f7f9;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(46, 134, 171, .10) 0%, rgba(241, 143, 1, .10) 100%);
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
            background: rgba(46, 134, 171, .10);
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
                transform: translateY(0) rotate(0);
                opacity: 1
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0
            }
        }

        .container {
            width: min(1200px, 92%);
            margin-inline: auto
        }

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
            font-size: 1.15rem;
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
            width: 100%;
            max-width: 520px;
            margin: 20px;
            background: rgba(255, 255, 255, .95);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: 36px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary-color)
        }

        h2 {
            margin: 0 0 8px;
            color: var(--primary-color);
            font-size: 1.6rem;
            font-weight: 800;
            position: relative
        }

        h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 14px 0 0;
            border-radius: 2px
        }

        p {
            margin: 8px 0;
            color: #444
        }

        .muted {
            color: #6b7280
        }

        .warn {
            background: #fff7ed;
            border: 1px solid #fbbf24;
            color: #92400e;
            padding: 10px 12px;
            border-radius: 10px;
            margin: 12px 0
        }

        .success {
            background: #ecfdf5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 10px 12px;
            border-radius: 10px;
            margin: 10px 0
        }

        .row {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap
        }

        button {
            all: unset;
            display: inline-block;
            background: var(--secondary-color);
            color: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: var(--transition)
        }

        button:hover {
            background: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1)
        }

        button:disabled {
            opacity: .6;
            cursor: not-allowed
        }

        a.link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600
        }

        a.link:hover {
            color: var(--secondary-color);
            text-decoration: underline
        }

        @media (max-width:992px) {
            .logo img {
                height: 48px
            }

            .org-name {
                font-size: 1.05rem
            }

            .header .container {
                gap: 12px
            }

            .card {
                padding: 30px
            }
        }

        @media (max-width:768px) {
            .header {
                padding: 10px 0
            }

            .header .container {
                flex-direction: column;
                align-items: center;
                gap: 10px
            }

            .logo-container {
                gap: 6px
            }

            .logo img {
                height: 46px
            }

            .org-name {
                font-size: 1rem
            }

            .page {
                min-height: calc(100vh - 64px);
                padding: 30px 0
            }

            .card {
                padding: 24px 18px;
                margin: 16px 10px
            }
        }

        @media (max-width:420px) {
            .logo img {
                height: 42px
            }

            .org-name {
                font-size: .95rem
            }

            button {
                padding: 11px 14px
            }
        }
    </style>
</head>

<body>
    @php
        $locale = $locale ?? app()->getLocale();
        // دالة تبديل اللغة مع الحفاظ على نفس الصفحة والـ query string
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

    <div class="bg-animation">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}">
                </div>
                <div class="org-name">{{ __('main.site_name') }} {{ __('main.site_subname') }}</div>
            </div>

            <div class="language-switcher" aria-label="{{ __('verify.lang_switcher') }}">
                <a class="language-btn {{ $locale === 'ar' ? 'active' : '' }}" href="{{ $swapLocaleUrl('ar') }}">العربية</a>
                <a class="language-btn {{ $locale === 'en' ? 'active' : '' }}" href="{{ $swapLocaleUrl('en') }}">English</a>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="card">
            <h2>{{ __('verify.heading') }}</h2>

            <p class="muted">
                <span>{{ __('verify.sent_to') }}</span>
                <b
                    id="user-email">{{ optional(auth('custom')->user())->email ?? (session('unverified_email') ?? __('verify.your_email')) }}</b>
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="success"><i class="fa-solid fa-check-circle"></i>
                    {{ __('verify.statuses.verification_link_sent') }}</div>
            @elseif (session('status') === 'email-verified')
                <div class="success"><i class="fa-solid fa-check-circle"></i>
                    {{ __('verify.statuses.email_verified') }}</div>
            @elseif (session('status') === 'email-already-verified')
                <div class="success"><i class="fa-solid fa-circle-info"></i>
                    {{ __('verify.statuses.email_already_verified') }}</div>
            @endif

            <div class="warn">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ __('verify.warn_check_spam') }}
            </div>

            @auth('custom')
                @if (!auth('custom')->user()->hasVerifiedEmail())
                    <form class="row" method="POST" action="{{ route('verification.send', ['locale' => $locale]) }}">
                        @csrf
                        <button type="submit">{{ __('verify.buttons.resend_link') }}</button>
                        <a href="{{ route('home', ['locale' => $locale]) }}"
                            class="link">{{ __('verify.links.back_home') }}</a>
                    </form>
                @else
                    <p><a href="{{ route('home', ['locale' => $locale]) }}"
                            class="link">{{ __('verify.links.go_home') }}</a></p>
                @endif
            @endauth

            @guest('custom')
                <p class="muted">
                    {{ __('verify.guest.hint_1') }}
                    <a href="{{ route('login', ['locale' => $locale]) }}"
                        class="link">{{ __('verify.guest.hint_2') }}</a>
                    {{ __('verify.guest.hint_3') }}
                </p>
                <p><a href="{{ route('home', ['locale' => $locale]) }}"
                        class="link">{{ __('verify.links.back_home') }}</a></p>
            @endguest
        </div>
    </main>
</body>

</html>
