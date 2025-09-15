<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <title>المركز السوري للتنمية المستدامة - تقديم شكوى</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* ======================
   المتغيرات العامة
   ====================== */
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --accent-color: #5BBA6F;
            --dark-color: #000;
            --dark-color_1: #424040;
            --light-color: #5ad27e;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            --transition: all .3s ease;

            /* ارتفاعات الهيدر + دعم النوتش */
            --header-h: 78px;
            /* Desktop  */
            --header-h-tablet: 112px;
            /* Tablet   */
            --header-h-mobile: 160px;
            /* Mobile   */
            --safe-top: env(safe-area-inset-top, 0px);
        }

        /* ======================
   قواعد أساسية + الحاوية
   ====================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            background: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* حاوية عامة بعرض متكيّف */
        .container {
            width: min(100% - 32px, 1400px);
            /* حواف 16px على الجانبين تلقائياً */
            margin-inline: auto;
        }

        /* صور وعناصر وسائط لا تتجاوز العرض */
        img,
        svg,
        video {
            max-width: 100%;
            height: auto
        }

        /* ======================
   الخلفية المتغيّرة
   ====================== */
        .background-slideshow {
            position: fixed;
            inset: 0;
            z-index: -2;
            opacity: .7;
            transition: opacity 1s ease-in-out;
            pointer-events: none;
        }

        .background-slideshow img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .background-slideshow img.active {
            opacity: 1
        }

        /* المحتوى فوق الخلفية */
        .header,
        main {
            position: relative;
            background: rgba(255, 255, 255, .85)
        }

        /* الفوتر صلب غير شفاف */
        .footer {
            background: var(--dark-color_1) !important
        }

        /* ======================
   الهيدر (ديناميكي)
   ====================== */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #fff;
            box-shadow: var(--box-shadow);
            padding: max(10px, var(--safe-top)) 0 10px;
            transition: transform .35s ease, opacity .25s ease;
            will-change: transform;
        }

        .header.is-hidden {
            transform: translateY(calc(-100% - var(--safe-top)));
            opacity: 0;
            pointer-events: none
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(12px, 4vw, 40px);
            padding: 0 12px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: clamp(8px, 1.6vw, 15px)
        }

        .logo img {
            height: clamp(44px, 6vw, 70px);
            width: auto
        }

        .org-name {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            color: var(--primary-color);
            font-weight: 700
        }

        .org-name-line1 {
            font-size: clamp(1.1rem, 2.3vw, 1.5rem);
            white-space: nowrap
        }

        .org-name-line2 {
            font-size: clamp(.85rem, 1.8vw, 1.1rem);
            color: var(--secondary-color);
            white-space: nowrap
        }

        /* التنقل */
        .nav-list {
            display: flex;
            list-style: none;
            gap: clamp(8px, 2vw, 20px);
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-list a {
            display: block;
            text-decoration: none;
            text-align: center;
            white-space: nowrap;
            color: var(--dark-color);
            font-weight: 500;
            padding: clamp(6px, 1.2vw, 8px) clamp(10px, 1.8vw, 15px);
            border-radius: 6px;
            transition: var(--transition);
        }

        .nav-list a:hover {
            color: var(--primary-color);
            background: rgba(46, 134, 171, .1)
        }

        /* زر الدخول/الخروج */
        .login-btn a {
            background: var(--secondary-color);
            color: #fff !important;
            border-radius: 8px;
            padding: clamp(6px, 1.2vw, 8px) clamp(12px, 2vw, 16px);
            text-decoration: none !important;
            transition: var(--transition);
        }

        .login-btn a:hover {
            background: #e07f00
        }

        /* محوّل اللغة */
        .language-switcher {
            position: relative;
            display: inline-flex;
            align-items: center;
            list-style: none !important
        }

        .language-btn {
            background: none;
            border: 0;
            cursor: pointer;
            color: var(--dark-color);
            padding: clamp(6px, 1.2vw, 8px) clamp(10px, 1.8vw, 14px);
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .language-btn:hover {
            color: var(--primary-color);
            background: rgba(46, 134, 171, .1)
        }

        .language-menu {
            display: none;
            position: absolute;
            top: 100%;
            inset-inline-end: 0;
            min-width: 160px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, .2);
            z-index: 100;
            list-style: none;
            padding: 10px 0;
            margin-top: 6px;
        }

        .language-switcher:hover .language-menu {
            display: block
        }

        .language-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .language-menu a:hover {
            background: rgba(46, 134, 171, .1);
            color: var(--primary-color)
        }

        @media(hover:none) {
            .language-switcher:hover .language-menu {
                display: none
            }

            .language-switcher.active .language-menu {
                display: block
            }
        }

        /* ======================
   المحتوى الرئيسي (تعويض ديناميكي للهيدر)
   ====================== */
        main {
            min-height: calc(100vh - 180px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0 0;
            padding-top: calc(var(--header-dyn, var(--header-h)) + var(--safe-top) + 8px);
        }

        /* ======================
   نموذج الشكوى + معلومات التواصل
   ====================== */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin-inline: auto;
            padding: 20px
        }

        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: clamp(16px, 3.5vw, 40px);
            transition: all .3s ease;
            width: 100%;
            max-width: clamp(320px, 90vw, 1000px);
            margin: 20px auto;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .form-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
            transform: translateY(-2px)
        }

        .form-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 24px;
            text-align: center;
            font-size: clamp(1.4rem, 3.2vw, 2rem);
        }

        .complaint-form {
            display: flex;
            flex-direction: column;
            gap: 16px
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .form-group label {
            font-weight: 600;
            color: var(--dark-color_1)
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, .95);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, .2);
            outline: 0
        }

        textarea.form-control {
            min-height: 200px;
            resize: vertical
        }

        .submit-btn {
            background: var(--secondary-color);
            color: #fff;
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 1.05rem;
            cursor: pointer;
            font-weight: 700;
            transition: var(--transition);
            margin-top: 6px;
        }

        .submit-btn:hover {
            background: #e07f00;
            transform: translateY(-2px)
        }

        .form-note {
            font-size: .95rem;
            color: var(--dark-color_1);
            text-align: center;
            margin-top: 12px
        }

        .form-header-icon {
            text-align: center;
            font-size: clamp(2rem, 5vw, 3rem);
            color: var(--secondary-color);
            margin-bottom: 16px
        }

        .error-message {
            color: #dc3545;
            font-size: .9rem;
            margin-top: 5px;
            display: none
        }

        .form-control.error {
            border-color: #dc3545
        }

        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center
        }

        /* معلومات التواصل */
        .contact-info-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: clamp(16px, 3.5vw, 40px);
            margin-top: 24px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .contact-info-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 22px;
            font-size: clamp(1.2rem, 2.8vw, 1.8rem);
        }

        .contact-items {
            display: flex;
            justify-content: center;
            gap: clamp(16px, 6vw, 50px);
            flex-wrap: wrap
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: clamp(1rem, 2.6vw, 1.2rem)
        }

        .contact-icon {
            color: var(--secondary-color);
            font-size: clamp(1.2rem, 3.2vw, 1.8rem)
        }

        .working-hours {
            margin-top: 14px;
            font-size: 1.05rem;
            color: var(--dark-color_1)
        }

        /* ======================
   الفوتر
   ====================== */
        .footer {
            color: #fff;
            padding: 50px 0 20px;
            position: relative
        }

        .footer-content {
            display: grid;
            gap: 32px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            width: min(100% - 32px, 1400px);
            margin-inline: auto;
        }

        .footer-section {
            padding: 0 12px
        }

        .footer-logo img {
            height: 90px;
            margin-bottom: 28px
        }

        .footer-about-text {
            line-height: 1.7;
            opacity: .95
        }

        .footer-section h4 {
            color: var(--secondary-color);
            font-size: 1.25rem;
            margin-bottom: 18px;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-section h4::after {
            content: "";
            position: absolute;
            bottom: 0;
            inset-inline-start: 0;
            width: 56px;
            height: 2px;
            background: var(--secondary-color);
        }

        .footer-section.links ul {
            list-style: none
        }

        .footer-section.links li+li {
            margin-top: 10px
        }

        .footer-section.links a {
            color: #fff;
            text-decoration: none;
            transition: color var(--transition), padding var(--transition);
            display: inline-block;
        }

        .footer-section.links a:hover {
            color: var(--secondary-color);
            padding-inline-start: 8px
        }

        .footer-contact .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px
        }

        .footer-contact i {
            color: var(--secondary-color);
            width: 20px;
            text-align: center;
            margin-inline-end: 8px
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        .newsletter-form input {
            padding: 12px 14px;
            border: 0;
            border-radius: 8px;
            background: rgba(255, 255, 255, .9);
        }

        .newsletter-form button {
            background: var(--secondary-color);
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            transition: background var(--transition), transform var(--transition);
        }

        .newsletter-form button:hover {
            background: #e07f00;
            transform: translateY(-1px)
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .12);
            margin-top: 16px;
            padding-top: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            width: min(100% - 32px, 1400px);
            margin-inline: auto;
        }

        .copyright {
            font-size: .95rem;
            opacity: .9
        }

        .social-icons a {
            display: inline-grid;
            place-items: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, .12);
            color: #fff;
            border-radius: 50%;
            transition: transform var(--transition), background var(--transition);
        }

        .social-icons a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px)
        }

        /* ======================
   تجاوبية
   ====================== */
        /* Tablet */
        @media (max-width:992px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-tablet)) + var(--safe-top) + 8px)
            }

            .header {
                padding: 10px 0
            }

            .header .container {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px
            }
        }

        /* Mobile */
        @media (max-width:768px) {
            main {
                padding-top: calc(var(--header-dyn, var(--header-h-mobile)) + var(--safe-top) + 8px)
            }

            .header .container {
                flex-direction: column;
                align-items: center
            }

            .logo-container {
                flex-direction: column;
                text-align: center;
                margin-bottom: 8px
            }

            .nav-list {
                flex-direction: column;
                align-items: center;
                width: 100%
            }

            .nav-list li {
                width: 100%;
                text-align: center
            }

            .nav-list a {
                width: 100%;
                padding: 10px
            }

            .language-menu {
                inset-inline-end: auto;
                inset-inline-start: 0;
                width: 100%
            }
        }

        /* Small phones */
        @media (max-width:576px) {
            .submit-btn {
                padding: 10px;
                font-size: 1rem
            }
        }

        /* تقليل الحركة */
        @media (prefers-reduced-motion:reduce) {
            .header {
                transition: none
            }

            .form-container:hover {
                transform: none
            }

            .background-slideshow,
            .background-slideshow img {
                transition: none
            }
        }
    </style>

</head>

<body>
    <!-- خلفية متغيرة للصفحة -->
    <div class="background-slideshow">
        <img src="{{ asset('/ima1.webp') }}" class="active" alt="خلفية 1">
        <img src="{{ asset('/ima2.webp') }}" alt="خلفية 2">
        <img src="{{ asset('/ima3.webp') }}" alt="خلفية 3">
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="/logo.png" alt="شعار المركز">
                </div>
                <div class="org-name">
                    <span class="org-name-line1" data-translate = "nav.sit_n1">المركز السوري للتنمية المستدامة</span>
                    <span class="org-name-line2" data-translate = "nav.sit_n2">والتمكين المجتمعي</span>
                </div>
            </div>
            <div class="buttons-container">
                <!-- في قسم الشريط العلوي -->
                <nav class="nav">
                    <ul class="nav-list">
                        <li><a href="{{ route('home') }}" data-translate="nav.home">الرئيسية</a></li>
                        <li><a href="{{ route('sections') }}" data-translate="nav.services">الخدمات</a></li>
                        <li><a href="{{ route('events') }}" data-translate="nav.events">النشاطات والفعاليات</a></li>
                        <li class="language-switcher" style="list-style: none;">
                            <button class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span class="current-lang" data-translate="language.current">العربية</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-menu">
                                <li><a href="#" data-lang="ar" data-translate="language.ar"><i
                                            class="fas fa-language"></i> العربية</a></li>
                                <li><a href="#" data-lang="en" data-translate="language.en"><i
                                            class="fas fa-language"></i> English</a></li>
                            </ul>
                        </li>
                        <li class="login-btn">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"data-translate="nav.logout">
                                تسجيل خروج
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

    <main>
        <div class="main-container">
            <!-- نموذج الشكوى المعدل -->
            <div class="form-container">
                <div class="form-header-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <h1 class="form-title">نموذج تقديم الشكاوى</h1>

                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i> تم إرسال شكواك بنجاح، شكراً لك على تواصلك معنا.
                </div>

                <!-- في قسم النموذج -->
                <form class="complaint-form" id="complaintForm" method="POST" action="{{ route('compliants.store') }}">
                    @csrf
                    @auth
                        <input type="hidden" name="id" value="{{ Auth::guard('custom')->id() }}">
                    @endauth

                    <div class="form-group">
                        <label for="email" data-translate="form.email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="example@domain.com" data-translate-placeholder="form.email_placeholder"
                            required>
                        <div class="error-message" id="emailError" data-translate="form.email_error">يرجى إدخال بريد
                            إلكتروني صحيح</div>
                    </div>

                    <div class="form-group">
                        <label for="content" data-translate="form.content">محتوى الشكوى</label>
                        <textarea id="content" name="content" class="form-control" placeholder="يرجى كتابة تفاصيل شكواك هنا..."
                            data-translate-placeholder="form.content_placeholder" required style="min-height: 250px;"></textarea>
                        <div class="error-message" id="contentError" data-translate="form.content_error">يرجى إدخال
                            محتوى الشكوى (10 أحرف على الأقل)</div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> <span data-translate="form.submit">إرسال الشكوى</span>
                    </button>

                    <p class="form-note">
                        <i class="fas fa-info-circle"></i> <span data-translate="form.note">نعدك بمعالجة شكواك بكل
                            سرية واهتمام</span>
                    </p>
                </form>
            </div>

            <!-- قسم جهات الاتصال الجديد مع البيانات الفعلية -->
            <div class="contact-info-container">
                <div class="contact-items">
                    <!-- عرض جميع الهواتف -->
                    @forelse($contactInfo['phones'] ?? [] as $phone)
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <span>{{ $phone }}</span>
                        </div>
                    @empty
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <span>123-456-789</span>
                        </div>
                    @endforelse

                    <!-- عرض جميع الأرقام المحمولة -->
                    @forelse($contactInfo['mobile_numbers'] ?? [] as $mobile)
                        <div class="contact-item">
                            <i class="fas fa-mobile-alt contact-icon"></i>
                            <span>{{ $mobile }}</span>
                        </div>
                    @empty
                        <!-- يمكنك إضافة عرض افتراضي هنا إذا لزم الأمر -->
                    @endforelse

                    <!-- عرض جميع الإيميلات -->
                    @forelse($contactInfo['emails'] ?? [] as $email)
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>{{ $email }}</span>
                        </div>
                    @empty
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>info@example.com</span>
                        </div>
                    @endforelse

                    <!-- عرض العنوان -->
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <span>{{ $contactInfo['address'] ?? 'دمشق، سوريا' }}</span>
                    </div>
                </div>
                {{--
                <!-- عرض ساعات العمل -->
                @if (isset($contactInfo['working_hours']))
                    <div class="working-hours">
                        <i class="fas fa-clock contact-icon"></i>
                        <span>ساعات العمل: {{ $contactInfo['working_hours'] }}</span>
                    </div>
                @endif --}}
            </div>
    </main>


    <!-- تذييل الصفحة مع روابط التواصل الاجتماعي الفعلية -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تغيير خلفية الصفحة تلقائياً
            const backgroundImages = document.querySelectorAll('.background-slideshow img');
            let currentImage = 0;

            if (backgroundImages.length > 0) {
                backgroundImages[0].classList.add('active');
            }

            function changeBackground() {
                backgroundImages[currentImage].classList.remove('active');
                currentImage = (currentImage + 1) % backgroundImages.length;
                backgroundImages[currentImage].classList.add('active');
            }

            if (backgroundImages.length > 1) {
                setInterval(changeBackground, 5000);
            }

            // التحقق من صحة النموذج وإرساله
            const form = document.getElementById('complaintForm');
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Reset errors and success message
                    document.querySelectorAll('.error-message').forEach(el => {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.form-control').forEach(el => {
                        el.classList.remove('error');
                    });
                    document.getElementById('successMessage').style.display = 'none';

                    // Validate form
                    const emailInput = document.getElementById('email');
                    const contentInput = document.getElementById('content');
                    const emailError = document.getElementById('emailError');
                    const contentError = document.getElementById('contentError');

                    let isValid = true;

                    // Email validation
                    if (!emailInput.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                        emailInput.classList.add('error');
                        emailError.style.display = 'block';
                        isValid = false;
                    }

                    // Content validation
                    if (!contentInput.value || contentInput.value.length < 10) {
                        contentInput.classList.add('error');
                        contentError.style.display = 'block';
                        isValid = false;
                    }

                    if (!isValid) return;

                    // Show loading state
                    const submitBtn = form.querySelector('.submit-btn');
                    const originalBtnText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
                    submitBtn.disabled = true;

                    try {
                        // Create FormData object
                        const formData = new FormData(form);

                        // Convert FormData to plain object
                        const plainFormData = Object.fromEntries(formData.entries());

                        // Add date to the form data
                        plainFormData.date = new Date().toISOString().split('T')[0];

                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(plainFormData)
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw data;
                        }

                        if (data.status === 'success') {
                            // Hide form and show success message
                            form.style.display = 'none';
                            document.getElementById('successMessage').style.display = 'block';

                            // Optional: Redirect after 3 seconds
                            setTimeout(() => {
                                window.location.href = "{{ route('compliants') }}";
                            }, 3000);
                        } else {
                            throw new Error(data.message || 'حدث خطأ غير متوقع');
                        }
                    } catch (error) {
                        console.error('Error:', error);

                        // Handle server-side validation errors
                        if (error.errors) {
                            if (error.errors.email) {
                                emailInput.classList.add('error');
                                emailError.textContent = error.errors.email[0];
                                emailError.style.display = 'block';
                            }
                            if (error.errors.content) {
                                contentInput.classList.add('error');
                                contentError.textContent = error.errors.content[0];
                                contentError.style.display = 'block';
                            }
                        } else {
                            alert(error.message ||
                                'حدث خطأ أثناء إرسال الشكوى، يرجى المحاولة مرة أخرى');
                        }
                    } finally {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    }
                });
            }

            const translations = {
                en: {
                    nav: {
                        sit_n1: "Syrian Center for Sustainable Development",
                        sit_n2: 'and Community Empowerment',
                        home: "Home",
                        services: "Services",
                        events: "Events",
                        complaints: "Contact Us",
                        logout: "Logout"
                    },
                    form: {
                        email: "Email",
                        email_placeholder: "example@domain.com",
                        email_error: "Please enter a valid email address",
                        content: "Complaint Content",
                        content_placeholder: "Please write your complaint details here...",
                        content_error: "Please enter complaint content (at least 10 characters)",
                        submit: "Submit Complaint",
                        note: "We promise to handle your complaint with confidentiality and care",
                    },
                    footer: {
                        copyright: "&copy; 2023 Syrian Center for Sustainable Development. All rights reserved.",
                        quick_links: "Quick Links"
                    },
                    language: {
                        current: "English",
                        ar: "Arabic",
                        en: "English"
                    }
                },
                ar: {
                    nav: {
                        sit_n1: 'المركز السوري للتنمية المستدامة',
                        sit_n2: 'والتمكين المجتمعي',
                        home: "الرئيسية",
                        services: "الخدمات",
                        events: "النشاطات والفعاليات",
                        complaints: "اتصل بنا",
                        logout: "تسجيل خروج"
                    },
                    form: {
                        email: "البريد الإلكتروني",
                        email_placeholder: "example@domain.com",
                        email_error: "يرجى إدخال بريد إلكتروني صحيح",
                        content: "محتوى الشكوى",
                        content_placeholder: "يرجى كتابة تفاصيل شكواك هنا...",
                        content_error: "يرجى إدخال محتوى الشكوى (10 أحرف على الأقل)",
                        submit: "إرسال الشكوى",
                        note: "نعدك بمعالجة شكواك بكل سرية واهتمام"
                    },
                    footer: {
                        copyright: "&copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.",
                        quick_links: "روابط سريعة"
                    },
                    language: {
                        current: "العربية",
                        ar: "العربية",
                        en: "English"
                    }
                }
            };

            // تغيير اللغة
            function changeLanguage(lang) {
                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';

                // تحديث النصوص المترجمة
                document.querySelectorAll('[data-translate]').forEach(element => {
                    const key = element.getAttribute('data-translate');
                    const keys = key.split('.');
                    if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][
                            keys[1]
                        ]) {
                        element.textContent = translations[lang][keys[0]][keys[1]];
                    }
                });

                // تحديث النصوص البديلة
                document.querySelectorAll('[data-translate-placeholder]').forEach(element => {
                    const key = element.getAttribute('data-translate-placeholder');
                    const keys = key.split('.');
                    if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][
                            keys[1]
                        ]) {
                        element.setAttribute('placeholder', translations[lang][keys[0]][keys[1]]);
                    }
                });

                // تحديث اللغة الحالية في زر اللغة
                document.querySelector('.current-lang').textContent = translations[lang].language.current;
            }

            // معالجة تغيير اللغة
            document.querySelectorAll('[data-lang]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    changeLanguage(lang);
                    localStorage.setItem('preferredLanguage', lang);
                });
            });

            // تحميل اللغة المفضلة من localStorage إذا كانت موجودة
            const preferredLanguage = localStorage.getItem('preferredLanguage') || 'ar';
            changeLanguage(preferredLanguage);
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');

            // Load non-critical JS dynamically
            var script = document.createElement('script');
            script.src = "{{ asset('js/article.js') }}";
            script.defer = true;
            document.body.appendChild(script);
        });
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('siteHeader') || document.querySelector('.header');

            // تعويض ارتفاع الهيدر الحقيقي
            function setHeaderPad() {
                if (!header) return;
                document.documentElement.style.setProperty('--header-dyn', header.offsetHeight + 'px');
            }
            setHeaderPad();
            addEventListener('resize', setHeaderPad);
            addEventListener('load', setHeaderPad);

            // أخفِ الهيدر عند أي نزول، وأظهره فقط عند أعلى الصفحة
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
