<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">

    <meta charset="UTF-8">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ __('main.site_name') }} - {{ __('titles.sections') }}</title>

    <link rel="preload" href="{{ asset('css/sections.css') }}" as="style">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image" type="image/png">

    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </noscript>

    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image" type="image/webp">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image" type="image/webp">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image" type="image/webp">

    <link href="{{ asset('css/sections.css') }}" rel="stylesheet" media="print" onload="this.media='all'">

    <style>
        .logo-container,
        .header,
        .section-title {
            opacity: 0;
            animation: fadeIn .5s forwards
        }

        @keyframes fadeIn {
            to {
                opacity: 1
            }
        }

        :root {
            --header-h: 78px;
            --header-h-tablet: 112px;
            --header-h-mobile: 160px;
            --safe-top: env(safe-area-inset-top, 0px)
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            transition: transform .35s ease, opacity .25s ease;
            will-change: transform
        }

        .header.is-hidden {
            transform: translateY(calc(-100% - var(--safe-top)));
            opacity: 0;
            pointer-events: none
        }

        main {
            padding-top: var(--header-dyn, calc(var(--header-h) + var(--safe-top) + 8px))
        }

        :where(section, .section, [id]) {
            scroll-margin-top: calc(var(--header-dyn, var(--header-h)) + 16px)
        }

        @media (max-width:992px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-tablet)) + var(--safe-top) + 8px)
            }

            :where(section, .section, [id]) {
                scroll-margin-top: calc(var(--header-dyn, var(--header-h-tablet)) + 16px)
            }
        }

        @media (max-width:768px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-mobile)) + var(--safe-top) + 8px)
            }

            :where(section, .section, [id]) {
                scroll-margin-top: calc(var(--header-dyn, var(--header-h-mobile)) + 16px)
            }
        }

        @media (prefers-reduced-motion:reduce) {
            .header {
                transition: none
            }
        }
    </style>

    @php
        /**
         * أنشئ رابطاً لنفس الصفحة مع استبدال بادئة اللغة فقط (ar/en)
         */
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثال: ['ar','home','sections']
            if (!empty($segments) && in_array($segments[0], ['ar', 'en'], true)) {
                $segments[0] = $lang;
            } else {
                array_unshift($segments, $lang);
            }
            return url(implode('/', $segments));
        };
    @endphp
</head>

<body>
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="" loading="lazy" width="1920"
            height="1080">
        <img src="{{ asset('/ima2.webp') }}" alt="" loading="lazy" width="1920" height="1080">
        <img src="{{ asset('/ima3.webp') }}" alt="" loading="lazy" width="1920" height="1080">
    </div>

    <header id="siteHeader" class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" width="50" height="50"
                        loading="eager">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>

            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        {{-- ✅ كل الروابط تمرّر locale --}}
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('about-us', ['locale' => $locale]) }}">{{ __('main.menu.about') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a></li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        {{-- ✅ مبدّل اللغة: يبدّل البادئة ويبقيك بنفس الصفحة --}}
                        <li class="language-switcher" style="list-style:none;">
                            <button class="language-btn" type="button" aria-label="Change language">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale === 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="{{ $swapLocaleUrl('ar') }}"><i class="fas fa-language"></i> العربية</a>
                                </li>
                                <li><a href="{{ $swapLocaleUrl('en') }}"><i class="fas fa-language"></i> English</a>
                                </li>
                            </ul>
                        </li>

                        {{-- دخول/خروج (إن أردت إبقائها) --}}
                        @if (Auth::guard('custom')->check())
                            <li class="login-btn">
                                <a href="{{ route('logout', ['locale' => $locale]) }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', ['locale' => $locale]) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="login-btn"><a
                                    href="{{ route('login', ['locale' => $locale]) }}">{{ __('main.buttons.login') }}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section class="section">
            <div class="container">
                <h1 class="section-title">{{ __('main.titles.sections') }}</h1>

                <div class="sections-container">
                    @foreach ($sections as $index => $section)
                        <div class="section-card" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="section-image-container">
                                @if (!empty($section['image']))
                                    <img src="{{ asset('storage/' . $section['image']) }}"
                                        alt="{{ $section['name'] }}" class="section-image" loading="lazy"
                                        width="300" height="200">
                                @else
                                    <img src="{{ asset('/default-section.jpg') }}"
                                        alt="{{ __('main.default_image') }}" class="section-image" loading="lazy"
                                        width="300" height="200">
                                @endif
                            </div>

                            <div class="section-content">
                                <h3 class="section-title-card">{{ $section['name'] }}</h3>
                                <span class="services-count">
                                    {{ count($section['services']) }} {{ __('main.titles.services_count') }}
                                </span>
                                <p class="section-description">
                                    {{ \Illuminate\Support\Str::limit($section['description'] ?? '', 100) }}
                                </p>

                                {{-- ✅ رابط الخدمات مع locale والـ section --}}
                                <a href="{{ route('services', ['locale' => $locale, 'section' => $section['id']]) }}"

                                    class="explore-btn">{{ __('main.buttons.explore') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}" width="50"
                        height="50" loading="lazy">
                    <p>{{ __('main.site_name') }}<br>
                        <span style="color:var(--secondary-color);">{{ __('main.site_subname') }}</span>
                    </p>
                </div>

                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a>
                        </li>
                        <li><a
                                href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/sections.js') }}" defer></script>

    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image" media="(min-width: 800px)">
    <script>
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
    </script>
</body>

</html>
