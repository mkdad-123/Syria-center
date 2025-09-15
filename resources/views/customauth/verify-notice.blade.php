<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>تفعيل البريد - المركز السوري للتنمية المستدامة والتمكين المجتمعي</title>
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

        /* خلفية ناعمة + فقاعات */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(46, 134, 171, .10) 0%, rgba(241, 143, 1, .10) 100%);
            z-index: -2;
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
            left: 10%;
            animation-delay: 0s
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

        /* الهيدر (مطابق لصفحة تسجيل الدخول) */
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

        /* المحتوى الرئيسي */
        .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
            padding: 40px 0;
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

        /* تجاوب */
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

    <!-- خلفية متحركة -->
    <div class="bg-animation">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- هيدر مع الشعار (مطابق للّوجين) -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo"><img src="{{ asset('logo.png') }}"
                        alt="شعار المركز السوري للتنمية المستدامة والتمكين المجتمعي"></div>
                <div class="org-name">المركز السوري للتنمية المستدامة والتمكين المجتمعي</div>
            </div>
        </div>
    </header>

    <!-- المحتوى -->
    <main class="page">
        <div class="card">
            <h2>رجاءً فعّل بريدك الإلكتروني</h2>

            {{-- نعرض البريد: من جلسة auth إن وُجدت، أو من session("unverified_email") للمسجّل غير المُسجل دخولاً --}}
            <p class="muted">
                أرسلنا رابط تفعيل إلى:
                <b>{{ optional(auth('custom')->user())->email ?? (session('unverified_email') ?? 'بريدك الإلكتروني') }}</b>
            </p>

            {{-- رسائل الحالة --}}
            @if (session('status') === 'verification-link-sent')
                <div class="success"><i class="fa-solid fa-check-circle"></i> تم إرسال رابط تفعيل جديد إلى بريدك.</div>
            @elseif (session('status') === 'email-verified')
                <div class="success"><i class="fa-solid fa-check-circle"></i> تم تفعيل بريدك بنجاح.</div>
            @elseif (session('status') === 'email-already-verified')
                <div class="success"><i class="fa-solid fa-circle-info"></i> هذا البريد مُفعّل مسبقًا.</div>
            @endif

            <div class="warn"><i class="fa-solid fa-triangle-exclamation"></i> إذا لم يصلك البريد خلال دقائق، تحقّق من
                مجلد الرسائل غير المرغوب فيها (Spam).</div>

            {{-- إن كان المستخدم مسجلاً دخولاً (auth:custom) نُظهر زر إعادة الإرسال --}}
            @auth('custom')
                @if (!auth('custom')->user()->hasVerifiedEmail())
                    <form class="row" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit">إعادة إرسال رابط التفعيل</button>
                        <a href="{{ route('home') }}" class="link">العودة للصفحة الرئيسية</a>
                    </form>
                @else
                    <p><a href="{{ route('home') }}" class="link">الانتقال إلى الصفحة الرئيسية</a></p>
                @endif
            @endauth

            {{-- إن لم يكن مسجلاً دخولاً: لا نعرض زر إعادة الإرسال (المسار خلف auth) --}}
            @guest('custom')
                <p class="muted">
                    لإعادة إرسال الرابط لاحقًا يمكنك
                    <a href="{{ route('login') }}" class="link">تسجيل الدخول</a>
                    ثم العودة إلى هذه الصفحة.
                </p>
                <p><a href="{{ route('home') }}" class="link">العودة للصفحة الرئيسية</a></p>
            @endguest
        </div>
    </main>

</body>

</html>
