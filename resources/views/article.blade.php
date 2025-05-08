<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ $article['title'] }}</title>
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
                        <li><a href="{{ route('about-us') }}">{{ __('main.menu.about') }}</a></li>
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
                        <li class="login-btn">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('main.buttons.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي -->
    <main>
        <section class="section">
            <div class="container">
                <div class="article-content-container">

                    <h1 class="article-title">{{ $article['title'] }}</h1>

                    <div class="article-body">
                        {!! $article['content'] !!}
                    </div>

                    <div class="article-meta">
                        <span>{{ __('main.titles.published_date') }}: {{ \Carbon\Carbon::parse($article['created_at'])->format('Y-m-d') }}</span>
                        @if(isset($article['service']))
                            <span>{{ __('main.titles.service') }}:
                                <a href="{{ route('services', $article['service']['id']) }}?lang={{ $locale }}">
                                    {{ $article['service']['name'] }}
                                </a>
                            </span>
                        @endif
                    </div>
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
                        <li><a href="{{ route('home') }}">{{ __('main.menu.home') }}</a></li>
                    </ul>
                </div>

                <!-- قسم معلومات الاتصال -->

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

        // حفظ التفضيل في الكوكي
        setLanguageCookie(lang);

        // الانتقال إلى الصفحة نفسها مع معلمة اللغة
        const url = new URL(window.location.href);
        url.searchParams.set('lang', lang);
        window.location.href = url.toString();
    });
});
        });
    </script>
</body>

</html>
