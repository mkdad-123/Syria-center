<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('titles.services') }}</title>

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </noscript>

    <link rel="preload" href="{{ asset('css/services.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">

    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image">



    @php
        /**
         * يولّد رابطًا لنفس الصفحة مع تبديل بادئة اللغة فقط (ar/en)
         */
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثال: ['ar','home','sections','123']
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
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="bg1" loading="lazy">
        <img src="{{ asset('/ima2.webp') }}" alt="bg2" loading="lazy">
        <img src="{{ asset('/ima3.webp') }}" alt="bg3" loading="lazy">
    </div>

    <header id="siteHeader" class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" loading="lazy" width="50"
                        height="50">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>

            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        {{-- ✅ الروابط مع locale --}}
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a>
                        </li>
                        <li><a href="{{ route('about-us', ['locale' => $locale]) }}">{{ __('main.menu.about') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        {{-- ✅ مبدّل اللغة يبقيك بنفس الصفحة --}}
                        <li class="language-switcher" style="list-style:none;">
                            <button class="language-btn" type="button">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="{{ $swapLocaleUrl('ar') }}"><i class="fas fa-language"></i> العربية</a>
                                </li>
                                <li><a href="{{ $swapLocaleUrl('en') }}"><i class="fas fa-language"></i> English</a>
                                </li>
                            </ul>
                        </li>

                        {{-- دخول/خروج إن لزم --}}
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
                <h1 class="section-title">{{ __('main.titles.services') }}</h1>

                <div class="services-container">
                    @foreach ($services as $service)
                        <div class="service-card">
                            <div class="service-content">
                                <h3 class="service-title">{{ $service['name'] }}</h3>
                                <p class="service-description">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($service['description'] ?? ''), 200) }}
                                </p>

                                {{-- ✅ رابط التفاصيل مع locale + service --}}
                                <a href="{{ route('details', ['locale' => $locale, 'service' => $service['id']]) }}"
                                    class="details-btn">{{ __('main.buttons.view_details') }}</a>
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
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}" loading="lazy"
                        width="50" height="50">
                    <p>{{ __('main.site_name') }}<br><span
                            style="color:var(--secondary-color);">{{ __('main.site_subname') }}</span></p>
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
                    {{-- @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif --}}
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

    <script src="{{ asset('js/services.js') }}" defer></script>
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
