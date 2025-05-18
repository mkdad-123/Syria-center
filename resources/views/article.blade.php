<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ $article['title'] }}</title>
    
    <!-- Preload and optimize critical resources -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" href="{{ asset('/logo.png') }}" as="image">
    <link rel="preload" href="{{ asset('/ima1.webp') }}" as="image">
    
    <!-- Load Font Awesome asynchronously -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"></noscript>
    
    <!-- Load CSS with media query trick -->
    <link rel="preload" href="{{ asset('css/article.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/article.css') }}"></noscript>
    
    <!-- Inline critical CSS for above-the-fold content -->
    <style>
        /* Critical CSS for initial rendering */
        .header, .logo-container, .article-title {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .loaded .header, 
        .loaded .logo-container, 
        .loaded .article-title {
            opacity: 1;
        }
        .logo img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body class="loading">
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1" loading="lazy" width="1920" height="1080">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2" loading="lazy" width="1920" height="1080">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3" loading="lazy" width="1920" height="1080">
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" width="50" height="50">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>
            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('home') }}" aria-label="{{ __('main.menu.home') }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('about-us') }}" aria-label="{{ __('main.menu.about') }}">{{ __('main.menu.about') }}</a></li>
                        <li><a href="{{ route('events') }}" aria-label="{{ __('main.menu.news') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}" aria-label="{{ __('main.menu.contact') }}">{{ __('main.menu.contact') }}</a></li>
                        <li class="language-switcher" style="list-style: none;">
                            <button class="language-btn" aria-label="{{ __('main.buttons.change_language') }}">
                                <i class="fas fa-globe" aria-hidden="true"></i>
                                <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar" aria-label="العربية"><i class="fas fa-language" aria-hidden="true"></i> العربية</a></li>
                                <li><a href="#" data-lang="en" aria-label="English"><i class="fas fa-language" aria-hidden="true"></i> English</a></li>
                            </ul>
                        </li>
                        <li class="login-btn">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                aria-label="{{ __('main.buttons.logout') }}">
                                {{ __('main.buttons.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
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
                <div class="article-content-container">
                    <h1 class="article-title">{{ $article['title'] }}</h1>

                    <div class="article-body">
                        {!! $article['content'] !!}
                    </div>

                    <div class="article-meta">
                        <span>{{ __('main.titles.published_date') }}: {{ \Carbon\Carbon::parse($article['created_at'])->format('Y-m-d') }}</span>
                        @if(isset($article['service']))
                            <span>{{ __('main.titles.service') }}:
                                <a href="{{ route('services', $article['service']['id']) }}?lang={{ $locale }}" aria-label="{{ $article['service']['name'] }}">
                                    {{ $article['service']['name'] }}
                                </a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- قسم الشعار والمعلومات -->
                <div class="footer-logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}" loading="lazy" width="40" height="40">
                    <p>{{ __('main.site_name') }}<br>
                    <span style="color: var(--secondary-color);">{{ __('main.site_subname') }}</span></p>
                </div>

                <!-- قسم الروابط السريعة -->
                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('events') }}" aria-label="{{ __('main.menu.news') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('sections') }}" aria-label="{{ __('main.menu.services') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('compliants') }}" aria-label="{{ __('main.menu.contact') }}">{{ __('main.menu.contact') }}</a></li>
                        <li><a href="{{ route('home') }}" aria-label="{{ __('main.menu.home') }}">{{ __('main.menu.home') }}</a></li>
                    </ul>
                </div>
            </div>

            <!-- حقوق النشر ووسائل التواصل الاجتماعي -->
            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <!-- Load scripts with defer and add loading state handler -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');
            
            // Load non-critical JS dynamically
            var script = document.createElement('script');
            script.src = "{{ asset('js/article.js') }}";
            script.defer = true;
            document.body.appendChild(script);
        });
    </script>
</body>
</html>