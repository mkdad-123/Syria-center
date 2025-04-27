<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - الأقسام</title>
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

        /* أنماط الأقسام */
        .sections-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            padding: 20px;
        }

        @media (max-width: 1200px) {
            .sections-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .sections-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .sections-container {
                grid-template-columns: 1fr;
            }
        }

        .section-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            will-change: transform; /* تحسين الأداء */
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .section-image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .section-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .section-card:hover .section-image {
            transform: scale(1.03);
        }

        .section-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .section-title-card {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
            text-align: center;
        }

        .section-description {
            margin-bottom: 20px;
            line-height: 1.6;
            color: var(--dark-color);
            flex-grow: 1;
            text-align: center;
        }

        .services-count {
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 15px;
            display: inline-block;
            align-self: center;
        }

        .explore-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
            margin-top: auto;
            align-self: center;
        }

        .explore-btn:hover {
            background-color: #e07f00;
            transform: translateY(-2px);
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
        }
    </style>
</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="/ima1.jpg" class="active" alt="خلفية 1">
        <img src="/ima2.jpg" alt="خلفية 2">
        <img src="/ima3.jpg" alt="خلفية 3">
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="/logo.png" alt="شعار المركز">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">المركز السوري للتنمية المستدامة</span>
                    <span class="org-name-line2">والتمكين المجتمعي</span>
                </div>
            </div>
            <div class="buttons-container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('sections') }}">الخدمات</a></li>
                        <li><a href="{{ route('events') }}">النشاطات والفعاليات</a></li>
                        <li><a href="contact.html">اتصل بنا</a></li>
                        <li class="language-switcher" style="list-style: none;">
                            <button class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang">العربية</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar"><i class="fas fa-language"></i> العربية</a></li>
                                <li><a href="#" data-lang="en"><i class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>
                        <li class="login-btn"><a href="/login">تسجيل الدخول</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <section class="section">
            <div class="container">
                <h1 class="section-title">أقسام المركز</h1>
                <div class="sections-container">
                    @foreach($sections as $index => $section)
                    <div class="section-card" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="section-image-container">
                            @if($section->image)
                            <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->name }}" class="section-image">
                            @else
                            <img src="/default-section.jpg" alt="صورة افتراضية" class="section-image">
                            @endif
                        </div>
                        <div class="section-content">
                            <h3 class="section-title-card">{{ $section->name }}</h3>

                            <span class="services-count">{{ $section->services->count() }} خدمة</span>

                            <p class="section-description">{{ Str::limit($section->description, 100) }}</p>

                            <a href="{{ route('services', ['section' => $section->id]) }}" class="explore-btn">استكشف الخدمات</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="/logo.png" alt="شعار المركز السوري للتنمية المستدامة">
                    <p>المركز السوري للتنمية المستدامة و التمكين المجتمعي</p>
                </div>
                <div class="footer-links">
                    <h4>روابط سريعة</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('sections') }}">الأقسام والخدمات</a></li>
                        <li><a href="{{ route('events') }}">الفعاليات</a></li>
                        <li><a href="contact.html">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>تواصل معنا</h4>
                    <p><i class="fas fa-map-marker-alt"></i> سوريا , دمشق , ميدان_بناء جريدة تشرين</p>
                    <p><i class="fas fa-phone"></i> +963 123 456 789</p>
                    <p><i class="fas fa-envelope"></i> info@scsd.org</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
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
        });
    </script>
</body>

</html>
