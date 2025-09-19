<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <title>{{ __('main.site_name') }} - {{ __('titles.events') }}</title>

    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preload" href="{{ asset('css/events.css') }}" as="style"
            onload="this.onload=null;this.rel='stylesheet'">
    </noscript>

    <!-- Preload background images -->
    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima2.webp') }}" as="image">
    <link rel="preload" href="{{ asset('/ima3.webp') }}" as="image">

    <!-- Preload logo -->
    <link rel="preload" href="{{ asset('logo.png') }}" as="image">

    <link rel="stylesheet" href="{{ asset('css/events.css') }}">

    <style>
        :root {
            --header-h: 78px;
            --header-h-tablet: 112px;
            --header-h-mobile: 160px;
            --safe-top: env(safe-area-inset-top, 0px);
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
            will-change: transform;
        }

        .header.is-hidden {
            transform: translateY(calc(-100% - var(--safe-top)));
            opacity: 0;
            pointer-events: none;
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
</head>

<body>
    @php
        // ثبّت اللغة الحالية
        $locale = $locale ?? app()->getLocale();

        // مولّد رابط يبدّل بادئة اللغة ويحافظ على نفس الصفحة والـ query string
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثال: ['ar','events']
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

    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1" loading="lazy" width="1920" height="1080"
            decoding="async">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2" loading="lazy" width="1920" height="1080"
            decoding="async">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3" loading="lazy" width="1920" height="1080"
            decoding="async">
    </div>

    <header id="siteHeader" class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}" width="50" height="50"
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
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('about-us', ['locale' => $locale]) }}">{{ __('main.menu.about') }}</a>
                        </li>
                        <li><a
                                href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        <li class="language-switcher">
                            <button class="language-btn" aria-label="Change language" type="button">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale === 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="{{ $swapLocaleUrl('ar') }}" data-lang="ar"
                                        aria-label="Switch to Arabic"><i class="fas fa-language"></i> العربية</a></li>
                                <li><a href="{{ $swapLocaleUrl('en') }}" data-lang="en"
                                        aria-label="Switch to English"><i class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>

                        <li class="login-btn">
                            @auth('custom')
                                <a href="{{ route('logout', ['locale' => $locale]) }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', ['locale' => $locale]) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login', ['locale' => $locale]) }}">{{ __('main.buttons.login') }}</a>
                            @endauth
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <section class="section">
            <div class="container">
                <h1 class="section-title">{{ __('main.menu.news') }}</h1>

                <div class="events-container">
                    @foreach ($events as $event)
                        <div class="event-card">
                            <div class="event-image-container">
                                @if (!empty($event['cover_image']))
                                    <img src="{{ asset('storage/' . $event['cover_image']) }}"
                                        alt="{{ $event['title'] }}" class="event-image" loading="lazy"
                                        width="400" height="300" decoding="async">
                                @else
                                    <img src="{{ asset('default-event.jpg') }}"
                                        alt="{{ __('events.default_image_alt') }}" class="event-image"
                                        loading="lazy" width="400" height="300" decoding="async">
                                @endif
                            </div>

                            <div class="event-content">
                                <span class="event-type {{ $event['type'] }}"
                                    style="margin-bottom: 15px; display: inline-block;">
                                    @if ($event['type'] == 'festival')
                                        {{ __('main.events.festival') }}
                                    @elseif($event['type'] == 'volunteering')
                                        {{ __('main.events.volunteering') }}
                                    @elseif($event['type'] == 'workshop')
                                        {{ __('main.events.workshop') }}
                                    @endif
                                </span>

                                <h3 class="event-title">{{ $event['title'] ?? 'No title available' }}</h3>

                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                        <span>{{ __('main.menu.start_date') }}:
                                            {{ $event['start_date']->format('Y-m-d') }}</span>
                                    </div>

                                    <div class="event-meta-item">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                        <span>{{ __('main.menu.end_date') }}:
                                            {{ $event['end_date']->format('Y-m-d') }}</span>
                                    </div>

                                    <div class="event-meta-item">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>{{ $event['location'] }}</span>
                                    </div>
                                </div>

                                <p class="event-description">{!! Str::limit(strip_tags($event['description']), 100) !!}</p>

                                <button class="read-more-btn" onclick="openEventModal({{ $event['id'] }})"
                                    aria-label="Read more about {{ $event['title'] }}">
                                    {{ __('main.menu.read_more') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- نوافذ التفاصيل -->
    @foreach ($events as $event)
        <div id="eventModal{{ $event['id'] }}" class="event-modal" aria-hidden="true">
            <div class="modal-content">
                <span class="close-modal" onclick="closeEventModal({{ $event['id'] }})"
                    aria-label="Close modal">&times;</span>

                <span class="event-type {{ $event['type'] }}" style="margin-bottom: 15px; display: inline-block;">
                    @if ($event['type'] == 'festival')
                        {{ __('main.events.festival') }}
                    @elseif($event['type'] == 'volunteering')
                        {{ __('main.events.volunteering') }}
                    @elseif($event['type'] == 'workshop')
                        {{ __('main.events.workshop') }}
                    @endif
                </span>

                <h2 class="modal-title">{{ $event['title'] }}</h2>

                <div class="modal-meta">
                    <div class="modal-meta-item">
                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                        <div>
                            <strong>{{ __('main.menu.start_date') }}:</strong>
                            <p>{{ $event['start_date']->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    <div class="modal-meta-item">
                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                        <div>
                            <strong>{{ __('main.menu.end_date') }}:</strong>
                            <p>{{ $event['end_date']->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    <div class="modal-meta-item">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        <div>
                            <strong>{{ __('main.events.location') }}:</strong>
                            <p>{{ $event['location'] }}</p>
                        </div>
                    </div>

                    @if (!empty($event['max_participants']))
                        <div class="modal-meta-item">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <div>
                                <strong>{{ __('main.events.max_participants') }}:</strong>
                                <p>{{ $event['max_participants'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if (!empty($event['description']))
                    <div class="modal-description">
                        <h3>{{ __('main.events.description') }}:</h3>
                        <p class="event-description">{!! strip_tags($event['description']) !!}</p>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    <!-- التذييل -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}" width="50"
                        height="50" loading="lazy">
                    <p>{{ __('main.site_name') }}<br>
                        <span style="color: var(--secondary-color);">{{ __('main.site_subname') }}</span>
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
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" aria-label="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" aria-label="Twitter"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" aria-label="LinkedIn"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" aria-label="Instagram"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" aria-label="YouTube"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <!-- تحميل JavaScript -->
    <link rel="preload" href="{{ asset('js/events.js') }}" as="script">
    <script src="{{ asset('js/events.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('siteHeader') || document.querySelector('.header');

            // تعويض ارتفاع الهيدر
            function setHeaderPad() {
                if (!header) return;
                document.documentElement.style.setProperty('--header-dyn', header.offsetHeight + 'px');
            }
            setHeaderPad();
            addEventListener('resize', setHeaderPad);
            addEventListener('load', setHeaderPad);

            // إخفاء/إظهار الهيدر مع التمرير
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
