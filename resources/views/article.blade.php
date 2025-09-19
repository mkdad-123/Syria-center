<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkfQJ5Gd6bZxU2hYpP2R0R8fZx7QMX7u3v6Z8+7q6bQx9bQ0P4o7r4Ykg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ __('main.site_name') }} - {{ $article['title'] }}</title>



    {{-- دالة تبديل البادئة مع الحفاظ على نفس المسار --}}
    @php
        $locale = $locale ?? app()->getLocale();
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثال: ['ar','article','12']
            if (!empty($segments) && in_array($segments[0], ['ar', 'en'], true)) {
                $segments[0] = $lang;
            } else {
                array_unshift($segments, $lang);
            }
            return url(implode('/', $segments));
        };
    @endphp

    <link rel="preload" href="{{ asset('css/article.css') }}" as="style">
    <link href="{{ asset('css/article.css') }}" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/article.css') }}">
    </noscript>
    <style>
        /* حاوية عامة آمنة */
        .container {
            max-width: 1200px;
            margin-inline: auto;
            padding-inline: clamp(12px, 2vw, 24px)
        }

        /* المربع الأبيض للمقالة (fallback لو ما تحمّل article.css) */
        .article-content-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            padding: clamp(16px, 2.5vw, 28px);
        }

        /* تأكيد أن الخلفية خلف المحتوى */
        .background-slideshow {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: .9
        }

        .background-slideshow img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity .6s
        }

        .background-slideshow img.active {
            opacity: 1
        }
    </style>
</head>

<body>
    {{-- خلفية اختيارية --}}
    <div class="background-slideshow" aria-hidden="true">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="" loading="lazy">
        <img src="{{ asset('/ima2.webp') }}" alt="" loading="lazy">
        <img src="{{ asset('/ima3.webp') }}" alt="" loading="lazy">
    </div>

    <header id="siteHeader" class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo"><img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}"
                        width="50" height="50"></div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>

            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        {{-- ✅ كل الروابط تمرّر locale --}}
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a>
                        </li>
                        <li><a href="{{ route('about-us', ['locale' => $locale]) }}">{{ __('main.menu.about') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        {{-- ✅ مبدّل اللغة يحافظ على نفس الصفحة ويغير البادئة فقط --}}
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

                        {{-- دخول/خروج مع locale --}}
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
                <div class="article-content-container">
                    <h1 class="article-title">{{ $article['title'] }}</h1>

                    <div class="article-body">
                        {!! $article['content'] !!}
                    </div>

                    <div class="article-meta">
                        <span>{{ __('main.titles.published_date') }}:
                            {{ \Carbon\Carbon::parse($article['created_at'])->format('Y-m-d') }}</span>
                        {{--
                        @if (!empty($article['service']))
                            <span>{{ __('main.titles.service') }}:
                                @php $sectionId = $article->service->section_id ?? null; @endphp

                                @if ($sectionId)
                                    <a href="{{ route('services', ['locale' => $locale, 'section' => $sectionId]) }}">
                                        {{ __('main.menu.services') }}
                                    </a>
                                @else
                                    {{-- fallback: صفحة الأقسام العامة --}}
                        {{-- <a href="{{ route('sections', ['locale' => $locale]) }}">
                                        {{ __('main.menu.services') }}
                                    </a>
                                @endif --}}

                        {{--
                            </span>
                        @endif --}}
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" width="40" height="40"
                        loading="lazy">
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
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" rel="noopener"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    {{-- @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" rel="noopener"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" rel="noopener"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif --}}
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" rel="noopener"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" rel="noopener"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    {{-- سكربت صغير للهيدر --}}
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

    {{-- تحميل سكربت الصفحة إن وُجد --}}
    <script defer src="{{ asset('js/article.js') }}"></script>
</body>

</html>
