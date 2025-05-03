<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - المركز السوري للتنمية المستدامة</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* أنماط عامة */
        :root {
            --primary-color: #2E86AB;
            --secondary-color: #F18F01;
            --accent-color: #5BBA6F;
            --dark-color: #333;
            --light-color: #f8f9fa;
            --white: #fff;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* خلفية متحركة */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(46, 134, 171, 0.1) 0%, rgba(241, 143, 1, 0.1) 100%);
            z-index: -2;
        }

        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
            overflow: hidden;
        }

        .bg-animation div {
            position: absolute;
            border-radius: 50%;
            background: rgba(46, 134, 171, 0.1);
            animation: float 15s infinite linear;
        }

        .bg-animation div:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .bg-animation div:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 30%;
            animation-delay: 3s;
            animation-duration: 12s;
        }

        .bg-animation div:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 30%;
            left: 70%;
            animation-delay: 5s;
        }

        .bg-animation div:nth-child(4) {
            width: 180px;
            height: 180px;
            top: 70%;
            left: 80%;
            animation-delay: 7s;
            animation-duration: 18s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* شريط التنقل - معدل ليكون الشعار في المنتصف */
        .header {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 10px 0;
            text-align: center;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .org-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-color);
            white-space: nowrap;
        }

        /* زر الترجمة */
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .language-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--dark-color);
            transition: var(--transition);
            padding: 5px 10px;
            border-radius: 4px;
        }

        .language-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .language-btn.active {
            color: var(--primary-color);
            font-weight: bold;
        }

        /* تصميم نموذج إنشاء الحساب */
        .register-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 80px 0;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary-color);
            margin: 20px;
        }

        .register-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 1.8rem;
            position: relative;
        }

        .register-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 15px auto;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }

        .input-container {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: #f9f9f9;
            text-align: right;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            z-index: 2;
        }

        .btn {
            display: inline-block;
            background-color: var(--secondary-color);
            color: var(--white);
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .register-footer {
            margin-top: 20px;
            text-align: center;
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
            margin: 0 10px;
            font-weight: 500;
        }

        .register-footer a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #777;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider-text {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        /* تذييل الصفحة */
        .footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 20px 0;
            text-align: center;
            position: relative;
        }

        .footer p {
            margin-bottom: 10px;
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
            margin: 0 5px;
            transition: var(--transition);
        }

        .social-icons a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* رسائل الخطأ */
        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            text-align: right;
        }

        .has-error .form-control {
            border-color: #dc3545;
        }

        /* رسائل النجاح */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        /* التجاوب مع الشاشات الصغيرة */
        @media (max-width: 768px) {
            .register-container {
                padding: 30px 20px;
                margin: 20px 10px;
            }

            .register-title {
                font-size: 1.5rem;
            }

            .register-footer {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .register-footer a {
                margin: 5px 0;
            }

            .logo-container {
                flex-direction: column;
                gap: 5px;
            }

            .org-name {
                font-size: 1rem;
            }

            .form-control {
                padding: 12px 15px 12px 35px;
            }

            .input-icon {
                left: 10px;
                font-size: 0.9rem;
            }

            .header .container {
                flex-direction: column;
                gap: 10px;
            }

            .language-switcher {
                margin-top: 10px;
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

    <!-- شريط التنقل العلوي مع الشعار في المنتصف -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="logo.png" alt="شعار المركز السوري للتنمية المستدامة">
                </div>
                <div class="org-name" data-translate="org_name">المركز السوري للتنمية المستدامة والتمكين المجتمعي</div>
            </div>

            <!-- زر الترجمة -->
            <div class="language-switcher">
                <button class="language-btn active" data-lang="ar">العربية</button>
                <button class="language-btn" data-lang="en">English</button>
            </div>
        </div>
    </header>

    <!-- قسم إنشاء الحساب -->
    <div class="register-page">
        <div class="register-container">
            <h2 class="register-title" data-translate="register_title">إنشاء حساب جديد</h2>

            <!-- عرض رسائل الخطأ -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- عرض رسالة النجاح -->
            @if (session('success'))
                <div class="alert-success" data-translate="success_message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" data-translate="username_label">اسم المستخدم</label>
                    <div class="input-container">
                        <i class="fas fa-user-tag input-icon"></i>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" data-translate="email_label">البريد الإلكتروني</label>
                    <div class="input-container">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" data-translate="password_label">كلمة المرور</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    @if ($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" data-translate="confirm_password_label">تأكيد كلمة المرور</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block" data-translate="register_button">إنشاء حساب</button>
                </div>
            </form>

            <div class="divider">
                <span class="divider-text" data-translate="or_text">أو</span>
            </div>

            <div class="register-footer">
                <a href="{{ route('login') }}" data-translate="login_link">لديك حساب بالفعل؟ تسجيل الدخول</a>
            </div>
        </div>
    </div>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <p data-translate="copyright_text">&copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // ترجمة النصوص
        const translations = {
            ar: {
                org_name: "المركز السوري للتنمية المستدامة والتمكين المجتمعي",

                register_title: "إنشاء حساب جديد",
                username_label: "اسم المستخدم",
                email_label: "البريد الإلكتروني",
                password_label: "كلمة المرور",
                confirm_password_label: "تأكيد كلمة المرور",
                register_button: "إنشاء حساب",
                or_text: "أو",
                login_link: "لديك حساب بالفعل؟ تسجيل الدخول",
                copyright_text: "© 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.",
                success_message: "تم إنشاء الحساب بنجاح!"
            },
            en: {
                org_name: "Syrian Center for Sustainable Development and Community Empowerment ",
                register_title: "Create New Account",
                username_label: "Username",
                email_label: "Email Address",
                password_label: "Password",
                confirm_password_label: "Confirm Password",
                register_button: "Create Account",
                or_text: "OR",
                login_link: "Already have an account? Login",
                copyright_text: "© 2023 Syrian Center for Sustainable Development. All rights reserved.",
                success_message: "Account created successfully!"
            }
        };

        // تغيير اللغة
        document.querySelectorAll('.language-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const lang = this.dataset.lang;

                // تحديث حالة الأزرار
                document.querySelectorAll('.language-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                // تغيير اتجاه الصفحة
                document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
                document.documentElement.lang = lang;

                // تطبيق الترجمة
                document.querySelectorAll('[data-translate]').forEach(element => {
                    const key = element.getAttribute('data-translate');
                    if (translations[lang][key]) {
                        element.textContent = translations[lang][key];
                    }
                });

                // تغيير مكان الأيقونات في حقول الإدخال
                if (lang === 'en') {
                    document.querySelectorAll('.input-icon').forEach(icon => {
                        icon.style.left = 'auto';
                        icon.style.right = '15px';
                    });
                    document.querySelectorAll('.form-control').forEach(input => {
                        input.style.textAlign = 'left';
                        input.style.padding = '12px 40px 12px 15px';
                    });
                } else {
                    document.querySelectorAll('.input-icon').forEach(icon => {
                        icon.style.left = '15px';
                        icon.style.right = 'auto';
                    });
                    document.querySelectorAll('.form-control').forEach(input => {
                        input.style.textAlign = 'right';
                        input.style.padding = '12px 15px 12px 40px';
                    });
                }
            });
        });

        // التحقق من تطابق كلمة المرور
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('password_confirmation').value.trim();

            if (password !== confirmPassword) {
                e.preventDefault();
                const currentLang = document.documentElement.lang || 'ar';
                const errorMsg = currentLang === 'ar' ?
                    'كلمة المرور وتأكيدها غير متطابقين' :
                    'Password and confirmation do not match';
                alert(errorMsg);
                return false;
            }

            return true;
        });
    </script>
</body>
</html>
