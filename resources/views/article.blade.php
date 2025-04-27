<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - {{ $article->title }}</title>
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
        .article-content-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px 0;
            transition: all 0.3s ease;
        }

        /* إذا كنت تريد خلفية شبه شفافة */
        .article-content-container.translucent {
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .article-content-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        /* تنسيقات للعناوين داخل الحاوية */
        .article-content-container .article-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 2rem;
        }

        /* إذا كنت تريد إضافة حدود */
        .article-content-container.bordered {
            border: 1px solid #e0e0e0;
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--dark-color);
            text-align: justify;
            padding: 0 20px;
        }

        .article-image-main {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .article-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            color: var(--dark-color_1);
            font-size: 0.9rem;
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

            .article-body {
                padding: 0;
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
                <div class="article-content-container">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-image-main">
                    @else
                        <img src="/default-article.jpg" alt="صورة افتراضية" class="article-image-main">
                    @endif
                    
                    <h1 class="article-title">{{ $article->title }}</h1>
                    
                    <div class="article-body">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                    
                    <div class="article-meta">
                        <span>تاريخ النشر: {{ $article->created_at->format('Y-m-d') }}</span>
                        <span>كاتب المقال: {{ $article->author ?? 'إدارة المركز' }}</span>
                    </div>
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