<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - التمكين المجتمعي</title>
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
            line-height: 2;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, 'Arial', sans-serif;
            }

        .container {
            width: calc(100% - 60px); /* 30px من كل جانب */
    max-width: 1400px;
    margin: 0 auto;
    padding: 0;
        }

        /* شريط التنقل - معدل */
        .header {
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
    gap: 40px; /* زيادة المسافة بين العناصر */
    padding: 0 20px; /* إضافة حشو داخلي */
            /* إضافة فراغ بين العناصر */
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
            /* فراغ متساوي بين عناصر القائمة */

        }

        .nav-list li {
            margin-left: 15px;
            margin: 0;
            /* إزالة الهوامش الجانبية */

        }

        .nav-list a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            padding: 8px 15px;
            /* تعديل الحشو ليكون أكثر تناسقاً */
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
            margin-right: 60px; /* إبعاده عن العناصر الأخرى */
        }

        .login-btn a:hover {
            background-color: #e07f00;
        }

        /* إضافة أنماط القائمة المنسدلة */
        .dropdown {
            position: relative;
            display: inline-block;
            margin-right: 0;
            /* إزالة أي هوامش إضافية */

        }

        .dropbtn {
            padding: 8px 12px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--white);
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
            text-align: right;
            right: 0;
        }

        .dropdown-content a {
            color: var(--dark-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: var(--transition);
        }

        .dropdown-content a:hover {
            background-color: rgba(46, 134, 171, 0.1);
            color: var(--primary-color);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        /* أنماط محول اللغة المعدلة */
.language-switcher {
    position: relative;
    margin-right: 0;
    display: inline-flex; /* بدلاً من flex لعدم التأثير على العناصر الأخرى */
    align-items: center;
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
    margin-top: 5px; /* هامش بسيط */
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
        /* تلوين كلمة شركاؤنا */
        /* المحتوى الرئيسي */
        main {
            margin-top: 80px;
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

        /* أنماط الصورة الفنية */
        .about-container {
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .about-image {
            flex: 1;
            min-width: 300px;
            perspective: 1000px;
        }

        .about-image-card {
            position: relative;
            width: 100%;
            padding-top: 75%;
            transform-style: preserve-3d;
            transition: var(--transition);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
        }

        .about-image-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
        }

        .about-image-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            transition: var(--transition);
        }

        .about-image-card:hover img {
            transform: scale(1.05);
        }

        .about-image-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.3), transparent 40%);
            border-radius: 15px;
        }

        .about-content {
            flex: 1;
            min-width: 300px;
            text-align: right;
            padding: 20px;
            font-weight: bold;

        }

        /* أنماط زر قراءة المزيد */
        .read-more-btn-container {
            text-align: left;
            /* محاذاة الزر لليسار */
            margin-top: 20px;
            /* مسافة من الأعلى */
        }

        .read-more-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: var(--transition);
            border: 2px solid var(--primary-color);
        }

        .read-more-btn:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* قسم الرسالة والرؤية */
        .mission-section {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .mission-vision {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .mission,
        .vision {
            flex: 1;
            min-width: 300px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: bold;

        }

        .mission:hover,
        .vision:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.2);
        }

        .mission h3,
        .vision h3 {
            margin-bottom: 20px;
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        /* قسم الفئة المستهدفة */
        .target-icon {
            text-align: center;
            margin: 20px 0;
            color: #2c3e50;
            font-size: 50px;
        }

        .target-icon i:hover {
            transform: scale(1.1);
            transition: 0.3s;
        }

        .target-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
            font-weight: bold;

        }

        /* قسم ما نقدمه */
        .services-section {
            background-color: var(--accent-color);
            color: var(--white);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .service-card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-10px);
            background-color: rgba(255, 255, 255, 0.2);
        }

        .service-card i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }

        .service-card h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        /* قسم فريقنا المحسن */
        .team-section {
            background-color: #f8f9fa;
            overflow: hidden;
            padding: 60px 0;
        }

        .team-carousel {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            height: 500px;
            perspective: 1000px;
        }

        .team-slide {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .team-member {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 20px;
            text-align: center;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .team-member.active {
            opacity: 1;
            transform: scale(1);
            z-index: 10;
        }

        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 5px solid var(--secondary-color);
            transition: all 0.5s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .team-member:hover img {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .team-member h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .team-member p {
            color: var(--dark-color);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .team-member p:last-of-type {
            margin-top: 15px;
            font-style: italic;
            color: #666;
        }

        /* قسم الشركاء المحسن */
        .partners-section {
            background-color: var(--primary-color);
            color: var(--white);
            overflow: hidden;
            padding: 60px 0;
        }

        .partners-carousel {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            height: 500px;
            perspective: 1000px;
        }

        .partners-slide {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .partner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 20px;
            text-align: center;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .partner.active {
            opacity: 1;
            transform: scale(1);
            z-index: 10;
        }

        .partner img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 5px solid var(--secondary-color);
            transition: all 0.5s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .partner:hover img {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .partner h3 {
            color: var(--white);
            margin-bottom: 10px;
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .partner p {
            color: var(--white);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .partner p:last-of-type {
            margin-top: 15px;
            font-style: italic;
            color: rgba(255, 255, 255, 0.8);
        }

        /* أزرار ومؤشرات الشرائح المشتركة */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
            z-index: 20;
            border-radius: 50%;
            font-size: 1.5rem;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .carousel-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-50%) scale(1.1);
        }

        #prevBtn {
            right: 20px;
        }

        #nextBtn {
            left: 20px;
        }

        #partnersPrevBtn {
            right: 20px;
        }

        #partnersNextBtn {
            left: 20px;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 20;
        }

        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background-color: var(--secondary-color);
            transform: scale(1.2);
        }

        .btn {
            display: inline-block;
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn:hover {
            background-color: #e07f00;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .mission-vision {
            display: flex;
            gap: 30px;
            justify-content: center;
        }

        .mission,
        .vision {
            text-align: center;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            width: 45%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mission h3,
        .vision h3 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .icon-wrapper {
            margin: 15px 0;
            font-size: 4rem;
            color: #040404;
        }

        .mission p,
        .vision p {
            line-height: 1.6;
            color: #020202;
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

            .mission,
            .vision {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .mission-vision {
                flex-direction: column;
            }

            .footer-content {
                flex-direction: column;
            }

            .team-carousel,
            .partners-carousel {
                height: 350px;
            }

            .team-member img,
            .partner img {
                width: 150px;
                height: 150px;
            }

            /* تعديلات القائمة المنسدلة للهواتف */
            .dropdown-content {
                position: static;
                width: 100%;
            }

            .dropdown:hover .dropdown-content {
                display: none;
            }

            .dropdown.active .dropdown-content {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="\ima1.jpg" class="active" alt="خلفية 1">
        <img src="\ima2.jpg" alt="خلفية 2">
        <img src="\ima3.jpg" alt="خلفية 3">
    </div>

    <!-- شريط التنقل العلوي المعدل -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="\logo.png" alt="شعار المركز">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">المركز السوري للتنمية المستدامة</span>
                    <span class="org-name-line2">والتمكين المجتمعي</span>
                </div>
            </div>
            <div class="buttons-container">
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('sections') }}">الخدمات</a></li>
                    <li><a href="{{ route('events') }}">النشاطات والفعاليات </a></li>
                    <li><a href="contact.html">اتصل بنا</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">أخرى <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="#mission">الرؤية والرسالة</a>
                            <a href="#target">الفئة المستهدفة</a>
                            <a href="#services">مجالاتنا</a>
                            <a href="#team">فريقنا</a>
                            <a href="#partners">شركاؤنا</a>
                        </div>
                    </li>
                    <li class="language-switcher">
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
        <!-- قسم من نحن -->
        <section id="about" class="section about-section">
        <div class="container">
            <h2 class="section-title">من نحن</h2>
            <div class="about-container">
                <div class="about-image">
                    <div class="about-image-card">
                        <img src="/image1.jpg" alt="صورة تمثل أعمال المركز السوري للتنمية المستدامة">
                    </div>
                </div>
                <div class="about-content">
                    @php
                    // التحقق مما إذا كان $aboutUs موجودًا وغير فارغ
                    if (!empty($aboutUs)) {
                        // استخراج المحتوى العربي فقط (يمكن تعديل النمط حسب احتياجاتك)
                        $arabicContent = preg_replace('/[^\p{Arabic}\s]/u', '', $aboutUs->content);
                
                        // تقسيم النص إلى كلمات
                        $words = preg_split('/\s+/', $arabicContent);
                
                        // أخذ أول 40 كلمة
                        $shortContent = implode(' ', array_slice($words, 0, 40));
                
                        // إضافة نقاط (...) إذا كان النص الأصلي أطول
                        if (count($words) > 40) {
                            $shortContent .= '...';
                        }
                    } else {
                        // القيمة الافتراضية إذا كان $aboutUs فارغًا
                        $shortContent = "المركز السوري للتنمية المستدامة والتمكين المجتمعي هو منظمة غير حكومية تهدف إلى دعم التنمية المستدامة في سوريا من خلال برامج ومشاريع تنموية...";
                    }
                @endphp
                <p>{{ $shortContent }}</p>
                    <!-- زر قراءة المزيد -->
                    <div class="read-more-btn-container">
                        <a href="{{ route('about-us') }}" class="read-more-btn">قراءة المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- قسم الرسالة والرؤية -->
        <section id="mission" class="section mission-section">
            <div class="container">
                <div class="mission-vision">
                    <div class="mission">
                        <h3 style="color: #000;">رسالتنا</h3>
                        <div class="icon-wrapper">
                            <i class="far fa-lightbulb"></i>
                        </div>
                        <p>{{ $message->content ?? 'المحتوى غير متوفر حالياً' }}</p>
                    </div>
                    <div class="vision">
                        <h3 style="color: #000;">رؤيتنا</h3>
                        <div class="icon-wrapper">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        <p>{{ $vision->content ?? 'المحتوى غير متوفر حالياً' }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- قسم الفئة المستهدفة -->
        <section id="target" class="section target-section">
            <div class="container">
                <h2 class="section-title">الفئة المستهدفة</h2>
                <div class="target-icon">
                    <i class="fas fa-users" style="color: #000;"></i>
                </div>
                <div class="target-content">
                    <p>{{ $targetgroup->content ?? 'المحتوى غير متوفر حالياً' }}</p>
                </div>
            </div>
        </section>

        <!-- قسم ما نقدمه -->
        <section id="services" class="section services-section">
            <div class="container">
                <h2 class="section-title"> مجالاتنا </h2>
                <div class="services-grid">
                    <div class="service-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>التعليم والتمكين </h3>
                        <p>تمكين الأفراد والمجتمعات من تعزيز قدراتهم على الصمود والمساهمة في بناء المستقبل </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-chart-line"></i>
                        <h3>التنمية والإسكان </h3>
                        <p>تحسين سبل العيش وتعزيز الاستقرار المجتمعي من خلال دعم الفرص المدرة للدخل </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-seedling"></i>
                        <h3> البيئة </h3>
                        <p> تعزيز التنمية الزراعية والحفاظ على الموارد الطبيعية </p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="services.html" class="btn">اكتشف المزيد من خدماتنا</a>
                </div>
            </div>
        </section>

        <!-- قسم فريقنا المحسن -->
        <section id="team" class="section team-section">
            <div class="container">
                <h2 class="section-title">فريقنا</h2>
                <div class="team-carousel">
                    <button class="carousel-btn" id="prevBtn"><i class="fas fa-chevron-right"></i></button>
                    <button class="carousel-btn" id="nextBtn"><i class="fas fa-chevron-left"></i></button>
                    <div class="team-slide" id="teamCarousel">
                        <div class="team-member">
                            <img src="/team1.jpg" alt="عضو الفريق">
                            <h3>محمد أحمد</h3>
                            <p>مدير المركز</p>
                            <p>خبرة أكثر من 15 سنة في مجال التنمية المستدامة</p>
                        </div>
                        <div class="team-member">
                            <img src="/team2.jpg" alt="عضو الفريق">
                            <h3>سارة محمد</h3>
                            <p>منسقة المشاريع</p>
                            <p>متخصصة في التمكين المجتمعي وتنمية المرأة</p>
                        </div>
                        <div class="team-member">
                            <img src="/team3.jpg" alt="عضو الفريق">
                            <h3>علي حسن</h3>
                            <p>خبير بيئي</p>
                            <p>متخصص في الحفاظ على الموارد الطبيعية</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- قسم الشركاء الجديد -->
        <section id="partners" class="section partners-section">
            <div class="container">
                <h2 class="section-title">شركاؤنا</h2>
                <div class="partners-carousel">
                    <button class="carousel-btn" id="partnersPrevBtn"><i class="fas fa-chevron-right"></i></button>
                    <button class="carousel-btn" id="partnersNextBtn"><i class="fas fa-chevron-left"></i></button>
                    <div class="partners-slide" id="partnersCarousel">
                        <div class="partner">
                            <img src="/partner1.jpg" alt="شريك 1">
                            <h3>منظمة الأمم المتحدة</h3>
                            <p>شريك استراتيجي في برامج التنمية المستدامة</p>
                            <p>نعمل معاً منذ 2015 على تنفيذ مشاريع التنمية المجتمعية</p>
                        </div>
                        <div class="partner">
                            <img src="/partner2.jpg" alt="شريك 2">
                            <h3>الصندوق الدولي للتنمية</h3>
                            <p>داعم رئيسي لبرامج التمكين الاقتصادي</p>
                            <p>ساهموا في تمويل 10 مشاريع لتحسين سبل العيش</p>
                        </div>
                        <div class="partner">
                            <img src="/partner3.jpg" alt="شريك 3">
                            <h3>جمعية الهلال الأحمر</h3>
                            <p>شريك في البرامج الإنسانية والتنموية</p>
                            <p>تعاون مشترك في تقديم المساعدات الإنسانية</p>
                        </div>
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
                    <img src="\logo.png" alt="شعار المركز السوري للتنمية المستدامة">
                    <p>المركز السوري للتنمية المستدامة و التمكين المجتمعي</p>
                </div>
                <div class="footer-links">
                    <h4>روابط سريعة</h4>
                    <ul>
                        <li><a href="#home">النشاطات والفعاليات</a></li>
                        <li><a href="#home">الخدمات</a></li>
                        <li><a href="#about">من نحن</a></li>
                        <li><a href="#services">مجالاتنا</a></li>
                        <li><a href="#team">فريقنا</a></li>
                        <li><a href="#partners">شركاؤنا</a></li>
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

            setInterval(changeBackground, 5000);

            // تهيئة كاروسيل فريق العمل
            initCarousel('teamCarousel', 'prevBtn', 'nextBtn');

            // تهيئة كاروسيل الشركاء
            initCarousel('partnersCarousel', 'partnersPrevBtn', 'partnersNextBtn');

            // لجعل القائمة المنسدلة تعمل على الأجهزة المحمولة
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                if (window.innerWidth <= 768) {
                    const dropbtn = dropdown.querySelector('.dropbtn');
                    dropbtn.addEventListener('click', function() {
                        dropdown.classList.toggle('active');
                    });
                }
            });

            // إغلاق القوائم المنسدلة عند النقر خارجها
            document.addEventListener('click', function(event) {
                if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            });

            // دالة عامة لتهيئة الكاروسيل
            function initCarousel(carouselId, prevBtnId, nextBtnId) {
                const carousel = document.getElementById(carouselId);
                const members = carousel.querySelectorAll('.team-member, .partner');
                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                let currentIndex = 0;
                let slideInterval;
                const slideDuration = 5000; // 5 ثواني

                // إنشاء مؤشرات الشرائح
                const indicatorsContainer = document.createElement('div');
                indicatorsContainer.className = 'carousel-indicators';
                carousel.appendChild(indicatorsContainer);

                members.forEach((_, index) => {
                    const indicator = document.createElement('div');
                    indicator.className = 'carousel-indicator';
                    if (index === 0) indicator.classList.add('active');
                    indicator.addEventListener('click', () => goToSlide(index));
                    indicatorsContainer.appendChild(indicator);
                });

                const indicators = carousel.querySelectorAll('.carousel-indicator');

                // تهيئة العرض
                function init() {
                    members.forEach((member, index) => {
                        if (index === 0) {
                            member.classList.add('active');
                        } else {
                            member.style.display = 'none';
                        }
                    });

                    startSlideShow();
                }

                // الانتقال إلى شريحة محددة
                function goToSlide(index) {
                    if (index === currentIndex) return;

                    clearInterval(slideInterval);

                    const prevIndex = currentIndex;
                    currentIndex = index;

                    updateCarousel(prevIndex, currentIndex);
                    startSlideShow();
                }

                // تحريك العرض
                function moveSlide(direction) {
                    clearInterval(slideInterval);

                    const prevIndex = currentIndex;
                    currentIndex = (currentIndex + direction + members.length) % members.length;

                    updateCarousel(prevIndex, currentIndex);
                    startSlideShow();
                }

                // تحديث حالة العرض
                function updateCarousel(prevIndex, newIndex) {
                    // تحديث المؤشرات
                    indicators.forEach((indicator, idx) => {
                        if (idx === newIndex) {
                            indicator.classList.add('active');
                        } else {
                            indicator.classList.remove('active');
                        }
                    });

                    // إخفاء العضو السابق
                    const outgoingMember = members[prevIndex];
                    outgoingMember.classList.remove('active');
                    outgoingMember.style.opacity = '0';
                    outgoingMember.style.transform = 'scale(0.8)';

                    // إظهار العضو الجديد
                    const incomingMember = members[newIndex];
                    incomingMember.style.display = 'block';

                    // تأخير بسيط لضمان التفعيل الصحيح للانتقال
                    setTimeout(() => {
                        incomingMember.classList.add('active');
                        incomingMember.style.opacity = '1';
                        incomingMember.style.transform = 'scale(1)';

                        // إخفاء العضو السابق بعد انتهاء الانتقال
                        setTimeout(() => {
                            outgoingMember.style.display = 'none';
                        }, 800);
                    }, 10);
                }

                // بدء العرض التلقائي
                function startSlideShow() {
                    clearInterval(slideInterval);
                    slideInterval = setInterval(() => {
                        moveSlide(1);
                    }, slideDuration);
                }

                // أحداث الأزرار
                prevBtn.addEventListener('click', () => moveSlide(-1));
                nextBtn.addEventListener('click', () => moveSlide(1));

                // بدء التشغيل
                init();

                // إيقاف العرض التلقائي عند تحويم الماوس
                carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
                carousel.addEventListener('mouseleave', startSlideShow);
            }
        });
    </script>
</body>

</html>
