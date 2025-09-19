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

    <link href="{{ asset('css/vol.css') }}" rel="stylesheet">

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
