<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - معلومات المتطوع</title>
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

        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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

        /* حاوية معلومات المتطوع */
        .volunteer-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .volunteer-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .volunteer-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2rem;
            width: 100%;
        }

        .volunteer-header-icon {
            text-align: center;
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .volunteer-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-bottom: 30px;
        }

        .volunteer-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--secondary-color);
            margin-bottom: 20px;
            box-shadow: var(--box-shadow);
        }

        .volunteer-name {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .volunteer-profession {
            font-size: 1.2rem;
            color: var(--dark-color_1);
            margin-bottom: 20px;
            background-color: rgba(241, 143, 1, 0.1);
            padding: 5px 15px;
            border-radius: 20px;
        }

        .volunteer-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            width: 100%;
            margin-bottom: 30px;
        }

        .detail-section {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .detail-section h3 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .detail-item {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .detail-icon {
            color: var(--secondary-color);
            font-size: 1.2rem;
            margin-left: 10px;
            margin-top: 3px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark-color_1);
            min-width: 120px;
        }

        .detail-value {
            color: var(--dark-color);
            flex-grow: 1;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .skill-tag {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .status-active {
            color: var(--accent-color);
            font-weight: bold;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }

        .volunteer-actions {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .edit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .edit-btn:hover {
            background-color: #1a6a8a;
            transform: translateY(-2px);
        }

        .download-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
        }

        .download-btn:hover {
            background-color: #4aa762;
            transform: translateY(-2px);
        }

        /* تذييل الصفحة */
        .footer {
            background-color: var(--dark-color_1);
            color: var(--white);
            padding: 20px 0 0;
            height: 80px;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 20px;
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
            padding: 10px 0;
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

            .volunteer-container {
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

            .volunteer-details {
                grid-template-columns: 1fr;
            }

            .volunteer-actions {
                flex-direction: column;
                width: 100%;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
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
                        <li><a href="{{ route('volunteers') }}">المتطوعون</a></li>
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

    <main>
        <div class="main-container">
            <!-- حاوية معلومات المتطوع -->
            <div class="volunteer-container">
                <div class="volunteer-header-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h1 class="volunteer-title">معلومات المتطوع</h1>

                <div class="volunteer-profile">
                    <!-- صورة المتطوع -->
                    @if($volunteer->profile_photo)
                        <img src="{{ asset('storage/' . $volunteer->profile_photo) }}" alt="صورة المتطوع" class="volunteer-photo">
                    @else
                        <img src="/default-profile.jpg" alt="صورة افتراضية" class="volunteer-photo">
                    @endif

                    <h2 class="volunteer-name">{{ $volunteer->name }}</h2>
                    @if($volunteer->profession)
                        <p class="volunteer-profession">{{ $volunteer->profession }}</p>
                    @endif
                </div>

                <div class="volunteer-details">
                    <!-- المعلومات الأساسية -->
                    <div class="detail-section">
                        <h3><i class="fas fa-info-circle"></i> المعلومات الأساسية</h3>

                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-envelope"></i></span>
                            <span class="detail-label">البريد الإلكتروني:</span>
                            <span class="detail-value">{{ $volunteer->email }}</span>
                        </div>

                        @if($volunteer->phone)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-phone"></i></span>
                            <span class="detail-label">رقم الهاتف:</span>
                            <span class="detail-value">{{ $volunteer->phone }}</span>
                        </div>
                        @endif

                        @if($volunteer->national_id)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-id-card"></i></span>
                            <span class="detail-label">رقم الهوية:</span>
                            <span class="detail-value">{{ $volunteer->national_id }}</span>
                        </div>
                        @endif

                        @if($volunteer->birth_date)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-birthday-cake"></i></span>
                            <span class="detail-label">تاريخ الميلاد:</span>
                            <span class="detail-value">{{ $volunteer->birth_date }}</span>
                        </div>
                        @endif

                        @if($volunteer->gender)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-venus-mars"></i></span>
                            <span class="detail-label">الجنس:</span>
                            <span class="detail-value">
                                @if($volunteer->gender == 'male') ذكر
                                @elseif($volunteer->gender == 'female') أنثى
                                @else آخر
                                @endif
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- المعلومات المهنية -->
                    <div class="detail-section">
                        <h3><i class="fas fa-briefcase"></i> المعلومات المهنية</h3>

                        @if($volunteer->profession)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-user-tie"></i></span>
                            <span class="detail-label">المهنة:</span>
                            <span class="detail-value">{{ $volunteer->profession }}</span>
                        </div>
                        @endif

                        @if($volunteer->skills && count(json_decode($volunteer->skills)) > 0)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-tools"></i></span>
                            <span class="detail-label">المهارات:</span>
                            <div class="detail-value">
                                <div class="skills-container">
                                    @foreach(json_decode($volunteer->skills) as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- معلومات التطوع -->
                    <div class="detail-section">
                        <h3><i class="fas fa-calendar-check"></i> معلومات التطوع</h3>

                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-calendar-day"></i></span>
                            <span class="detail-label">تاريخ الانضمام:</span>
                            <span class="detail-value">{{ $volunteer->join_date }}</span>
                        </div>

                        @if($volunteer->availability)
                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-clock"></i></span>
                            <span class="detail-label">التوفر:</span>
                            <span class="detail-value">
                                @if($volunteer->availability == 'full_time') دوام كامل
                                @elseif($volunteer->availability == 'part_time') دوام جزئي
                                @else عطلات نهاية الأسبوع
                                @endif
                            </span>
                        </div>
                        @endif

                        <div class="detail-item">
                            <span class="detail-icon"><i class="fas fa-check-circle"></i></span>
                            <span class="detail-label">الحالة:</span>
                            <span class="detail-value">
                                @if($volunteer->is_active)
                                    <span class="status-active">نشط</span>
                                @else
                                    <span class="status-inactive">غير نشط</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- الملاحظات -->
                @if($volunteer->notes)
                <div class="detail-section" style="width: 100%;">
                    <h3><i class="fas fa-sticky-note"></i> ملاحظات</h3>
                    <p>{{ $volunteer->notes }}</p>
                </div>
                @endif

                <!-- أزرار الإجراءات -->
                <div class="volunteer-actions">
                    @if($volunteer->CV)
                        <a href="{{ asset('storage/' . $volunteer->CV) }}" download class="action-btn download-btn">
                            <i class="fas fa-download"></i> تحميل السيرة الذاتية
                        </a>
                    @endif

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i> تعديل المعلومات
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- تذييل الصفحة مع روابط التواصل الاجتماعي الفعلية -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.</p>
                <div class="social-icons">
                    @if(isset($socialMedia['facebook']))
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(isset($socialMedia['twitter']))
                        <a href="{{ $socialMedia['twitter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(isset($socialMedia['linkedin']))
                        <a href="{{ $socialMedia['linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if(isset($socialMedia['instagram']))
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(isset($socialMedia['youtube']))
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تغيير خلفية الصفحة تلقائياً
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
