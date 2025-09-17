<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <title>{{ __('main.site_name') }} - {{ __('titles.complaints') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* —— نفس أنماطك تماماً (اختصرتها هنا) —— */
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --light-color: #5ad27e;
            --dark-color: #000;
            --dark-color_1: #424040;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            --header-h: 78px;
            --header-h-tablet: 112px;
            --header-h-mobile: 160px;
            --safe-top: env(safe-area-inset-top, 0px)
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            background: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        .container {
            width: min(100% - 32px, 1400px);
            margin-inline: auto
        }

        .background-slideshow {
            position: fixed;
            inset: 0;
            z-index: -2;
            opacity: .7;
            transition: opacity 1s ease-in-out;
            pointer-events: none
        }

        .background-slideshow img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out
        }

        .background-slideshow img.active {
            opacity: 1
        }

        .header,
        main {
            position: relative;
            background: rgba(255, 255, 255, .85)
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #fff;
            box-shadow: var(--box-shadow);
            padding: max(10px, var(--safe-top)) 0 10px;
            transition: transform .35s ease, opacity .25s ease
        }

        .header.is-hidden {
            transform: translateY(calc(-100% - var(--safe-top)));
            opacity: 0;
            pointer-events: none
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(12px, 4vw, 40px);
            padding: 0 12px
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: clamp(8px, 1.6vw, 15px)
        }

        .logo img {
            height: clamp(44px, 6vw, 70px);
            width: auto
        }

        .org-name {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            color: var(--primary-color);
            font-weight: 700
        }

        .org-name-line1 {
            font-size: clamp(1.1rem, 2.3vw, 1.5rem);
            white-space: nowrap
        }

        .org-name-line2 {
            font-size: clamp(.85rem, 1.8vw, 1.1rem);
            color: var(--secondary-color);
            white-space: nowrap
        }

        .nav-list {
            display: flex;
            list-style: none;
            gap: clamp(8px, 2vw, 20px);
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
            justify-content: center
        }

        .nav-list a {
            display: block;
            text-decoration: none;
            text-align: center;
            white-space: nowrap;
            color: var(--dark-color);
            font-weight: 500;
            padding: clamp(6px, 1.2vw, 8px) clamp(10px, 1.8vw, 15px);
            border-radius: 6px;
            transition: all .3s
        }

        .nav-list a:hover {
            color: var(--primary-color);
            background: rgba(46, 134, 171, .1)
        }

        .login-btn a {
            background: var(--secondary-color);
            color: #fff !important;
            border-radius: 8px;
            padding: clamp(6px, 1.2vw, 8px) clamp(12px, 2vw, 16px)
        }

        .language-switcher {
            position: relative;
            display: inline-flex;
            align-items: center;
            list-style: none !important
        }

        .language-btn {
            background: none;
            border: 0;
            cursor: pointer;
            color: var(--dark-color);
            padding: clamp(6px, 1.2vw, 8px) clamp(10px, 1.8vw, 14px);
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500
        }

        .language-menu {
            display: none;
            position: absolute;
            top: 100%;
            inset-inline-end: 0;
            min-width: 160px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, .2);
            z-index: 100;
            list-style: none;
            padding: 10px 0;
            margin-top: 6px
        }

        .language-switcher:hover .language-menu {
            display: block
        }

        main {
            min-height: calc(100vh - 180px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0 0;
            padding-top: calc(var(--header-dyn, var(--header-h)) + var(--safe-top) + 8px)
        }

        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: clamp(16px, 3.5vw, 40px);
            width: 100%;
            max-width: clamp(320px, 90vw, 1000px);
            margin: 20px auto;
            border: 1px solid rgba(0, 0, 0, .1)
        }

        .form-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 24px;
            text-align: center;
            font-size: clamp(1.4rem, 3.2vw, 2rem)
        }

        .complaint-form {
            display: flex;
            flex-direction: column;
            gap: 16px
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .form-group label {
            font-weight: 600;
            color: var(--dark-color_1)
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, .95)
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, .2);
            outline: 0
        }

        textarea.form-control {
            min-height: 200px;
            resize: vertical
        }

        .submit-btn {
            background: var(--secondary-color);
            color: #fff;
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 1.05rem;
            font-weight: 700;
            margin-top: 6px;
            cursor: pointer
        }

        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center
        }

        .contact-info-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: clamp(16px, 3.5vw, 40px);
            margin-top: 24px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, .1)
        }

        .contact-items {
            display: flex;
            justify-content: center;
            gap: clamp(16px, 6vw, 50px);
            flex-wrap: wrap
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: clamp(1rem, 2.6vw, 1.2rem)
        }

        .contact-icon {
            color: var(--secondary-color);
            font-size: clamp(1.2rem, 3.2vw, 1.8rem)
        }

        @media (max-width:992px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-tablet)) + var(--safe-top) + 8px)
            }
        }

        @media (max-width:768px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-mobile)) + var(--safe-top) + 8px)
            }

            .header .container {
                flex-direction: column
            }

            .nav-list {
                flex-direction: column;
                width: 100%
            }
        }
    </style>
</head>

<body>
    @php
        // اضبط اللغة الحالية
        $locale = $locale ?? app()->getLocale();

        // دالة تبديل البادئة مع الحفاظ على نفس الصفحة والـ query string
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // ['ar','compliants'] مثلاً
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

    <!-- خلفية متغيرة -->
    <div class="background-slideshow">
        <img src="{{ asset('ima1.webp') }}" class="active" alt="">
        <img src="{{ asset('ima2.webp') }}" alt="">
        <img src="{{ asset('ima3.webp') }}" alt="">
    </div>

    <header class="header" id="siteHeader">
        <div class="container">
            <div class="logo-container">
                <div class="logo"><img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}"></div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>

            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                    <li><a href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                    </li>
                    <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a></li>

                    <li class="language-switcher">
                        <button class="language-btn" type="button">
                            <i class="fas fa-globe"></i>
                            <span class="current-lang">{{ $locale === 'ar' ? 'العربية' : 'English' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="language-menu">
                            <li><a href="{{ $swapLocaleUrl('ar') }}" data-lang="ar"><i class="fas fa-language"></i>
                                    العربية</a></li>
                            <li><a href="{{ $swapLocaleUrl('en') }}" data-lang="en"><i class="fas fa-language"></i>
                                    English</a></li>
                        </ul>
                    </li>

                    <li class="login-btn">
                        @auth('custom')
                            <a href="{{ route('logout', ['locale' => $locale]) }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('main.buttons.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout', ['locale' => $locale]) }}" method="POST"
                                style="display:none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login', ['locale' => $locale]) }}">{{ __('main.buttons.login') }}</a>
                        @endauth
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="main-container">
            <div class="form-container">
                <div class="form-header-icon"><i class="fas fa-comment-dots"></i></div>
                <h1 class="form-title">{{ __('main.titles.complaints_form') }}</h1>

                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i> {{ __('main.success.complaint_sent_successfully') }}
                </div>

                <form id="complaintForm" class="complaint-form" method="POST"
                    action="{{ route('compliants.store', ['locale' => $locale]) }}">
                    @csrf
                    @auth('custom')
                        <input type="hidden" name="id" value="{{ auth('custom')->id() }}">
                    @endauth

                    <div class="form-group">
                        <label for="email">{{ __('main.forms.email') }}</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="example@domain.com" required>
                        <div class="error-message" id="emailError">{{ __('main.forms.email_error') }}</div>
                    </div>

                    <div class="form-group">
                        <label for="content">{{ __('main.forms.complaint_content') }}</label>
                        <textarea id="content" name="content" class="form-control" placeholder="{{ __('main.forms.complaint_placeholder') }}"
                            required style="min-height: 250px;"></textarea>
                        <div class="error-message" id="contentError">{{ __('main.forms.complaint_min_chars') }}</div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> {{ __('main.forms.submit_complaint') }}
                    </button>

                    <p class="form-note">
                        <i class="fas fa-info-circle"></i> {{ __('main.forms.confidentiality_note') }}
                    </p>
                </form>
            </div>

            <div class="contact-info-container">
                <div class="contact-items">
                    @forelse(($contactInfo['phones'] ?? []) as $phone)
                        <div class="contact-item"><i
                                class="fas fa-phone contact-icon"></i><span>{{ $phone }}</span></div>
                    @empty
                        <div class="contact-item"><i class="fas fa-phone contact-icon"></i><span>123-456-789</span>
                        </div>
                    @endforelse

                    @foreach ($contactInfo['mobile_numbers'] ?? [] as $mobile)
                        <div class="contact-item"><i
                                class="fas fa-mobile-alt contact-icon"></i><span>{{ $mobile }}</span></div>
                    @endforeach

                    @forelse(($contactInfo['emails'] ?? []) as $email)
                        <div class="contact-item"><i
                                class="fas fa-envelope contact-icon"></i><span>{{ $email }}</span></div>
                    @empty
                        <div class="contact-item"><i
                                class="fas fa-envelope contact-icon"></i><span>info@example.com</span></div>
                    @endforelse

                    <div class="contact-item"><i
                            class="fas fa-map-marker-alt contact-icon"></i><span>{{ $contactInfo['address'] ?? 'Damascus, Syria' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // تبديل خلفية بسيطة
        document.addEventListener('DOMContentLoaded', () => {
            const bg = document.querySelectorAll('.background-slideshow img');
            let i = 0;
            if (bg.length) bg[0].classList.add('active');
            setInterval(() => {
                if (!bg.length) return;
                bg[i].classList.remove('active');
                i = (i + 1) % bg.length;
                bg[i].classList.add('active');
            }, 5000);
        });

        // تعويض ارتفاع الهيدر + إخفاؤه عند النزول
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('siteHeader') || document.querySelector('.header');

            function setHeaderPad() {
                if (!header) return;
                document.documentElement.style.setProperty('--header-dyn', header.offsetHeight + 'px');
            }
            setHeaderPad();
            addEventListener('resize', setHeaderPad);
            addEventListener('load', setHeaderPad);

            function toggleHeader() {
                if (window.scrollY > 0) header.classList.add('is-hidden');
                else header.classList.remove('is-hidden');
            }
            toggleHeader();
            document.addEventListener('scroll', toggleHeader, {
                passive: true
            });
        });

        // التحقق من الفورم + إرسال عبر Fetch
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('complaintForm');
            if (!form) return;

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // reset
                document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
                document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));
                document.getElementById('successMessage').style.display = 'none';

                const emailInput = document.getElementById('email');
                const contentInput = document.getElementById('content');
                const emailError = document.getElementById('emailError');
                const contentError = document.getElementById('contentError');

                let ok = true;
                if (!emailInput.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                    emailInput.classList.add('error');
                    emailError.style.display = 'block';
                    ok = false;
                }
                if (!contentInput.value || contentInput.value.length < 10) {
                    contentInput.classList.add('error');
                    contentError.style.display = 'block';
                    ok = false;
                }
                if (!ok) return;

                const btn = form.querySelector('.submit-btn');
                const old = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __('forms.sending') }}';
                btn.disabled = true;

                try {
                    const body = {
                        email: emailInput.value,
                        content: contentInput.value,
                        date: new Date().toISOString().slice(0, 10)
                    };

                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(body)
                    });

                    const data = await res.json();
                    if (!res.ok) throw data;

                    if (data.status === 'success') {
                        form.style.display = 'none';
                        document.getElementById('successMessage').style.display = 'block';
                        // إعادة التوجيه لنفس صفحة الشكاوى وبنفس اللغة
                        setTimeout(() => {
                            window.location.href = @json(route('compliants', ['locale' => $locale]));
                        }, 2000);
                    } else {
                        throw new Error(data.message || 'Unexpected error');
                    }
                } catch (err) {
                    if (err && err.errors) {
                        if (err.errors.email) {
                            emailInput.classList.add('error');
                            emailError.textContent = err.errors.email[0];
                            emailError.style.display = 'block';
                        }
                        if (err.errors.content) {
                            contentInput.classList.add('error');
                            contentError.textContent = err.errors.content[0];
                            contentError.style.display = 'block';
                        }
                    } else {
                        alert(err.message || 'Error, please try again.');
                    }
                } finally {
                    btn.innerHTML = old;
                    btn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>
