<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('titles.events') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* أنماط عامة */
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --accent-color: #5BBA6F;
            --dark-color: #000000;
            --dark-color_1: #424040;
            --light-color: #5ad27e;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* أنماط الخلفية المتغيرة */
        .background-slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.7;
            transition: opacity 1s ease-in-out;
        }

        .background-slideshow img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .background-slideshow img.active {
            opacity: 1;
        }

        /* تأكد من أن المحتوى يظهر فوق الخلفية */
        main,
        .header,
        .footer {
            position: relative;
            background-color: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            width: calc(100% - 60px);
            max-width: 1400px;
            margin: 0 auto;
            padding: 0;
        }

        /* شريط التنقل */
        .header {
            height: 100px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 10px 0;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 70px;
            width: auto;
        }

        .org-name {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            color: var(--primary-color);
            font-weight: bold;
        }

        .org-name-line1 {
            font-size: 1.5rem;
            white-space: nowrap;
        }

        .org-name-line2 {
            font-size: 1.1rem;
            color: var(--secondary-color);
            white-space: nowrap;
        }

        .nav-list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        .nav-list li {
            margin: 0;
        }

        .nav-list a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            padding: 8px 15px;
            transition: var(--transition);
            border-radius: 4px;
            display: block;
            white-space: nowrap;
            text-align: center;
        }

        .nav-list a:hover {
            color: var(--primary-color);
            background-color: rgba(46, 134, 171, 0.1);
        }

        .login-btn a {
            background-color: var(--secondary-color);
            color: var(--white) !important;
            padding: 8px 15px;
            border-radius: 4px;
            margin-right: 60px;
            text-decoration: none !important;
        }

        .login-btn a:hover {
            background-color: #e07f00;
        }

        .language-switcher {
            position: relative;
            margin-right: 0;
            display: inline-flex;
            align-items: center;
            list-style: none !important;
        }

        .language-btn {
            background: none;
            border: none;
            color: var(--dark-color);
            cursor: pointer;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border-radius: 4px;
            transition: var(--transition);
            text-decoration: none;
            font-size: inherit;
        }

        .language-btn:hover {
            color: var(--primary-color);
            background-color: rgba(46, 134, 171, 0.1);
        }

        .language-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            min-width: 150px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            z-index: 100;
            list-style: none;
            padding: 10px 0;
            margin-top: 5px;
        }

        .language-switcher:hover .language-menu {
            display: block;
        }

        .language-menu li a {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .language-menu li a:hover {
            background-color: rgba(46, 134, 171, 0.1);
            color: var(--primary-color);
        }

        /* المحتوى الرئيسي */
        main {
            margin-top: 100px;
            padding: 40px 0;
        }

        .section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: var(--dark-color);
            font-size: 2rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            margin: 15px auto;
            border-radius: 2px;
        }

        /* أنماط الفعاليات */
        .events-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 20px;
        }

        @media (max-width: 1200px) {
            .events-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .events-container {
                grid-template-columns: 1fr;
            }
        }

        .event-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .event-image-container {
            height: 200px;
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        .event-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* أنماط لأنواع الفعاليات */
        .event-type {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-bottom: 10px;
            align-self: flex-start;
        }

        .event-type.festival {
            background-color: #FFD700;
            color: #8B4513;
        }

        .event-type.volunteering {
            background-color: #32CD32;
            color: #006400;
        }

        .event-type.workshop {
            background-color: #1E90FF;
            color: #000080;
        }

        .event-title {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
            color: var(--dark-color_1);
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .event-description {
            margin-bottom: 20px;
            line-height: 1.6;
            color: var(--dark-color);
            flex-grow: 1;
        }

        .read-more-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-block;
            text-decoration: none;
            text-align: center;
            margin-top: auto;
            width: fit-content;
        }

        .read-more-btn {
            align-self: flex-start;
            margin-top: 20px;
        }

        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            overflow-y: auto;
        }

        .modal-content {
            background-color: var(--white);
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            position: relative;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
            transition: var(--transition);
            z-index: 1;
        }

        .close-modal:hover {
            color: var(--secondary-color);
        }

        .modal-image-container {
            height: 300px;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 20px;
            position: relative;
        }

        .modal-title,
        .modal-meta,
        .modal-description,
        .read-more-btn {
            max-width: 100%;
            word-wrap: break-word;
        }

        .modal-meta {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .modal-meta-item {
            background-color: rgba(46, 134, 171, 0.1);
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .modal-description {
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.1rem;
            width: 100%;
        }

           /* أنماط الفوتر المعدلة */
    .footer {
        background-color: var(--dark-color_1);
        color: var(--white);
        padding: 50px 0 0;
        font-size: 1.05rem; /* زيادة حجم الخط العام */
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* زيادة العرض الأدنى للعناصر */
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-logo {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .footer-logo img {
        height: 80px; /* زيادة حجم الشعار */
        width: auto;
        margin-bottom: 20px;
    }

    .footer-logo p {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .footer-links h4,
    .footer-contact h4 {
        font-size: 1.3rem; /* زيادة حجم العناوين */
        margin-bottom: 25px;
        color: var(--secondary-color);
        position: relative;
        padding-bottom: 10px;
    }

    .footer-links h4::after,
    .footer-contact h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--secondary-color);
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 12px; /* زيادة المسافة بين العناصر */
    }

    .footer-links a {
        color: var(--white);
        text-decoration: none;
        transition: var(--transition);
        font-size: 1.05rem;
        display: inline-block;
        padding: 5px 0;
    }

    .footer-links a:hover {
        color: var(--secondary-color);
        transform: translateX(5px);
    }

    .footer-contact p {
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        font-size: 1.05rem;
    }

    .footer-contact i {
        margin-left: 12px;
        font-size: 1.2rem;
        color: var(--secondary-color);
        min-width: 25px;
        text-align: center;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        padding: 25px 0;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .footer-bottom p {
        margin: 0;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
    }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: var(--white);
            margin-right: 10px;
            transition: var(--transition);
        }

        .social-icons a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* التجاوب مع الشاشات الصغيرة */
        @media (max-width: 992px) {
            .header .container {
                flex-direction: column;
                padding: 10px 0;
            }

            .logo-container {
                margin-bottom: 15px;
            }

            .nav-list {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-list li {
                margin: 5px;
            }
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 20px auto;
                padding: 20px;
            }

            .modal-image-container {
                height: 200px;
            }

            .modal-meta-item {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('ima1.jpg') }}" class="active" alt="{{ __('main.background_alt_1') }}">
        <img src="{{ asset('ima2.jpg') }}" alt="{{ __('main.background_alt_2') }}">
        <img src="{{ asset('ima3.jpg') }}" alt="{{ __('main.background_alt_3') }}">
    </div>

    <header class="header">
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
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
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
                        <li class="login-btn"><a href="/logout">{{ __('main.buttons.logout') }}</a></li>
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
                    @foreach($events as $event)
                    <div class="event-card">
                        <div class="event-image-container">
                            @if($event['cover_image'])
                                <img src="{{ asset('storage/' . $event['cover_image']) }}" alt="{{ $event['title'] }}" class="event-image">
                            @else
                                <img src="{{ asset('default-event.jpg') }}" alt="{{ __('events.default_image_alt') }}" class="event-image">
                            @endif
                           
                        </div>
                        <div class="event-content">
                         <span class="event-type {{ $event['type'] }}" style="margin-bottom: 15px; display: inline-block;">
                @if($event['type'] == 'festival') {{ __('main.events.festival') }}
                @elseif($event['type'] == 'volunteering') {{ __('main.events.volunteering') }}
                @elseif($event['type'] == 'workshop') {{ __('main.events.workshop') }}
                @endif
            </span>

                            <h3 class="event-title">{{ $event['title'] ?? 'No title available' }}</h3>

                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ __('main.menu.start_date') }}: {{ $event['start_date']->format('Y-m-d') }}</span>
                                </div>

                                <div class="event-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ __('main.menu.end_date') }}: {{ $event['end_date']->format('Y-m-d') }}</span>
                                </div>

                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $event['location'] }}</span>
                                </div>
                            </div>

                            <p class="event-description">
                                {!! Str::limit(strip_tags($event['description'], 100)) !!}
                            </p>
                            <button class="read-more-btn" onclick="openEventModal({{ $event['id'] }})">{{ __('main.menu.read_more') }}</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- نافذة التفاصيل العائمة -->
    @foreach($events as $event)
    <div id="eventModal{{ $event['id'] }}" class="event-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEventModal({{ $event['id'] }})">&times;</span>

            <span class="event-type {{ $event['type'] }}" style="margin-bottom: 15px; display: inline-block;">
                @if($event['type'] == 'festival') {{ __('main.events.festival') }}
                @elseif($event['type'] == 'volunteering') {{ __('main.events.volunteering') }}
                @elseif($event['type'] == 'workshop') {{ __('main.events.workshop') }}
                @endif
            </span>

            <h2 class="modal-title">{{ $event['title'] }}</h2>

            <div class="modal-meta">
                <div class="modal-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <div>
                        <strong>{{ __('main.menu.start_date') }}:</strong>
                        <p>{{ $event['start_date']->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                <div class="modal-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <div>
                        <strong>{{ __('main.menu.end_date') }}:</strong>
                        <p>{{ $event['end_date']->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                <div class="modal-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>{{ __('main.events.location') }}:</strong>
                        <p>{{ $event['location'] }}</p>
                    </div>
                </div>

                @if($event['max_participants'])
                <div class="modal-meta-item">
                    <i class="fas fa-users"></i>
                    <div>
                        <strong>{{ __('main.events.max_participants') }}:</strong>
                        <p>{{ $event['max_participants'] }}</p>
                    </div>
                </div>
                @endif
            </div>

            @if($event['description'])
            <div class="modal-description">
                <h3>{{ __('main.events.description') }}:</h3>
                <p class="event-description">
                    {!! Str::limit(strip_tags($event['description'], 100)) !!}
                </p>            </div>
            @endif
        </div>
    </div>
    @endforeach

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
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                    </ul>
                </div>
    
                <!-- قسم معلومات الاتصال -->
               
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


    <script>
        // تغيير خلفية الصفحة تلقائياً
        document.addEventListener('DOMContentLoaded', function() {
            const backgroundImages = document.querySelectorAll('.background-slideshow img');
            let currentImage = 0;

            function changeBackground() {
                backgroundImages[currentImage].classList.remove('active');
                currentImage = (currentImage + 1) % backgroundImages.length;
                backgroundImages[currentImage].classList.add('active');
            }

            // بدء التغيير التلقائي
            setInterval(changeBackground, 5000);

            // تبديل اللغة
            document.querySelectorAll('.language-menu a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    const url = new URL(window.location.href);
                    url.searchParams.set('lang', lang);
                    window.location.href = url.toString();
                });
            });
        });

        // وظائف نافذة التفاصيل العائمة
        function openEventModal(eventId) {
            document.getElementById('eventModal' + eventId).style.display = 'block';
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
        }

        function closeEventModal(eventId) {
            document.getElementById('eventModal' + eventId).style.display = 'none';
            document.body.style.overflow = 'auto';
            document.body.style.position = 'static';
        }

        // إغلاق النافذة عند النقر خارجها
        window.onclick = function(event) {
            document.querySelectorAll('.event-modal').forEach(modal => {
                if (event.target == modal) {
                    closeEventModal(modal.id.replace('eventModal', ''));
                }
            });
        }

        // إغلاق النافذة عند الضغط على زر Escape
        document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                document.querySelectorAll('.event-modal').forEach(modal => {
                    if (modal.style.display == 'block') {
                        closeEventModal(modal.id.replace('eventModal', ''));
                    }
                });
            }
        };
    </script>
</body>
</html>
