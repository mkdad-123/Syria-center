<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('main.site_subname') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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

    /* طبقة الخلفية البيضاء الشفافة */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: -1;
        pointer-events: none;
    }

    /* خلفية متغيرة للصفحة */
    .background-slideshow {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        opacity: 0.7;
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

    /* تعديل العناصر الرئيسية */
    main, .header, .footer {
        position: relative;
        background-color: transparent;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        color: var(--dark-color);
        line-height: 2;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, 'Arial', sans-serif;
        min-height: 100vh;
    }

        .container {
            width: calc(100% - 60px);
            /* 30px من كل جانب */
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
            gap: 40px;
            /* زيادة المسافة بين العناصر */
            padding: 0 20px;
            /* إضافة حشو داخلي */
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
            margin-right: 60px;
            /* إبعاده عن العناصر الأخرى */
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
            display: inline-flex;
            /* بدلاً من flex لعدم التأثير على العناصر الأخرى */
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
            z-index: 1000;
            /* تأكد من أن القائمة فوق كل العناصر */
            list-style: none;
            padding: 10px 0;
            margin-top: 5px;
        }

        .language-switcher:hover .language-menu,
        .language-menu:hover {
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
    background-color: rgba(255, 255, 255, 0.3);
    padding: 60px 0;
    position: relative;
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
    padding: 60px 0 0; /* إزالة الحشو السفلي */
    margin-bottom: 0; /* إزالة أي هوامش */
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
            height: 110%;
            padding: 24px;
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
/* إضافة هذه الأنماط في قسم CSS */
.team-carousel.single-member,
.partners-carousel.single-partner {
    height: auto !important;
    perspective: none !important;
}

.team-carousel.single-member .team-member,
.partners-carousel.single-partner .partner {
    position: relative !important;
    opacity: 1 !important;
    transform: none !important;
    display: block !important;
}

.team-carousel.single-member .carousel-btn,
.partners-carousel.single-partner .carousel-btn,
.team-carousel.single-member .carousel-indicators,
.partners-carousel.single-partner .carousel-indicators {
    display: none !important;
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

    /* أنماط الفوتر المعدلة */
  /* أنماط الفوتر المعدلة */
.footer {
    background-color: var(--dark-color_1);
    color: var(--white);
    padding: 50px 0 0;
    font-size: 1.05rem;
    margin-top: 0;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
    padding: 0 20px;
}

.footer-logo {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.footer-logo img {
    height: 80px;
    width: auto;
    margin-bottom: 20px;
}

.footer-logo p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.footer-links h4,
.footer-contact h4 {
    font-size: 1.3rem;
    margin-bottom: 20px;
    color: var(--secondary-color);
    padding-bottom: 0; /* إزالة الحشو السفلي */
    position: relative;
}

/* إزالة الخط البرتقالي تحت العناوين */
.footer-links h4::after,
.footer-contact h4::after {
    content: none; /* إزالة الخط البرتقالي */
}

.footer-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 15px;
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
    padding-right: 8px;
}

.footer-contact p {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.05rem;
}

.footer-contact i {
    color: var(--secondary-color);
    font-size: 1.2rem;
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

.social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-icons a {
    width: 40px;
    height: 40px;
    line-height: 40px;
    font-size: 1.1rem;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    color: var(--white);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-icons a:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
}

/* تحسينات للشاشات الصغيرة */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
        text-align: center;
    }

    .footer-logo {
        align-items: center;
    }

    .footer-links,
    .footer-contact {
        text-align: center;
    }

    .footer-contact p {
        justify-content: center;
    }

    .footer-links a:hover {
        padding-right: 0;
        padding-left: 8px;
    }
}
    /* قسم معلومات الاتصال المعدل */
    .contact-info-container {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 25px;
        border-radius: 8px;
        margin-top: 30px;
    }

    .contact-info-title {
        text-align: center;
        margin-bottom: 25px;
        font-size: 1.4rem;
    }

    .contact-item {
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.1rem;
    }

    .contact-icon {
        font-size: 1.3rem;
    }

    /* تحسينات للشاشات الصغيرة */
    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-logo {
            align-items: center;
            text-align: center;
        }

        .footer-links,
        .footer-contact {
            text-align: center;
        }

        .footer-links h4::after,
        .footer-contact h4::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-contact p {
            justify-content: center;
        }

        .contact-info-container {
            padding: 20px;
        }
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

            .user-welcome {
                display: flex;
                align-items: center;
                padding: 0 15px;
                color: var(--primary-color);
                font-weight: 500;
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

    <script>

                // وظيفة لتعيين الكوكي
function setLanguageCookie(lang) {
    // الكوكي سيكون ساري المفعول لمدة 30 يومًا
    document.cookie = `preferred_language=${lang};path=/;max-age=${30 * 24 * 60 * 60}`;
}

// وظيفة لقراءة الكوكي
function getLanguageCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'preferred_language') {
            return value;
        }
    }
    return null;
}
document.addEventListener('DOMContentLoaded', function() {
    const preferredLang = getLanguageCookie();
    const currentLang = '{{ $locale }}';

    if (preferredLang && preferredLang !== currentLang) {
        const url = new URL(window.location.href);
        url.searchParams.set('lang', preferredLang);
        window.location.href = url.toString();
    }
});

        document.addEventListener('DOMContentLoaded', function() {
            // Background slideshow functionality
            const backgroundImages = document.querySelectorAll('.background-slideshow img');
            let currentImage = 0;

            function changeBackground() {
                backgroundImages[currentImage].classList.remove('active');
                currentImage = (currentImage + 1) % backgroundImages.length;
                backgroundImages[currentImage].classList.add('active');
            }

            // Start background slideshow
            setInterval(changeBackground, 5000);

            // Initialize carousels
            initCarousel('teamCarousel', 'prevBtn', 'nextBtn');
            initCarousel('partnersCarousel', 'partnersPrevBtn', 'partnersNextBtn');

            // Enhanced language switcher
            const languageSwitcher = document.querySelector('.language-switcher');
            if (languageSwitcher) {
                const languageBtn = languageSwitcher.querySelector('.language-btn');
                const languageMenu = languageSwitcher.querySelector('.language-menu');

                // Toggle language menu on button click
                languageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = languageMenu.style.display === 'block';
                    languageMenu.style.display = isOpen ? 'none' : 'block';
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!languageSwitcher.contains(e.target)) {
                        languageMenu.style.display = 'none';
                    }
                });

                // Prevent menu from closing when clicking inside it
                languageMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                // Handle language selection
                document.querySelectorAll('.language-menu a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const lang = this.getAttribute('data-lang');

        // حفظ التفضيل في الكوكي
        setLanguageCookie(lang);

        // الانتقال إلى الصفحة نفسها مع معلمة اللغة
        const url = new URL(window.location.href);
        url.searchParams.set('lang', lang);
        window.location.href = url.toString();
    });
});
            }

            // Mobile dropdown handling
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (window.innerWidth <= 768) {
                    const dropbtn = dropdown.querySelector('.dropbtn');
                    dropbtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        dropdown.classList.toggle('active');
                    });
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                }
            });

            // Carousel initialization function
            function initCarousel(carouselId, prevBtnId, nextBtnId) {
                const carousel = document.getElementById(carouselId);
                if (!carousel) return;

                const slides = carousel.querySelectorAll('.team-member, .partner');

                // إذا كان هناك عضو فريق واحد فقط، لا نبدأ الكاروسيل
                if (slides.length <= 1) {
                    // إخفاء أزرار التنقل والمؤشرات
                    const prevBtn = document.getElementById(prevBtnId);
                    const nextBtn = document.getElementById(nextBtnId);
                    const indicatorsContainer = carousel.querySelector('.carousel-indicators');

                    if (prevBtn) prevBtn.style.display = 'none';
                    if (nextBtn) nextBtn.style.display = 'none';
                    if (indicatorsContainer) indicatorsContainer.style.display = 'none';

                    // إظهار العضو الوحيد
                    if (slides.length === 1) {
                        slides[0].classList.add('active');
                        slides[0].style.display = 'block';
                        slides[0].style.opacity = '1';
                        slides[0].style.transform = 'scale(1)';
                    }

                    return; // الخروج من الدالة
                }

                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                let currentIndex = 0;
                let slideInterval;
                const slideDuration = 5000;

                // Create indicators
                const indicatorsContainer = carousel.querySelector('.carousel-indicators');
                if (indicatorsContainer) {
                    slides.forEach((_, index) => {
                        const indicator = document.createElement('div');
                        indicator.className = 'carousel-indicator';
                        if (index === 0) indicator.classList.add('active');
                        indicator.addEventListener('click', () => goToSlide(index));
                        indicatorsContainer.appendChild(indicator);
                    });
                }

                const indicators = carousel.querySelectorAll('.carousel-indicator');

                function init() {
                    slides.forEach((slide, index) => {
                        if (index === 0) {
                            slide.classList.add('active');
                        } else {
                            slide.style.display = 'none';
                        }
                    });
                    startSlideShow();
                }

                function goToSlide(index) {
                    if (index === currentIndex) return;
                    clearInterval(slideInterval);

                    const prevIndex = currentIndex;
                    currentIndex = index;

                    updateCarousel(prevIndex, currentIndex);
                    startSlideShow();
                }

                function moveSlide(direction) {
                    clearInterval(slideInterval);
                    const prevIndex = currentIndex;
                    currentIndex = (currentIndex + direction + slides.length) % slides.length;
                    updateCarousel(prevIndex, currentIndex);
                    startSlideShow();
                }

                function updateCarousel(prevIndex, newIndex) {
                    indicators.forEach((indicator, idx) => {
                        if (idx === newIndex) {
                            indicator.classList.add('active');
                        } else {
                            indicator.classList.remove('active');
                        }
                    });

                    const outgoingSlide = slides[prevIndex];
                    outgoingSlide.classList.remove('active');
                    outgoingSlide.style.opacity = '0';
                    outgoingSlide.style.transform = 'scale(0.8)';

                    const incomingSlide = slides[newIndex];
                    incomingSlide.style.display = 'block';

                    setTimeout(() => {
                        incomingSlide.classList.add('active');
                        incomingSlide.style.opacity = '1';
                        incomingSlide.style.transform = 'scale(1)';

                        setTimeout(() => {
                            outgoingSlide.style.display = 'none';
                        }, 800);
                    }, 10);
                }

                function startSlideShow() {
                    clearInterval(slideInterval);
                    slideInterval = setInterval(() => {
                        moveSlide(1);
                    }, slideDuration);
                }

                if (prevBtn) prevBtn.addEventListener('click', () => moveSlide(-1));
                if (nextBtn) nextBtn.addEventListener('click', () => moveSlide(1));

                init();
                carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
                carousel.addEventListener('mouseleave', startSlideShow);
            }
        });

    </script>

</body>

</html>
