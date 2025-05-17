<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.site_name') }} - {{ __('volunteer.page_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* أنماط عامة */
        :root {
            --primary-color: #2E86AB;
            --primary-light: #5dade2;
            --secondary-color: #F18F01;
            --secondary-light: #f5b041;
            --accent-color: #5BBA6F;
            --dark-color: #333333;
            --dark-color-1: #555555;
            --light-color: #f8f9fa;
            --white: #ffffff;
            --gray: #e0e0e0;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
        }

        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.8;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* شريط التنقل */
        .header {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 60px;
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
            font-size: 1.4rem;
            white-space: nowrap;
        }

        .org-name-line2 {
            font-size: 1rem;
            color: var(--secondary-color);
            white-space: nowrap;
        }

        .nav-list {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 15px;
            align-items: center;
        }

        .nav-list li {
            margin: 0;
        }

        .nav-list a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            padding: 8px 12px;
            transition: var(--transition);
            border-radius: var(--border-radius);
            display: block;
            white-space: nowrap;
            text-align: center;
            font-size: 0.95rem;
        }

        .nav-list a:hover {
            color: var(--primary-color);
            background-color: rgba(46, 134, 171, 0.1);
        }

        .login-btn a {
            background-color: var(--secondary-color);
            color: var(--white) !important;
            padding: 8px 20px;
            border-radius: var(--border-radius);
            text-decoration: none !important;
            font-weight: 600;
            transition: var(--transition);
        }

        .login-btn a:hover {
            background-color: var(--secondary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(241, 143, 1, 0.3);
        }

        .language-switcher {
            position: relative;
            display: inline-flex;
            align-items: center;
            list-style: none !important;
        }

        .language-btn {
            background: none;
            border: none;
            color: var(--dark-color);
            cursor: pointer;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: var(--transition);
            text-decoration: none;
            font-size: 0.95rem;
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
            min-width: 140px;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            z-index: 100;
            list-style: none;
            padding: 10px 0;
            margin-top: 5px;
        }

        .language-switcher:hover .language-menu {
            display: block;
        }

        .language-menu li a {
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .language-menu li a:hover {
            background-color: rgba(46, 134, 171, 0.1);
            color: var(--primary-color);
        }

        /* المحتوى الرئيسي */
        main {
            margin-top: 90px;
            padding: 40px 0;
            min-height: calc(100vh - 160px);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin: 30px 0 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 100px;
            height: 2px;
            background: var(--secondary-color);
        }

        /* أنماط بطاقة المتطوع */
        .volunteer-header {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
            align-items: center;
            background-color: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .volunteer-image {
            flex: 0 0 180px;
        }

        .volunteer-image img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--secondary-color);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .volunteer-info {
            flex: 1;
            min-width: 250px;
        }

        .volunteer-name {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .volunteer-profession {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .volunteer-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark-color-1);
            background-color: var(--light-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .meta-item i {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        /* تفاصيل المتطوع */
        .volunteer-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-card {
            background-color: var(--white);
            padding: 20px;
            border-radius: var(--border-radius);
            border-right: 4px solid var(--primary-color);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .detail-card h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .detail-card p {
            color: var(--dark-color-1);
            font-size: 0.95rem;
        }

        /* المهارات */
        .skills-container {
            background-color: var(--white);
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-tag {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .skill-tag:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        /* الملاحظات */
        .notes-container {
            background-color: var(--white);
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .notes-container p {
            color: var(--dark-color-1);
            line-height: 1.8;
        }

        /* الأزرار */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 10px 25px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            margin-top: 15px;
            box-shadow: 0 4px 8px rgba(241, 143, 1, 0.3);
        }

        .btn:hover {
            background-color: var(--secondary-light);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(241, 143, 1, 0.4);
        }

        .btn i {
            font-size: 0.9rem;
        }

        /* تذييل الصفحة */
        .footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer p {
            margin: 0;
        }

        /* التجاوب مع الشاشات الصغيرة */
        @media (max-width: 992px) {
            .header .container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-list {
                order: 3;
                width: 100%;
                justify-content: center;
                margin-top: 15px;
            }
        }

        @media (max-width: 768px) {
            .volunteer-header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .volunteer-meta {
                justify-content: center;
            }

            .volunteer-image {
                margin-bottom: 20px;
            }

            .btn {
                width: 100%;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .volunteer-name {
                font-size: 1.6rem;
            }

            .volunteer-profession {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .volunteer-image {
                flex: 0 0 150px;
            }

            .volunteer-image img {
                width: 150px;
                height: 150px;
            }

            .volunteer-meta {
                flex-direction: column;
                align-items: center;
            }

            .meta-item {
                width: 100%;
                justify-content: center;
            }

            .nav-list {
                gap: 8px;
            }

            .nav-list a {
                padding: 6px 10px;
                font-size: 0.85rem;
            }

            .login-btn a {
                padding: 6px 15px;
            }
        }

        /* تأثيرات إضافية */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <!-- شريط التنقل العلوي -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="/logo.png" alt="{{ __('main.site_name') }}">
                </div>
                <div class="org-name">
                    <span class="org-name-line1">{{ __('main.site_name') }}</span>
                    <span class="org-name-line2">{{ __('main.site_subname') }}</span>
                </div>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home', ['lang' => $locale]) }}">{{ __('main.menu.home') }}</a></li>

                    <li class="language-switcher">
                        <button class="language-btn">
                            <i class="fas fa-globe"></i>
                            <span class="current-lang">{{ $locale == 'ar' ? 'العربية' : 'English' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="language-menu">
                            <li><a href="{{ route('volunteers', ['vol' => $volunteer['id'], 'lang' => 'ar']) }}">
                                <i class="fas fa-language"></i> العربية
                            </a></li>
                            <li><a href="{{ route('volunteers', ['vol' => $volunteer['id'], 'lang' => 'en']) }}">
                                <i class="fas fa-language"></i> English
                            </a></li>
                        </ul>
                    </li>

                    @if (Auth::guard('custom')->check())
                        <li class="login-btn">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('main.buttons.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="login-btn">
                            <a href="{{ route('login', ['lang' => $locale]) }}">
                                <i class="fas fa-sign-in-alt"></i> {{ __('main.buttons.login') }}
                            </a>
                        </li>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <!-- المحتوى الرئيسي -->
    <main>
        <div class="container fade-in">
            <div class="volunteer-section">
                <!-- بطاقة المعلومات الأساسية -->
                <div class="volunteer-header">
                    <div class="volunteer-image">
                        <img src="{{ $volunteer['profile_photo'] ? asset('storage/' . $volunteer['profile_photo']) : asset('images/default-avatar.png') }}"
                             alt="{{ $volunteer['name'] }}"
                             onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                    </div>
                    <div class="volunteer-info">
                        <h1 class="volunteer-name">{{ $volunteer['name'] ?? __('volunteer.default_name') }}</h1>
                        <p class="volunteer-profession">{{ $volunteer['profession'] ?? __('volunteer.default_profession') }}</p>

                        <div class="volunteer-meta">
                            @if($volunteer['email'])
                            <div class="meta-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $volunteer['email'] }}</span>
                            </div>
                            @endif

                            @if($volunteer['phone'])
                            <div class="meta-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $volunteer['phone'] }}</span>
                            </div>
                            @endif

                            @if($volunteer['gender'])
                            <div class="meta-item">
                                <i class="fas fa-{{ $volunteer['gender'] == 'male' ? 'male' : 'female' }}"></i>
                                <span>
                                    @if($volunteer['gender'] == 'male')
                                        {{ __('main.volunteer.male') }}
                                    @else
                                        {{ __('main.volunteer.female') }}
                                    @endif
                                </span>
                            </div>
                            @endif

                            @if($volunteer['birth_date'])
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $volunteer['birth_date'] }}</span>
                            </div>
                            @endif

                            @if($volunteer['join_date'])
                            <div class="meta-item">
                                <i class="fas fa-calendar-check"></i>
                                <span>{{ __('main.volunteer.join_date') }}: {{ $volunteer['join_date'] }}</span>
                            </div>
                            @endif
                        </div>

                        @if($volunteer['CV'])
                        <a href="{{ asset('storage/' . $volunteer['CV']) }}" class="btn" download>
                            <i class="fas fa-download"></i> {{ __('volunteer.download_cv') }}
                        </a>
                        @endif
                    </div>
                </div>

                <!-- المعلومات الشخصية -->
                <h2 class="section-title">{{ __('main.volunteer.personal_info') }}</h2>
                <div class="volunteer-details">
                    @if($volunteer['national_id'])
                    <div class="detail-card">
                        <h3>{{ __('main.volunteer.national_id') }}</h3>
                        <p>{{ $volunteer['national_id'] }}</p>
                    </div>
                    @endif

                    @if($volunteer['availability'])
                    <div class="detail-card">
                        <h3>{{ __('main.volunteer.availability') }}</h3>
                        <p>{{ $volunteer['availability'] }}</p>
                    </div>
                    @endif

                </div>

                <!-- المهارات -->
                @if($volunteer['skills'])
                <h2 class="section-title">{{ __('main.volunteer.skills') }}</h2>
                <div class="skills-container">
                    <div class="skills-list">
                        @if(is_array($volunteer['skills']))
                            @foreach($volunteer['skills'] as $skill)
                                @if(trim($skill))
                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                @endif
                            @endforeach
                        @else
                            @foreach(explode(',', $volunteer['skills']) as $skill)
                                @if(trim($skill))
                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif

                <!-- الملاحظات -->
                @if($volunteer['notes'])
                <h2 class="section-title">{{ __('volunteer.notes') }}</h2>
                <div class="notes-container">
                    <p>{{ $volunteer['notes'] }}</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ __('main.site_name') }}. {{ __('main.footer.copyright') }}</p>
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
            // 1. التحقق من تفضيل اللغة عند تحميل الصفحة
            const preferredLang = getLanguageCookie();
            const currentLang = '{{ $locale }}';

            if (preferredLang && preferredLang !== currentLang) {
                const url = new URL(window.location.href);
                url.searchParams.set('lang', preferredLang);
                window.location.href = url.toString();
                return; // الخروج لتجنب تنفيذ باقي الكود أثناء إعادة التوجيه
            }

            // 2. إعداد معالج تغيير اللغة
            const languageSwitcher = document.querySelector('.language-switcher');
            if (languageSwitcher) {
                const languageBtn = languageSwitcher.querySelector('.language-btn');
                const languageMenu = languageSwitcher.querySelector('.language-menu');

                // معالج النقر على زر اللغة
                languageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = languageMenu.style.display === 'block';
                    languageMenu.style.display = isOpen ? 'none' : 'block';
                });

                // إغلاق القائمة عند النقر خارجها
                document.addEventListener('click', function(e) {
                    if (!languageSwitcher.contains(e.target)) {
                        languageMenu.style.display = 'none';
                    }
                });

                // منع إغلاق القائمة عند النقر داخلها
                languageMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                // معالج اختيار اللغة
                document.querySelectorAll('.language-menu a').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const lang = this.getAttribute('data-lang');

                        // حفظ اللغة المختارة في الكوكي
                        setLanguageCookie(lang);

                        // إعادة تحميل الصفحة باللغة الجديدة
                        const url = new URL(window.location.href);
                        url.searchParams.set('lang', lang);
                        window.location.href = url.toString();
                    });
                });
            }

            // 3. إضافة تأثيرات الحركة (ابقيه كما هو)
            const animateElements = document.querySelectorAll('.volunteer-header, .detail-card, .skills-container, .notes-container');
            animateElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('fade-in');
                }, index * 100);
            });
        });
    </script>
</body>
</html>
