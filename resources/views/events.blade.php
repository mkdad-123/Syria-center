<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - الفعاليات</title>
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
            height: 100px; /* يمكنك تغيير هذه القيمة */
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

    modal-title,
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
                        <li><a href="#home">الخدمات</a></li>
                        <li><a href="#about">النشاطات والفعاليات</a></li>
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
                <h1 class="section-title">الفعاليات والنشاطات</h1>
                <div class="events-container">
                    @foreach($events as $event)
                    <div class="event-card">
                        <div class="event-image-container">
                            @if($event->cover_image)
                            <img src="{{ asset('\ima2.jpg') }}" alt="{{ $event->title }}" class="event-image">
                            @else
                            <img src="/default-event.jpg" alt="صورة افتراضية" class="event-image">
                            @endif
                        </div>
                        <div class="event-content">
                            <span class="event-type {{ $event->type }}">
                                @if($event->type == 'festival') مهرجان
                                @elseif($event->type == 'volunteering') تطوع
                                @elseif($event->type == 'workshop') ورشة عمل
                                @endif
                            </span>
                            
                            <h3 class="event-title">{{ $event->title }}</h3>
                            
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>يبدأ: {{ $event->start_date->format('Y-m-d') }}</span>
                                </div>
                                
                                <div class="event-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>ينتهي: {{ $event->end_date->format('Y-m-d') }}</span>
                                </div>
                                
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </div>
                            
                            <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                            
                            <button class="read-more-btn" onclick="openEventModal({{ $event->id }})">المزيد من التفاصيل</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- نافذة التفاصيل العائمة -->
    @foreach($events as $event)
    <div id="eventModal{{ $event->id }}" class="event-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEventModal({{ $event->id }})">&times;</span>
            
            <span class="event-type {{ $event->type }}" style="margin-bottom: 15px; display: inline-block;">
                @if($event->type == 'festival') مهرجان
                @elseif($event->type == 'volunteering') تطوع
                @elseif($event->type == 'workshop') ورشة عمل
                @endif
            </span>
            
            <h2 class="modal-title">{{ $event->title }}</h2>
            
            <div class="modal-meta">
                <div class="modal-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <div>
                        <strong>تاريخ البدء:</strong>
                        <p>{{ $event->start_date->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                
                <div class="modal-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <div>
                        <strong>تاريخ الانتهاء:</strong>
                        <p>{{ $event->end_date->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                
                <div class="modal-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>المكان:</strong>
                        <p>{{ $event->location }}</p>
                    </div>
                </div>
                
                @if($event->max_participants)
                <div class="modal-meta-item">
                    <i class="fas fa-users"></i>
                    <div>
                        <strong>الحد الأقصى للمشاركين:</strong>
                        <p>{{ $event->max_participants }}</p>
                    </div>
                </div>
                @endif
            </div>
            
            @if($event->description)
            <div class="modal-description">
                <h3>تفاصيل الفعالية:</h3>
                <p>{!! nl2br(e($event->description)) !!}</p>
            </div>
            @endif
            
        </div>
    </div>
    @endforeach

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
                        <li><a href="about.html">النشاطات والفعاليات</a></li>
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
        }); // هذه الأقواس كانت ناقصة
    
        // وظائف نافذة التفاصيل العائمة (نقلت خارج DOMContentLoaded)
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