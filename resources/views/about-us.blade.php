<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز السوري للتنمية المستدامة - من نحن</title>
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
            gap: 10px;
        }

        .nav-list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 20px;
            /* فراغ متساوي بين عناصر القائمة */
            list-style: none !important;

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
            text-decoration: none !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        }
        .login-btn a:focus {
        outline: none !important;
        box-shadow: none !important;
    }
        .login-btn a:hover {
            background-color: #e07f00;
        }



        .language-switcher {
    position: relative;
    margin-right: 0;
    display: inline-flex; /* بدلاً من flex لعدم التأثير على العناصر الأخرى */
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

        /* أنماط محتوى "من نحن" */
        .about-content-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: var(--box-shadow);
            margin-bottom: 40px;
        }

        .about-content-container h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .about-content-container p {
            margin-bottom: 20px;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .about-content-container ul {
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .about-content-container li {
            margin-bottom: 10px;
        }

        .about-features {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            flex: 1 1 300px;
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
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
/* هذا سيزيل أي نقاط أو محتوى زائد بالقوة */
* {
    list-style: none !important;
}

.nav-list > li::before, 
.nav-list > li::after {
    content: none !important;
    display: none !important;
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
            .about-content-container {
                padding: 20px;
            }

            .about-features {
                flex-direction: column;
            }

            .footer-content {
                flex-direction: column;
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
                    <li><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li><a href="#home">الخدمات</a></li>
                    <li><a href="#about">النشاطات والفعاليات </a></li>
                    <li><a href="contact.html">اتصل بنا</a></li>
                        </div>
                    </li>
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
        <!-- قسم من نحن -->
        <section class="section">
            <div class="container">
                <h1 class="section-title">من نحن</h1>
                <div class="about-content-container">
                    <!-- هذا القسم سيتم تعبئته من الكونترولر -->
                    <div id="about-content">
                        <!-- المحتوى الديناميكي سيأتي هنا -->
                        <p>{{ $aboutUs->content }}</p>
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

            setInterval(changeBackground, 5000);

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

            // هنا يمكنك إضافة كود لجلب محتوى "من نحن" من الكونترولر
            // مثال:
            /*
            fetch('/api/about')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('about-content').innerHTML = data.content;
                })
                .catch(error => {
                    console.error('Error fetching about content:', error);
                });
            */
        });
    </script>
</body>

</html>
