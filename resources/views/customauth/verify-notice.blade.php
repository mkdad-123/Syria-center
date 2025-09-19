<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
        <link rel="icon" href="{{ asset('logo.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title data-translate="page_title">تفعيل البريد - المركز السوري للتنمية المستدامة والتمكين المجتمعي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --accent-color: #5BBA6F;
            --dark-color: #333;
            --light-color: #f8f9fa;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            --transition: .3s ease;
            --header-bg: rgba(255, 255, 255, .9);
            --header-border: rgba(0, 0, 0, .06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f6f7f9;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(46, 134, 171, .10) 0%, rgba(241, 143, 1, .10) 100%);
            z-index: -2
        }

        .bg-animation {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: .3;
            overflow: hidden;
            pointer-events: none
        }

        .bg-animation div {
            position: absolute;
            border-radius: 50%;
            background: rgba(46, 134, 171, .10);
            animation: float 15s linear infinite
        }

        .bg-animation div:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%
        }

        .bg-animation div:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 30%;
            animation-delay: 3s;
            animation-duration: 12s
        }

        .bg-animation div:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 30%;
            left: 70%;
            animation-delay: 5s
        }

        .bg-animation div:nth-child(4) {
            width: 180px;
            height: 180px;
            top: 70%;
            left: 80%;
            animation-delay: 7s;
            animation-duration: 18s
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0);
                opacity: 1
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0
            }
        }

        .container {
            width: min(1200px, 92%);
            margin-inline: auto
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--header-bg);
            backdrop-filter: saturate(140%) blur(6px);
            -webkit-backdrop-filter: saturate(140%) blur(6px);
            border-bottom: 1px solid var(--header-border);
            padding: 8px env(safe-area-inset-right) 8px env(safe-area-inset-left);
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0
        }

        .logo img {
            height: 52px;
            width: auto
        }

        .org-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .language-switcher {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .language-btn {
            background: none;
            border: 0;
            cursor: pointer;
            font-size: .95rem;
            color: var(--dark-color);
            padding: 8px 10px;
            border-radius: 6px;
            transition: var(--transition);
            text-decoration: none;
        }

        .language-btn:hover {
            background: rgba(0, 0, 0, .05)
        }

        .language-btn.active {
            color: var(--primary-color);
            font-weight: 700
        }

        .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
            padding: 40px 0
        }

        .card {
            width: 100%;
            max-width: 520px;
            margin: 20px;
            background: rgba(255, 255, 255, .95);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            padding: 36px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary-color);
        }

        h2 {
            margin: 0 0 8px;
            color: var(--primary-color);
            font-size: 1.6rem;
            font-weight: 800;
            position: relative
        }

        h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 14px 0 0;
            border-radius: 2px
        }

        p {
            margin: 8px 0;
            color: #444
        }

        .muted {
            color: #6b7280
        }

        .warn {
            background: #fff7ed;
            border: 1px solid #fbbf24;
            color: #92400e;
            padding: 10px 12px;
            border-radius: 10px;
            margin: 12px 0
        }

        .success {
            background: #ecfdf5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 10px 12px;
            border-radius: 10px;
            margin: 10px 0
        }

        .row {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap
        }

        button {
            all: unset;
            display: inline-block;
            width: auto;
            background: var(--secondary-color);
            color: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: var(--transition)
        }

        button:hover {
            background: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1)
        }

        button:disabled {
            opacity: .6;
            cursor: not-allowed
        }

        a.link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600
        }

        a.link:hover {
            color: var(--secondary-color);
            text-decoration: underline
        }

        @media (max-width:992px) {
            .logo img {
                height: 48px
            }

            .org-name {
                font-size: 1.05rem
            }

            .header .container {
                gap: 12px
            }

            .card {
                padding: 30px
            }
        }

        @media (max-width:768px) {
            .header {
                padding: 10px 0
            }

            .header .container {
                flex-direction: column;
                align-items: center;
                gap: 10px
            }

            .logo-container {
                gap: 6px
            }

            .logo img {
                height: 46px
            }

            .org-name {
                font-size: 1rem
            }

            .page {
                min-height: calc(100vh - 64px);
                padding: 30px 0
            }

            .card {
                padding: 24px 18px;
                margin: 16px 10px
            }
        }

        @media (max-width:420px) {
            .logo img {
                height: 42px
            }

            .org-name {
                font-size: .95rem
            }

            button {
                padding: 11px 14px
            }
        }
    </style>
</head>

<body>
    <div class="bg-animation">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo"><img src="{{ asset('logo.png') }}"
                        alt="شعار المركز السوري للتنمية المستدامة والتمكين المجتمعي"></div>
                <div class="org-name" data-translate="org_name">المركز السوري للتنمية المستدامة والتمكين المجتمعي</div>
            </div>

            <!-- مُحوّل لغة أمامي (بدون مسارات/داتا خارجية) -->
            <div class="language-switcher" aria-label="Language switcher">
                <button type="button" class="language-btn active" data-lang="ar">العربية</button>
                <button type="button" class="language-btn" data-lang="en">English</button>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="card">
            <h2 data-translate="heading">رجاءً فعّل بريدك الإلكتروني</h2>

            <p class="muted">
                <span data-translate="sent_to">أرسلنا رابط تفعيل إلى:</span>
                <b
                    id="user-email">{{ optional(auth('custom')->user())->email ?? (session('unverified_email') ?? 'بريدك الإلكتروني') }}</b>
            </p>

            {{-- رسائل الحالة (النص يُترجم عبر JS) --}}
            @if (session('status') === 'verification-link-sent')
                <div class="success"><i class="fa-solid fa-check-circle"></i> <span
                        data-translate="status_verification_link_sent">تم إرسال رابط تفعيل جديد إلى بريدك.</span></div>
            @elseif (session('status') === 'email-verified')
                <div class="success"><i class="fa-solid fa-check-circle"></i> <span
                        data-translate="status_email_verified">تم تفعيل بريدك بنجاح.</span></div>
            @elseif (session('status') === 'email-already-verified')
                <div class="success"><i class="fa-solid fa-circle-info"></i> <span
                        data-translate="status_email_already_verified">هذا البريد مُفعّل مسبقًا.</span></div>
            @endif

            <div class="warn">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span data-translate="warn_text">إذا لم يصلك البريد خلال دقائق، تحقّق من مجلد الرسائل غير المرغوب فيها
                    (Spam).</span>
            </div>

            @auth('custom')
                @if (!auth('custom')->user()->hasVerifiedEmail())
                    <form class="row" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" data-translate="resend_btn">إعادة إرسال رابط التفعيل</button>
                        <a href="{{ route('home') }}" class="link" data-translate="back_home">العودة للصفحة الرئيسية</a>
                    </form>
                @else
                    <p><a href="{{ route('home') }}" class="link" data-translate="go_home">الانتقال إلى الصفحة
                            الرئيسية</a></p>
                @endif
            @endauth

            @guest('custom')
                <p class="muted">
                    <span data-translate="guest_hint_1">لإعادة إرسال الرابط لاحقًا يمكنك</span>
                    <a href="{{ route('login') }}" class="link" data-translate="guest_hint_2">تسجيل الدخول</a>
                    <span data-translate="guest_hint_3">ثم العودة إلى هذه الصفحة.</span>
                </p>
                <p><a href="{{ route('home') }}" class="link" data-translate="back_home">العودة للصفحة الرئيسية</a></p>
            @endguest
        </div>
    </main>

    <script>
        // قاموس الترجمة داخل نفس البليد — بدون أي اعتماد على ملفات أو قاعدة بيانات
        const translations = {
            ar: {
                page_title: "تفعيل البريد - المركز السوري للتنمية المستدامة والتمكين المجتمعي",
                org_name: "المركز السوري للتنمية المستدامة والتمكين المجتمعي",
                heading: "رجاءً فعّل بريدك الإلكتروني",
                sent_to: "أرسلنا رابط تفعيل إلى:",
                status_verification_link_sent: "تم إرسال رابط تفعيل جديد إلى بريدك.",
                status_email_verified: "تم تفعيل بريدك بنجاح.",
                status_email_already_verified: "هذا البريد مُفعّل مسبقًا.",
                warn_text: "إذا لم يصلك البريد خلال دقائق، تحقّق من مجلد الرسائل غير المرغوب فيها (Spam).",
                resend_btn: "إعادة إرسال رابط التفعيل",
                back_home: "العودة للصفحة الرئيسية",
                go_home: "الانتقال إلى الصفحة الرئيسية",
                guest_hint_1: "لإعادة إرسال الرابط لاحقًا يمكنك",
                guest_hint_2: "تسجيل الدخول",
                guest_hint_3: "ثم العودة إلى هذه الصفحة."
            },
            en: {
                page_title: "Verify Email — Syrian Center for Sustainable Development & Community Empowerment",
                org_name: "Syrian Center for Sustainable Development & Community Empowerment",
                heading: "Please verify your email",
                sent_to: "We sent a verification link to:",
                status_verification_link_sent: "A new verification link has been sent to your email.",
                status_email_verified: "Your email has been verified successfully.",
                status_email_already_verified: "This email is already verified.",
                warn_text: "If you don’t receive the email within minutes, please check your Spam folder.",
                resend_btn: "Resend verification link",
                back_home: "Back to Home",
                go_home: "Go to Home",
                guest_hint_1: "To resend the link later, you can",
                guest_hint_2: "log in",
                guest_hint_3: "and come back to this page."
            }
        };

        // تفعيل التبديل بين اللغتين (بدون استدعاء خوادم)
        document.querySelectorAll('.language-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const lang = this.dataset.lang;

                // زر نشط
                document.querySelectorAll('.language-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // اتجاه الصفحة وعلامة اللغة
                document.documentElement.dir = (lang === 'ar') ? 'rtl' : 'ltr';
                document.documentElement.lang = lang;

                // تحديث كل العناصر التي تحمل data-translate
                document.querySelectorAll('[data-translate]').forEach(el => {
                    const key = el.getAttribute('data-translate');
                    if (translations[lang][key]) el.textContent = translations[lang][key];
                });

                // تحديث العنوان (title)
                if (translations[lang].page_title) {
                    document.title = translations[lang].page_title;
                }
            });
        });
    </script>
</body>

</html>
