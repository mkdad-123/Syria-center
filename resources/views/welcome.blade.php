<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('main.site_subname') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3">
    </div>

    <!-- شريط التنقل العلوي المعدل -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="\logo.png" alt="{{ __('main.site_name') }}">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>
            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('about-us') }}">{{ __('main.menu.about') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn">{{ __('main.menu.sections') }} <i
                                    class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-content">
                                <a href="#mission">{{ __('main.menu.about') }}</a>
                                <a href="#target">{{ __('main.menu.target') }}</a>
                                <a href="#services">{{ __('main.menu.services') }}</a>
                                <a href="#team">{{ __('main.menu.team') }}</a>
                                <a href="#partners">{{ __('main.menu.partners') }}</a>
                            </div>
                        </li>
                        <li class="language-switcher">
                            <button class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar"><i class="fas fa-language"></i> العربية</a></li>
                                <li><a href="#" data-lang="en"><i class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>
                        @if (Auth::guard('custom')->check())
                            <li class="login-btn">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="login-btn"><a href="{{ route('login') }}">{{ __('main.buttons.login') }}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <!-- About Us Section - Fixed -->
        <section id="about" class="section about-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.about') }}</h2>
                <div class="about-container">
                    <!-- الصورة الجديدة -->
                    <div class="about-image">
                        <div class="about-image-card">
                            <img src="\image1.jpg" alt="{{ __('main.titles.about') }}">
                        </div>
                    </div>
                    <div class="about-content">
                        @php
                        $aboutContent = '';
                        if (is_string($aboutUs)) {
                            $aboutContent = $aboutUs;
                        } elseif ($aboutUs instanceof \App\Models\Setting) {
                            $aboutContent = $aboutUs->getTranslation('content', $locale, false) ?? __('No content available');
                        } else {
                            $aboutContent = __('No content available');
                        }

                        // عرض المحتوى الكامل كـ HTML
                        $fullContent = $aboutContent;

                        // إنشاء نسخة مختصرة للنص (بدون علامات HTML)
                        $textOnly = strip_tags($aboutContent);
                        $words = preg_split('/\s+/', $textOnly);
                        $shortContent = implode(' ', array_slice($words, 0, 40));
                        if (count($words) > 40) {
                            $shortContent .= '...';
                        }
                    @endphp

                    <div class="about-content">
                        <div class="short-content">
                            <p>{!! nl2br(e($shortContent)) !!}</p>
                                <div class="read-more-btn-container">
                                    <a href="{{ route('about-us') }}" class="read-more-btn">{{ __('main.buttons.read_more') }}</a>
                                </div>
                        </div>

                        <!-- في صفحة about-us يمكنك استخدام: -->
                        @if(request()->routeIs('about-us'))
                            <div class="full-content">
                                {!! $fullContent !!}
                            </div>
                        @endif
                    </div>
                </div>
        </section>

        <!-- Mission & Vision Section - Fixed -->
        <section id="mission" class="section mission-section">
            <div class="container">
                <div class="mission-vision">
                    <div class="mission">
                        <h3 style="color: #000;">{{ __('main.titles.mission') }}</h3>
                        <div class="icon-wrapper">
                            <i class="far fa-lightbulb"></i>
                        </div>
                        @php
                            $missionContent = '';
                            if (is_string($message)) {
                                $missionContent = $message;
                            } elseif ($message instanceof \App\Models\Setting) {
                                $missionContent =
                                    $message->getTranslation('content', $locale, false) ?? __('No content available');
                            } else {
                                $missionContent = __('No content available');
                            }
                        @endphp
                    {!! $missionContent !!}
                </div>
                    <div class="vision">
                        <h3 style="color: #000;">{{ __('main.titles.vision') }}</h3>
                        <div class="icon-wrapper">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        @php
                            $visionContent = '';
                            if (is_string($vision)) {
                                $visionContent = $vision;
                            } elseif ($vision instanceof \App\Models\Setting) {
                                $visionContent =
                                    $vision->getTranslation('content', $locale, false) ?? __('No content available');
                            } else {
                                $visionContent = __('No content available');
                            }
                        @endphp
                    {!! $visionContent !!}
                </div>
                </div>
            </div>
        </section>

        <!-- Target Group Section - Fixed -->
        <section id="target" class="section target-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.target') }}</h2>
                <div class="target-icon">
                    <i class="fas fa-users" style="color: #000;"></i>
                </div>
                <div class="target-content">
                    @php
                        $targetContent = '';
                        if (is_string($targetgroup)) {
                            $targetContent = $targetgroup;
                        } elseif ($targetgroup instanceof \App\Models\Setting) {
                            $targetContent =
                                $targetgroup->getTranslation('content', $locale, false) ?? __('No content available');
                        } else {
                            $targetContent = __('No content available');
                        }
                    @endphp
                    {!!$targetContent !!}
                </div>
            </div>
        </section>
        <!-- قسم ما نقدمه -->
        <section id="services" class="section services-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.services') }}</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>{{ __('main.services.education') }}</h3>
                        <p>{{ $locale == 'ar' ? 'تمكين الأفراد والمجتمعات من تعزيز قدراتهم' : 'Empowering individuals and communities to enhance their capabilities' }}
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-chart-line"></i>
                        <h3>{{ __('main.services.development') }}</h3>
                        <p>{{ $locale == 'ar' ? 'تحسين سبل العيش وتعزيز الاستقرار المجتمعي' : 'Improving livelihoods and enhancing community stability' }}
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-seedling"></i>
                        <h3>{{ __('main.services.environment') }}</h3>
                        <p>{{ $locale == 'ar' ? 'تعزيز التنمية الزراعية والحفاظ على الموارد' : 'Promoting agricultural development and preserving resources' }}
                        </p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('sections') }}" class="btn">{{ __('main.buttons.discover') }}</a>
                </div>
            </div>
        </section>

        <!-- Team Section - Improved -->
        <section id="team" class="section team-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.team') }}</h2>
                <div class="team-carousel {{ count($team) <= 1 ? 'single-member' : '' }}" id="teamCarousel">
                    <div class="team-slide">
                        @foreach ($team as $member)
                            <div class="team-member {{ $loop->first ? 'active' : '' }}">
                                <a href="{{ route('volunteers', ['vol' => $member['id'] ?? null]) }}">
                                    <img src="{{ asset('storage/' . $member['image']) }}" alt="{{ $member['name'] }}" style="cursor: pointer;">
                                </a>                                <h3>{{ $member['name'] }}</h3>
                                <p>{{ $member['profession'] }}</p>
                                <p>{{ $member['bio'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
                    <div class="carousel-indicators"></div>
                </div>
            </div>
        </section>

        <!-- Partners Section - Improved -->
        <section id="partners" class="section partners-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.partners') }}</h2>
                <div class="partners-carousel {{ count($partners) <= 1 ? 'single-partner' : '' }}" id="partnersCarousel">
                    <div class="partners-slide">
                        @foreach ($partners as $partner)
                        {{-- Debug output --}}
                        <div class="partner {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $partner['image']) }}" alt="{{ $partner['name'] }}">
                            <p>
                            {!! $partner['name'] !!}
                            </p>
                            <p>
                                @if(is_array($partner['description']))
                                    {!! $partner['description'][$locale] ?? $partner['description']['en'] ?? '' !!}
                                @else
                                    {!! $partner['description'] !!}
                                @endif
                            </p>                       </div>
                    @endforeach

                    </div>
                    <button class="carousel-btn" id="partnersPrevBtn"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn" id="partnersNextBtn"><i class="fas fa-chevron-right"></i></button>
                    <div class="carousel-indicators"></div>
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
                    <img src="\logo.png" alt="{{ __('main.site_name') }}">
                    <p>{{ __('main.site_name') }}<br>
                    <span style="color: var(--secondary-color);">{{ __('main.site_subname') }}</span></p>
                </div>

                <!-- قسم الروابط السريعة -->
                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                        <li><a href="#about">{{ __('main.menu.about') }}</a></li>
                    </ul>
                </div>

                <!-- قسم معلومات الاتصال -->
                <div class="footer-contact">
                    <h4>{{ __('main.footer.contact_us') }}</h4>
                    @if (isset($contactInfo['phones']) && count($contactInfo['phones']) > 0)
                        <p><i class="fas fa-phone"></i> {{ $contactInfo['phones'][0] }}</p>
                    @endif
                    @if (isset($contactInfo['emails']) && count($contactInfo['emails']) > 0)
                        <p><i class="fas fa-envelope"></i> {{ $contactInfo['emails'][0] }}</p>
                    @endif
                    @if (isset($contactInfo['address']))
                        <p><i class="fas fa-map-marker-alt"></i> {{ $contactInfo['address'] }}</p>
                    @endif
                </div>
            </div>



            <!-- حقوق النشر ووسائل التواصل الاجتماعي -->
            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>
<script src="{{ asset('js\welcome.js') }}"></script>

</body>

</html>
