<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('titles.service_details') }}</title>
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

        /* حاوية المحتوى الرئيسي */
        .service-content-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px 0;
            transition: all 0.3s ease;
        }

        .service-content-container.translucent {
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .service-content-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        /* تنسيقات للعناوين داخل الحاوية */
        .service-content-container .service-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .service-content-container.bordered {
            border: 1px solid #e0e0e0;
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

        /* أنماط تفاصيل الخدمة */
        .service-detail-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
            padding: 20px;
        }

        .service-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            text-align: center;
        }

        .service-image-main {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
        }

        .service-title {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .service-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--dark-color);
            text-align: justify;
            padding: 0 20px;
        }

        /* أنماط المقالات المرتبطة */
        .related-articles {
            margin-top: 60px;
            padding: 40px 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: var(--box-shadow);
        }

        .related-articles-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 1.5rem;
            position: relative;
        }

        .related-articles-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 15px auto;
            border-radius: 2px;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .article-card {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-content {
            padding: 20px;
        }

        .article-title {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .article-excerpt {
            color: var(--dark-color);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .read-more {
            display: inline-block;
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: var(--transition);
        }

        .read-more:hover {
            background-color: #e07f00;
        }

        /* تذييل الصفحة */
        .footer {
            background-color: var(--dark-color_1);
            color: var(--white);
            padding: 60px 0 0;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo img {
            height: 60px;
            width: auto;
            margin-bottom: 20px;
        }

        .footer-links h4,
        .footer-contact h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--secondary-color);
            padding-right: 5px;
        }

        .footer-contact p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .footer-contact i {
            margin-left: 10px;
            color: var(--secondary-color);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
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

            .service-description {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.jpg') }}" class="active" alt="{{ __('main.alt.background1') }}">
        <img src="{{ asset('/ima2.jpg') }}" alt="{{ __('main.alt.background2') }}">
        <img src="{{ asset('/ima3.jpg') }}" alt="{{ __('main.alt.background3') }}">
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}">
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
                        <li class="language-switcher" style="list-style: none;">
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
                <div class="service-detail-container">
                    <div class="service-header">
                       
                    </div>
                    
                    <div class="service-content-container">
                        <h1 class="service-title">{{ $service['name'] }}</h1>
                        
                        <div class="service-description">
                            {!! $service['description'] !!}
                        </div>
                    </div>

                    @if (count($service['articles']) > 0)
                        <div class="related-articles">
                            <h2 class="related-articles-title">{{ __('main.titles.related_articles') }}</h2>
                            <div class="articles-grid">
                                @foreach ($service['articles'] as $article)
                                    <div class="article-card">
                                   
                                        <div class="article-content">
                                            <h3 class="article-title">{{ $article['title'] }}</h3>
                                            <p class="article-excerpt">{!!Str::limit($article['content'], 150) !!}</p>
                                            <a href="{{ route('article.show', $article['id']) }}" class="read-more">{{ __('main.buttons.read_more') }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('/logo.png') }}" alt="{{ __('main.site_name') }}">
                    <p>{{ __('main.site_name') }} - {{ __('main.site_subname') }}</p>
                </div>
                <div class="footer-links">
                    <h4>{{ __('main.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                        <li><a href="{{ route('sections') }}">{{ __('main.menu.services') }}</a></li>
                        <li><a href="{{ route('events') }}">{{ __('main.menu.news') }}</a></li>
                        <li><a href="{{ route('compliants') }}">{{ __('main.menu.contact') }}</a></li>
                    </ul>
                </div>
                <div class="contact-info-container">
                    <h2 class="contact-info-title" style="color: #FF6B00;">{{ __('main.footer.contact_us') }}</h2>
                    <!-- قسم الهواتف -->
                    @if (isset($contactInfo['phones']) && count($contactInfo['phones']) > 0)
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-phone contact-icon" style="color: #FF6B00;"></i>
                            <span>{{ $contactInfo['phones'][0] }}</span>
                        </div>
                    @else
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-phone contact-icon" style="color: #FF6B00;"></i>
                            <span>+963 11 123 4567</span>
                        </div>
                    @endif

                    <!-- قسم البريد الإلكتروني -->
                    @if (isset($contactInfo['emails']) && count($contactInfo['emails']) > 0)
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-envelope contact-icon" style="color: #FF6B00;"></i>
                            <span>{{ $contactInfo['emails'][0] }}</span>
                        </div>
                    @else
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-envelope contact-icon" style="color: #FF6B00;"></i>
                            <span>info@example.com</span>
                        </div>
                    @endif

                    <!-- قسم العنوان -->
                    @if (isset($contactInfo['address']))
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-map-marker-alt contact-icon" style="color: #FF6B00;"></i>
                            <span>{{ $contactInfo['address'] }}</span>
                        </div>
                    @else
                        <div class="contact-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-map-marker-alt contact-icon" style="color: #FF6B00;"></i>
                            <span>دمشق، سوريا - ميدان بناء جريدة تشرين</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ __('main.site_name') }}. {{ __('main.footer.copyright') }}</p>
                <div class="social-icons">
                    @if(isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if(isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}"><i class="fab fa-instagram"></i></a>
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
    </script>
</body>

</html>