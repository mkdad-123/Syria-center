<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <title>{{ __('main.site_name') }} - {{ __('main.site_subname') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>

<body>
    @php
        use Illuminate\Support\Str;

        // اللغة الحالية
        $locale = $locale ?? app()->getLocale();
        $loc = $loc ?? $locale;

        // حضّر $aboutContent من $aboutUs بأي شكل كانت (Collection/array/model/string)
        if (!isset($aboutContent)) {
            $aboutModel =
                $aboutUs instanceof \Illuminate\Support\Collection
                    ? $aboutUs->first()
                    : (is_array($aboutUs)
                        ? $aboutUs[0] ?? null
                        : $aboutUs);

            if (is_string($aboutModel)) {
                $aboutContent = $aboutModel;
            } elseif ($aboutModel instanceof \App\Models\Setting) {
                // fallback=true لاختيار لغة بديلة لو مافي ترجمة
                $aboutContent = $aboutModel->getTranslation('content', $locale, true) ?? '';
            } else {
                $aboutContent = '';
            }
        }

        // عرّف $isShortContent إن لم يكن معرّفاً (قبل أي استخدام له)
        if (!isset($isShortContent)) {
            $textOnly = trim(strip_tags($aboutContent));
            $wordCount = $textOnly === '' ? 0 : count(preg_split('/\s+/u', $textOnly));
            $isShortContent = $wordCount <= 40;
        }
    @endphp


    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('ima1.webp') }}" class="active" alt="خلفية 1">
        <img src="{{ asset('ima2.webp') }}" alt="خلفية 2">
        <img src="{{ asset('ima3.webp') }}" alt="خلفية 3">
    </div>

    <!-- شريط التنقل العلوي -->
    <header class="header" id="siteHeader">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>
            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('about-us', ['locale' => $loc]) }}">{{ __('main.menu.about') }}</a></li>
                        <li><a href="{{ route('sections', ['locale' => $loc]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $loc]) }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants', ['locale' => $loc]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn">
                                {{ __('main.menu.sections') }} <i class="fas fa-chevron-down"></i>
                            </a>
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

                        <li class="login-btn">
                            @auth('custom')
                                <a href="{{ route('logout', ['locale' => $loc]) }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', ['locale' => $loc]) }}" method="POST"
                                    style="display:none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login', ['locale' => $loc]) }}">{{ __('main.buttons.login') }}</a>
                            @endauth
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section id="about" class="section about-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.about') }}</h2>
                <div class="about-container">
                    <div class="about-image">
                        <div class="about-image-card">
                            <img src="{{ asset('image1.jpg') }}" alt="{{ __('main.titles.about') }}">
                        </div>
                    </div>
                    <div class="about-content">
                        @if (request()->routeIs('about-us'))
                            <div class="full-content">{!! $aboutContent !!}</div>
                        @else
                            <div class="{{ $isShortContent ? 'full-content' : 'short-content' }}">
                                @if ($isShortContent)
                                    {!! $aboutContent !!}
                                @else
                                    {!! Str::words($aboutContent, 40, '...') !!}
                                @endif

                                <div class="read-more-btn-container">
                                    <a href="{{ route('about-us', ['locale' => $loc]) }}" class="read-more-btn">
                                        {{ __('main.buttons.read_more') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </section>

        <section id="mission" class="section mission-section">
            <div class="container">
                <div class="mission-vision">
                    <div class="mission">
                        <h3 style="color:#000;">{{ __('main.titles.mission') }}</h3>
                        <div class="icon-wrapper"><i class="far fa-lightbulb"></i></div>
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
                        <h3 style="color:#000;">{{ __('main.titles.vision') }}</h3>
                        <div class="icon-wrapper"><i class="fas fa-crosshairs"></i></div>
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

        <section id="target" class="section target-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.target') }}</h2>
                <div class="target-icon"><i class="fas fa-users" style="color:#000;"></i></div>
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
                    {!! $targetContent !!}
                </div>
            </div>
        </section>

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
                    <a href="{{ route('sections', ['locale' => $loc]) }}"
                        class="btn">{{ __('main.buttons.discover') }}</a>
                </div>
            </div>
        </section>

        <section id="team" class="section team-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.team') }}</h2>
                <div class="team-carousel {{ count($team) <= 1 ? 'single-member' : '' }}" id="teamCarousel">
                    <div class="team-slide">
                        @foreach ($team as $member)
                            <div class="team-member {{ $loop->first ? 'active' : '' }}">
                                <a
                                    href="{{ route('volunteers', ['locale' => $loc, 'vol' => $member['id'] ?? null]) }}">
                                    <img src="{{ asset('storage/' . $member['image']) }}"
                                        alt="{{ $member['name'] }}" style="cursor:pointer;">
                                </a>
                                <h3>{{ $member['name'] }}</h3>
                                @if (!empty($member['skills']))
                                    <div class="member-skills">
                                        @if (is_array($member['skills']))
                                            @foreach ($member['skills'] as $skill)
                                                <span class="skill-tag">{{ $skill }}</span>
                                            @endforeach
                                        @else
                                            <span class="skill-tag">{{ $member['skills'] }}</span>
                                        @endif
                                    </div>
                                @endif
                                <p>{{ $member['bio'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    @if (count($team) > 1)
                        <button class="carousel-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                        <button class="carousel-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
                        <div class="carousel-indicators"></div>
                    @endif
                </div>
            </div>
        </section>

        <section id="partners" class="section partners-section">
            <div class="container">
                <h2 class="section-title">{{ __('main.titles.partners') }}</h2>
                <div class="partners-carousel {{ count($partners) <= 1 ? 'single-partner' : '' }}"
                    id="partnersCarousel">
                    <div class="partners-slide">
                        @foreach ($partners as $partner)
                            <div class="partner {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $partner['image']) }}" alt="{{ $partner['name'] }}">
                                <p>{!! $partner['name'] !!}</p>
                                <p>
                                    @if (is_array($partner['description']))
                                        {!! $partner['description'][$locale] ?? ($partner['description']['en'] ?? '') !!}
                                    @else
                                        {!! $partner['description'] !!}
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-btn" id="partnersPrevBtn"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn" id="partnersNextBtn"><i class="fas fa-chevron-right"></i></button>
                    <div class="carousel-indicators"></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}">
                    <p>{{ __('main.site_name') }}<br>
                        <span style="color:var(--secondary-color);">{{ __('main.site_subname') }}</span>
                    </p>
                </div>

                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('events', ['locale' => $loc]) }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('sections', ['locale' => $loc]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a href="{{ route('compliants', ['locale' => $loc]) }}">{{ __('main.menu.contact') }}</a>
                        </li>
                        <li><a href="#about">{{ __('main.menu.about') }}</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>{{ __('main.footer.contact_us') }}</h4>
                    @if (isset($contactInfo['phones'][0]) && count($contactInfo['phones']) > 0)
                        <p><i class="fas fa-phone"></i> {{ $contactInfo['phones'][0] }}</p>
                    @endif
                    @if (isset($contactInfo['emails'][0]) && count($contactInfo['emails']) > 0)
                        <p><i class="fas fa-envelope"></i> {{ $contactInfo['emails'][0] }}</p>
                    @endif
                    @if (isset($contactInfo['address']))
                        <p><i class="fas fa-map-marker-alt"></i> {{ $contactInfo['address'] }}</p>
                    @endif
                </div>
            </div>

            <div class="footer-bottom">
                <p>{{ __('main.footer.copyright') }} &copy; {{ date('Y') }}</p>
                <div class="social-icons">
                    @if (isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    {{-- @if (isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif --}}
                    @if (isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    {{-- استخدم about-us.js المحسّن (أو welcome.js بنسخته الجديدة) --}}
    <script src="{{ asset('js/about-us.js') }}"></script>

    {{-- سكربت الهيدر الخفيف (إن لم يكن داخل ملف JS خارجي) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('siteHeader');

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
