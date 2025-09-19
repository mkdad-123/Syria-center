<!DOCTYPE html>
<html lang="{{ $locale ?? app()->getLocale() }}" dir="{{ ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="icon" href="{{ asset('logo.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="{{ $locale ?? app()->getLocale() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('main.site_name') }} - {{ __('main.menu.team') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2E86AB;
            --primary-2: #5dade2;
            --secondary: #F18F01;
            --secondary-2: #f5b041;
            --accent: #5BBA6F;
            --dark: #333;
            --dark-2: #555;
            --light: #f8f9fa;
            --white: #fff;
            --shadow: 0 5px 15px rgba(0, 0, 0, .1);
            --radius: 12px;
            --transition: .25s ease;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            margin: 0
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.8
        }

        .container {
            width: 92%;
            max-width: 1200px;
            margin-inline: auto;
            padding-inline: 10px
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            inset-inline: 0;
            background: var(--white);
            box-shadow: var(--shadow);
            z-index: 1000
        }

        .header .row {
            display: flex;
            gap: 18px;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .logo-wrap img {
            height: 56px;
            width: auto
        }

        .brand {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            color: var(--primary);
            font-weight: 700;
            white-space: nowrap
        }

        .brand .sub {
            color: var(--secondary);
            font-size: .95rem;
            font-weight: 700
        }

        .nav ul {
            display: flex;
            gap: 12px;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center
        }

        .nav a {
            display: block;
            text-decoration: none;
            color: var(--dark);
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 600
        }

        .nav a:hover {
            background: rgba(46, 134, 171, .08);
            color: var(--primary)
        }

        /* Auth button */
        .btn-auth {
            background: var(--secondary);
            color: var(--white) !important;
            border-radius: 999px;
            padding: 8px 18px
        }

        .btn-auth:hover {
            background: var(--secondary-2);
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(241, 143, 1, .28)
        }

        /* Language switcher */
        .lang {
            position: relative
        }

        .lang .trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 0;
            background: transparent;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 10px;
            font-weight: 600
        }

        .lang .trigger:hover {
            background: rgba(46, 134, 171, .08);
            color: var(--primary)
        }

        .lang .menu {
            position: absolute;
            top: 100%;
            inset-inline-end: 0;
            background: var(--white);
            min-width: 160px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 8px 6px;
            display: none
        }

        .lang.open .menu {
            display: block
        }

        .lang .menu a {
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 10px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--dark)
        }

        .lang .menu a:hover {
            background: rgba(46, 134, 171, .08);
            color: var(--primary)
        }

        /* Main */
        main {
            padding-top: 96px;
            padding-bottom: 40px;
            min-height: calc(100vh - 160px)
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
            margin: 26px 0 18px;
            position: relative;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--secondary)
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            inset-inline: 0;
            width: 120px;
            height: 2px;
            background: var(--secondary)
        }

        /* Card: header */
        .v-header {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            align-items: center;
            background: var(--white);
            padding: 26px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 22px
        }

        .v-photo {
            flex: 0 0 180px
        }

        .v-photo img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--secondary);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08)
        }

        .v-info {
            flex: 1;
            min-width: 260px
        }

        .v-name {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0 0 8px
        }

        .v-profession {
            font-size: 1.05rem;
            color: var(--secondary);
            font-weight: 700;
            margin: 0 0 14px
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px
        }

        .chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--light);
            color: var(--dark-2);
            padding: 8px 12px;
            border-radius: 999px;
            font-size: .92rem
        }

        /* Grid details */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px
        }

        .card {
            background: var(--white);
            padding: 18px 18px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border-inline-start: 4px solid var(--primary)
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 1.1rem;
            color: var(--primary)
        }

        .card p {
            margin: 0;
            color: var(--dark-2)
        }

        /* Skills */
        .skills {
            background: var(--white);
            padding: 20px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            margin-top: 10px
        }

        .skills-list {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .tag {
            background: var(--primary);
            color: var(--white);
            padding: 6px 12px;
            border-radius: 999px;
            font-size: .85rem
        }

        .tag:hover {
            background: var(--primary-2)
        }

        /* Notes / CV */
        .notes,
        .cv {
            background: var(--white);
            padding: 20px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            margin-top: 10px
        }

        /* Footer */
        .footer {
            background: #222;
            color: #f1f1f1;
            text-align: center;
            padding: 26px 0;
            margin-top: 36px;
            font-size: .95rem
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .v-header {
                flex-direction: column;
                text-align: center
            }

            .chips {
                justify-content: center
            }

            .v-photo {
                margin-bottom: 8px
            }
        }
    </style>
</head>

<body>
    @php
        // تأكيد اللغة الحالية
        $locale = $locale ?? app()->getLocale();

        /**
         * مبدّل البادئة: يبدّل {locale} في أول جزء من المسار مع الحفاظ على نفس الصفحة والـ Query String.
         */
        $swapLocaleUrl = function (string $lang) {
            $segments = request()->segments(); // مثال: ['ar','volunteer','12']
            if (!empty($segments) && in_array($segments[0], ['ar', 'en'], true)) {
                $segments[0] = $lang;
            } else {
                array_unshift($segments, $lang);
            }
            $path = implode('/', $segments);
            $qs = request()->getQueryString();
            return url($path) . ($qs ? '?' . $qs : '');
        };

        /**
         * دالة ترجمة مرنة: تحاول عدة مفاتيح وتعيد أول نتيجة موجودة.
         */
        $t = function (array $keys) {
            foreach ($keys as $k) {
                $v = __($k);
                if ($v !== $k) {
                    return $v;
                }
            }
            return end($keys);
        };

        // خرائط ترجمة لقيم الحقول (مثل availability / gender)
        $genderKey = strtolower((string) ($volunteer['gender'] ?? ''));
        $availKey = strtolower((string) ($volunteer['availability'] ?? ''));

        $genderLabel =
            $genderKey === 'male'
                ? $t(['main.titles.volunteer.male', 'main.volunteer.male'])
                : ($genderKey === 'female'
                    ? $t(['main.titles.volunteer.female', 'main.volunteer.female'])
                    : $volunteer['gender'] ?? '');

        $availabilityLabel = match ($availKey) {
            'full_time' => $t(['main.titles.volunteer.full_time', 'main.volunteer.full_time']),
            'part_time' => $t(['main.titles.volunteer.part_time', 'main.volunteer.part_time']),
            'weekends' => $t(['main.titles.volunteer.weekends', 'main.volunteer.weekends']),
            default => $volunteer['availability'] ?? null,
        };
    @endphp

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="logo-wrap">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('main.site_name') }}">
                    <div class="brand">
                        <span>{{ __('main.site_name') }}</span>
                        <span class="sub">{{ __('main.site_subname') }}</span>
                    </div>
                </div>

                <nav class="nav">
                    <ul>
                        <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('main.menu.home') }}</a>
                        </li>
                        <li><a
                                href="{{ route('sections', ['locale' => $locale]) }}">{{ __('main.menu.services') }}</a>
                        </li>
                        <li><a href="{{ route('events', ['locale' => $locale]) }}">{{ __('main.menu.news') }}</a>
                        </li>
                        <li><a
                                href="{{ route('compliants', ['locale' => $locale]) }}">{{ __('main.menu.contact') }}</a>
                        </li>

                        <li class="lang" id="langSwitcher">
                            <button class="trigger">
                                <i class="fas fa-globe"></i>
                                <span>{{ $locale === 'ar' ? 'العربية' : 'English' }}</span>
                                <i class="fas fa-chevron-down" style="font-size:.85em;"></i>
                            </button>
                            <div class="menu">
                                <a href="{{ $swapLocaleUrl('ar') }}"><i class="fas fa-language"></i> العربية</a>
                                <a href="{{ $swapLocaleUrl('en') }}"><i class="fas fa-language"></i> English</a>
                            </div>
                        </li>

                        @auth('custom')
                            <li>
                                <a class="btn-auth" href="{{ route('logout', ['locale' => $locale]) }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('main.buttons.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', ['locale' => $locale]) }}" method="POST"
                                    style="display:none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li>
                                <a class="btn-auth" href="{{ route('login', ['locale' => $locale]) }}">
                                    <i class="fas fa-sign-in-alt"></i> {{ __('main.buttons.login') }}
                                </a>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- بطاقة رأس المتطوع -->
            <section class="v-header">
                <div class="v-photo">
                    <img src="{{ $volunteer['profile_photo'] ? asset('storage/' . $volunteer['profile_photo']) : asset('images/default-avatar.png') }}"
                        alt="{{ $volunteer['name'] ?? '' }}"
                        onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                </div>

                <div class="v-info">
                    <h1 class="v-name">{{ $volunteer['name'] ?? '' }}</h1>

                    @if (!empty($volunteer['profession']))
                        <p class="v-profession">
                            {{ $t(['main.titles.volunteer.profession', 'main.volunteer.profession']) }}:
                            <span>{{ $volunteer['profession'] }}</span>
                        </p>
                    @endif

                    <div class="chips">
                        @if (!empty($volunteer['email']))
                            <div class="chip"><i class="fas fa-envelope"></i><span>{{ $volunteer['email'] }}</span>
                            </div>
                        @endif
                        @if (!empty($volunteer['phone']))
                            <div class="chip"><i class="fas fa-phone"></i><span>{{ $volunteer['phone'] }}</span>
                            </div>
                        @endif
                        @if (!empty($genderLabel))
                            <div class="chip">
                                <i
                                    class="fas fa-{{ $genderKey === 'male' ? 'male' : ($genderKey === 'female' ? 'female' : 'user') }}"></i>
                                <span>{{ $genderLabel }}</span>
                            </div>
                        @endif
                        @if (!empty($volunteer['birth_date']))
                            <div class="chip"><i
                                    class="fas fa-calendar-alt"></i><span>{{ $volunteer['birth_date'] }}</span></div>
                        @endif
                        @if (!empty($volunteer['join_date']))
                            <div class="chip">
                                <i class="fas fa-calendar-check"></i>
                                <span>{{ $t(['main.titles.volunteer.join_date', 'main.volunteer.join_date']) }}:
                                    {{ $volunteer['join_date'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- معلومات شخصية -->
            <h2 class="section-title">{{ $t(['main.titles.volunteer.personal_info', 'main.volunteer.personal_info']) }}
            </h2>
            <section class="grid">
                @if (!empty($volunteer['national_id']))
                    <div class="card">
                        <h3>{{ $t(['main.titles.volunteer.national_id', 'main.volunteer.national_id']) }}</h3>
                        <p>{{ $volunteer['national_id'] }}</p>
                    </div>
                @endif

                @if (!empty($availabilityLabel))
                    <div class="card">
                        <h3>{{ $t(['main.titles.volunteer.availability', 'main.volunteer.availability']) }}</h3>
                        <p>{{ $availabilityLabel }}</p>
                    </div>
                @endif
            </section>

            <!-- المهارات -->
            @if (!empty($volunteer['skills']))
                <h2 class="section-title">{{ $t(['main.titles.volunteer.skills', 'main.volunteer.skills']) }}</h2>
                <section class="skills">
                    <div class="skills-list">
                        @php
                            $skills = is_array($volunteer['skills'])
                                ? $volunteer['skills']
                                : preg_split('/,|،/u', (string) $volunteer['skills']);
                        @endphp
                        @foreach ($skills as $skill)
                            @if (trim((string) $skill) !== '')
                                <span class="tag">{{ trim((string) $skill) }}</span>
                            @endif
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- السيرة الذاتية -->
            @if (!empty($volunteer['CV']))
                <h2 class="section-title">{{ $t(['main.titles.volunteer.cv', 'main.volunteer.cv']) }}</h2>
                <section class="cv">{!! $volunteer['CV'] !!}</section>
            @endif

            <!-- الملاحظات -->
            @if (!empty($volunteer['notes']))
                <h2 class="section-title">{{ $t(['main.titles.volunteer.notes', 'main.volunteer.notes']) }}</h2>
                <section class="notes">
                    <p>{{ $volunteer['notes'] }}</p>
                </section>
            @endif
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ __('main.site_name') }} — {{ __('main.footer.copyright') }}</p>
        </div>
    </footer>

    <script>
        // فتح/إغلاق قائمة اللغة
        const switcher = document.getElementById('langSwitcher');
        if (switcher) {
            const trigger = switcher.querySelector('.trigger');
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                switcher.classList.toggle('open');
            });
            document.addEventListener('click', (e) => {
                if (!switcher.contains(e.target)) switcher.classList.remove('open');
            });
        }
    </script>
</body>

</html>
