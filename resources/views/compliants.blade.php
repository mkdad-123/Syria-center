<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - تقديم شكوى</title>
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
            z-index: -2;
            /* تحت كل المحتوى */
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
        .header,
        .footer {
            position: relative;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 1000;
        }

        main {
            position: relative;
            min-height: calc(100vh - 180px);
            /* 100px للهيدر + 80px للفوتر */
            margin-top: 100px;
            /* ارتفاع الهيدر */
            background-color: rgba(255, 255, 255, 0.92);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
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
/* إضافة أنماط جديدة */
.main-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container {
            max-width: 100% !important;
            padding: 50px !important;
            margin-bottom: 30px !important;
        }

        .contact-info-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 30px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .contact-info-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .contact-items {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.2rem;
        }

        .contact-icon {
            color: var(--secondary-color);
            font-size: 1.8rem;
        }

        .working-hours {
            margin-top: 30px;
            font-size: 1.1rem;
            color: var(--dark-color_1);
        }

        @media (max-width: 768px) {
            .form-container,
            .contact-info-container {
                padding: 25px !important;
            }

            .contact-items {
                flex-direction: column;
                gap: 20px;
            }
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

        /* حاوية النموذج الرئيسية */
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 1000px;
            /* تغيير من 800px إلى 1000px */
            margin: 20px auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .form-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .form-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2rem;
        }

        /* أنماط النموذج */
        .complaint-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--dark-color_1);
        }

        .form-control {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.9);
            width: 100%;
            /* إضافة هذه الخاصية */
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, 0.2);
            outline: none;
        }

        textarea.form-control {
            min-height: 200px;
            /* زيادة من 150px إلى 200px */
            resize: vertical;
            width: 100%;
            /* إضافة هذه الخاصية */
        }

        .submit-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #e07f00;
            transform: translateY(-2px);
        }

        .form-note {
            font-size: 0.9rem;
            color: var(--dark-color_1);
            text-align: center;
            margin-top: 20px;
        }

        .form-header-icon {
            text-align: center;
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        /* رسائل التحقق */
        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .success-message {
            display: none;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }

        .footer {
        background-color: var(--dark-color_1);
        color: var(--white);
        padding: 50px 0 20px;
        position: relative;
        height: auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-section {
        padding: 0 20px;
    }

    .footer-section.about {
        grid-column: 1;
    }

    .footer-section.links {
        grid-column: 2;
    }

    .footer-section.newsletter {
        grid-column: 3;
    }

    .footer-logo img {
        height: 100px;
        margin-bottom: 40px;
    }

    .footer-about-text {
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .footer-section h4 {
        color: var(--secondary-color);
        font-size: 1.3rem;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50px;
        height: 2px;
        background-color: var(--secondary-color);
    }

    .footer-section.links ul {
        list-style: none;
    }

    .footer-section.links li {
        margin-bottom: 12px;
    }

    .footer-section.links a {
        color: var(--white);
        text-decoration: none;
        transition: var(--transition);
        display: block;
    }

    .footer-section.links a:hover {
        color: var(--secondary-color);
        padding-right: 10px;
    }

    .footer-contact .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .footer-contact i {
        margin-left: 10px;
        color: var(--secondary-color);
        width: 20px;
        text-align: center;
    }

    .newsletter-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .newsletter-form input {
        padding: 12px 15px;
        border: none;
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.9);
    }

    .newsletter-form button {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
    }

    .newsletter-form button:hover {
        background-color: #e07f00;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .copyright {
        font-size: 0.9rem;
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

    @media (max-width: 992px) {
        .footer-content {
            grid-template-columns: 1fr;
        }

        .footer-section {
            grid-column: auto !important;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 20px;
            text-align: center;
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

            .form-container {
                padding: 25px;
                margin: 20px;
            }

            main {
                margin-top: 120px;
                /* زيادة الهامش للأجهزة الصغيرة */
                padding: 20px 0;
            }

            .footer {
                height: auto;
                padding: 20px 0;
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
        <li><a href="{{ route('compliants') }}" data-translate="nav.complaints">تقديم شكوى</a></li>
        <li class="language-switcher" style="list-style: none;">
            <button class="language-btn">
                <i class="fas fa-globe"></i>
                <span class="current-lang" data-translate="language.current">العربية</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="language-menu">
                <li><a href="#" data-lang="ar" data-translate="language.ar"><i class="fas fa-language"></i> العربية</a></li>
                <li><a href="#" data-lang="en" data-translate="language.en"><i class="fas fa-language"></i> English</a></li>
            </ul>
        </li>
        <li class="login-btn"><a href="/logout" data-translate="nav.login">تسجيل الخروج</a></li>
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
                        placeholder="example@domain.com" data-translate-placeholder="form.email_placeholder" required>
                    <div class="error-message" id="emailError" data-translate="form.email_error">يرجى إدخال بريد إلكتروني صحيح</div>
                </div>

                <div class="form-group">
                    <label for="content" data-translate="form.content">محتوى الشكوى</label>
                    <textarea id="content" name="content" class="form-control"
                        placeholder="يرجى كتابة تفاصيل شكواك هنا..."
                        data-translate-placeholder="form.content_placeholder" required style="min-height: 250px;"></textarea>
                    <div class="error-message" id="contentError" data-translate="form.content_error">يرجى إدخال محتوى الشكوى (10 أحرف على الأقل)</div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> <span data-translate="form.submit">إرسال الشكوى</span>
                </button>

                <p class="form-note">
                    <i class="fas fa-info-circle"></i> <span data-translate="form.note">نعدك بمعالجة شكواك بكل سرية واهتمام</span>
                </p>
            </form>
            </div>

            <!-- قسم جهات الاتصال الجديد مع البيانات الفعلية -->
            <div class="contact-info-container">
                <i class="fas fa-comments"></i> <!-- أيقونة المحادثة -->
                <div class="contact-items">
                    @if(isset($contactInfo['phones']) && count($contactInfo['phones']) > 0)
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <span>{{ $contactInfo['phones'][0] ?? '123-456-789' }}</span>
                        </div>
                    @else
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <span>123-456-789</span>
                        </div>
                    @endif

                    @if(isset($contactInfo['emails']) && count($contactInfo['emails']) > 0)
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>{{ $contactInfo['emails'][0] ?? 'info@example.com' }}</span>
                        </div>
                    @else
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>info@example.com</span>
                        </div>
                    @endif

                    @if(isset($contactInfo['address']))
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <span>{{ $contactInfo['address'] ?? 'دمشق، سوريا' }}</span>
                        </div>
                    @else
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <span>دمشق، سوريا</span>
                        </div>
                    @endif
                </div>

                @if(isset($contactInfo['working_hours']))
                    <div class="working-hours">
                        <i class="fas fa-clock contact-icon"></i>
                        <span>ساعات العمل: {{ $contactInfo['working_hours'] }}</span>
                    </div>
                @endif
            </div>
        </div>
    </main>


    <!-- تذييل الصفحة مع روابط التواصل الاجتماعي الفعلية -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- معلومات المؤسسة -->
                <div class="footer-section about">
                    <div class="footer-logo">
                        <img src="/logo.png" alt="شعار المركز" style="height: 80px;">
                    </div>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+963 11 123 4567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@scsde.org</span>
                        </div>
                    </div>
                </div>

                <!-- روابط سريعة -->
                <div class="footer-section links">
                    <h4 data-translate="footer.quick_links">روابط سريعة</h4>
                    <ul>
                        <li><a href="{{ route('home') }}" data-translate="nav.home">الرئيسية</a></li>
                        <li><a href="{{ route('sections') }}" data-translate="nav.services">الخدمات</a></li>
                        <li><a href="{{ route('events') }}" data-translate="nav.events">الفعاليات</a></li>
                        <li><a href="{{ route('compliants') }}" data-translate="nav.complaints">اتصل بنا</a></li>
                    </ul>
                </div>

            </div>

            <!-- حقوق النشر ووسائل التواصل -->
            <div class="footer-bottom">
                <div class="copyright" data-translate="footer.copyright">
                    &copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.
                </div>
                <div class="social-icons">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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
                    alert(error.message || 'حدث خطأ أثناء إرسال الشكوى، يرجى المحاولة مرة أخرى');
                }
            } finally {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    }

    // ترجمة المحتوى
    const translations = {
        en: {
            nav: {
                sit_n1: "Syrian Center for Sustainable Development",
                sit_n2: 'and Community Empowerment',
                home: "Home",
                services: "Services",
                events: "Events",
                complaints: "Contact Us",
                login: "Logout"
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
                login: "تسجيل الخروج"
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
            if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][keys[1]]) {
                element.textContent = translations[lang][keys[0]][keys[1]];
            }
        });

        // تحديث النصوص البديلة
        document.querySelectorAll('[data-translate-placeholder]').forEach(element => {
            const key = element.getAttribute('data-translate-placeholder');
            const keys = key.split('.');
            if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][keys[1]]) {
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
    </script>
</body>

</html>



