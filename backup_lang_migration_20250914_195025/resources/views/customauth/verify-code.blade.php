<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title data-translate="verify_title">تحقق من رمز إعادة التعيين - المركز السوري للتنمية المستدامة</title>
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

        /* تصميم نموذج التحقق من الرمز */
        .verify-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 80px 0;
        }

        .verify-container {
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

        .verify-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 1.8rem;
            position: relative;
        }

        .verify-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 15px auto;
            border-radius: 2px;
        }

        .verify-message {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark-color);
        }

        .verify-message strong {
            color: var(--primary-color);
        }

        /* تنسيق حقول إدخال الرمز */
        .code-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            direction: ltr;
            /* اتجاه الحقول من اليسار لليمين */
        }

        .code-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: var(--transition);
            direction: ltr;
            /* تأكيد اتجاه النص من اليسار لليمين */
        }

        .code-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(46, 134, 171, 0.2);
        }

        /* تنسيق الزر */
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

        /* روابط إعادة الإرسال */
        .resend-container {
            margin-top: 20px;
            text-align: center;
        }

        .resend-link {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .resend-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .resend-link.disabled {
            color: #999;
            pointer-events: none;
            text-decoration: none;
        }

        /* تنسيق العداد التنازلي */
        .countdown {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #777;
            margin-top: 5px;
        }

        /* رسائل التنبيه */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .d-none {
            display: none !important;
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

        /* التجاوب مع الشاشات الصغيرة */
        @media (max-width: 768px) {
            .verify-container {
                padding: 30px 20px;
                margin: 20px 10px;
            }

            .verify-title {
                font-size: 1.5rem;
            }

            .code-input {
                width: 40px;
                height: 50px;
                font-size: 20px;
            }

            .code-input {
                direction: ltr;
                /* يكتب الرقم بشكل طبيعي */
            }

            .logo-container {
                flex-direction: column;
                gap: 5px;
            }

            .org-name {
                font-size: 1rem;
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
                    <img src="{{ asset('logo.png') }}" alt="شعار المركز السوري للتنمية المستدامة">
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

    <!-- قسم التحقق من الرمز -->
    <div class="verify-page">
        <div class="verify-container">
            <h2 class="verify-title" data-translate="verify_title">تحقق من رمز إعادة التعيين</h2>
            <p class="verify-message" data-translate="verify_message" data-email="{{ request()->query('email') }}">
                تم إرسال رمز مكون من 100 أرقام إلى <strong>{{ request()->query('email') }}</strong>
            </p>

            <form id="verifyCodeForm">
                @csrf
                <input type="hidden" name="email" value="{{ request()->query('email') }}">

                <div class="code-inputs">
                    <input type="text" maxlength="1" class="code-input" name="code1" required inputmode="numeric"
                        pattern="[0-9]*">
                    <input type="text" maxlength="1" class="code-input" name="code2" required inputmode="numeric"
                        pattern="[0-9]*">
                    <input type="text" maxlength="1" class="code-input" name="code3" required inputmode="numeric"
                        pattern="[0-9]*">
                    <input type="text" maxlength="1" class="code-input" name="code4" required inputmode="numeric"
                        pattern="[0-9]*">
                    <input type="text" maxlength="1" class="code-input" name="code5" required inputmode="numeric"
                        pattern="[0-9]*">
                    <input type="text" maxlength="1" class="code-input" name="code6" required inputmode="numeric"
                        pattern="[0-9]*">
                </div>

                <button type="submit" class="btn" data-translate="verify_btn">تحقق من الرمز</button>

                <div class="resend-container">
                    <a href="#" id="resendCode" class="resend-link" data-translate="resend_link">إعادة إرسال
                        الرمز</a>
                    <div id="countdown" class="countdown d-none" data-translate="countdown_text">يمكنك إعادة الإرسال بعد
                        <span id="timer">60</span> ثانية
                    </div>
                </div>
            </form>

            <div class="alert alert-success mt-3 d-none" id="successMessage"></div>
            <div class="alert alert-danger mt-3 d-none" id="errorMessage"></div>
        </div>
    </div>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <p data-translate="copyright_text">&copy; {{ date('Y') }} المركز السوري للتنمية المستدامة. جميع الحقوق
                محفوظة.</p>
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
                verify_title: "تحقق من رمز إعادة التعيين",
                verify_message: "تم إرسال رمز مكون من 6 أرقام إلى",
                verify_btn: "تحقق من الرمز",
                resend_link: "إعادة إرسال الرمز",
                countdown_text: "يمكنك إعادة الإرسال بعد",
                copyright_text: "© {{ date('Y') }} المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.",
                success_message: "تم التحقق بنجاح، جاري التوجيه...",
                error_message: "رمز التحقق غير صحيح",
                resend_success: "تم إعادة إرسال رمز التحقق إلى بريدك الإلكتروني",
                resend_error: "حدث خطأ أثناء إعادة إرسال الرمز",
                verifying: "جاري التحقق...",
                seconds: "ثانية"
            },
            en: {
                org_name: "Syrian Center for Sustainable Development and Community Empowerment",
                verify_title: "Verify Reset Code",
                verify_message: "A 6-digit code has been sent to",
                verify_btn: "Verify Code",
                resend_link: "Resend Code",
                countdown_text: "You can resend after",
                copyright_text: "© {{ date('Y') }} Syrian Center for Sustainable Development. All rights reserved.",
                success_message: "Verification successful, redirecting...",
                error_message: "Verification code is incorrect",
                resend_success: "Verification code has been resent to your email",
                resend_error: "An error occurred while resending the code",
                verifying: "Verifying...",
                seconds: "seconds"
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
                        if (key === 'verify_message') {
                            const email = element.getAttribute('data-email');
                            element.innerHTML =
                                `${translations[lang][key]} <strong>${email}</strong>`;
                        } else if (key === 'countdown_text') {
                            const timer = document.getElementById('timer');
                            element.innerHTML =
                                `${translations[lang][key]} <span id="timer">${timer.textContent}</span> ${translations[lang]['seconds']}`;
                        } else {
                            element.textContent = translations[lang][key];
                        }
                    }
                });
            });
        });

        // Auto focus and move between inputs (معدل للعمل من اليمين لليسار)
        const codeInputs = document.querySelectorAll('.code-input');
        codeInputs.forEach((input, index) => {
            // التركيز على أول حقل عند تحميل الصفحة (الحقل الأخير في المصفوفة)
            if (index === 0) {
                input.focus();
            }

            input.addEventListener('input', (e) => {
                // التأكد من إدخال رقم فقط
                if (e.target.value.match(/[^0-9]/)) {
                    e.target.value = '';
                    return;
                }
                if (e.target.value.length === 1) {
                    if (index < codeInputs.length - 1) {
                        codeInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value.length === 0) {
                    if (index < codeInputs.length - 1) {
                        codeInputs[index + 1].focus(); // الانتقال إلى الحقل التالي عند الضغط على backspace
                    }
                }
            });
        });

        // Form submission
        document.getElementById('verifyCodeForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.querySelector('input[name="email"]').value;
            const code = Array.from(document.querySelectorAll('.code-input'))
                .map(input => input.value)
                .join('');

            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            const currentLang = document.documentElement.lang || 'ar';

            // Reset messages
            successMessage.classList.add('d-none');
            errorMessage.classList.add('d-none');

            // Disable button and show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                `<i class="fas fa-spinner fa-spin"></i> ${translations[currentLang]['verifying']}`;

            fetch('/verify-code', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email,
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        successMessage.textContent = translations[currentLang]['success_message'];
                        successMessage.classList.remove('d-none');
                        // Redirect to reset page with token
                        setTimeout(() => {
                            window.location.href =
                                `/reset?email=${encodeURIComponent(email)}&token=${encodeURIComponent(data.token)}`;
                        }, 2000);
                    } else {
                        errorMessage.textContent = data.message || translations[currentLang]['error_message'];
                        errorMessage.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    errorMessage.textContent = translations[currentLang]['error_message'];
                    errorMessage.classList.remove('d-none');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
        });

        // Resend code functionality
        document.getElementById('resendCode').addEventListener('click', function(e) {
            e.preventDefault();
            const email = document.querySelector('input[name="email"]').value;
            const resendLink = document.getElementById('resendCode');
            const countdown = document.getElementById('countdown');
            const timer = document.getElementById('timer');
            const currentLang = document.documentElement.lang || 'ar';
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            // Disable resend link and show countdown
            resendLink.classList.add('disabled');
            countdown.classList.remove('d-none');

            // Start countdown
            let timeLeft = 60;
            const interval = setInterval(() => {
                timeLeft--;
                timer.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    resendLink.classList.remove('disabled');
                    countdown.classList.add('d-none');
                }
            }, 1000);

            // Send request to resend code
            fetch('/reset-code', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        successMessage.textContent = translations[currentLang]['resend_success'];
                        successMessage.classList.remove('d-none');
                    } else {
                        errorMessage.textContent = data.message || translations[currentLang]['resend_error'];
                        errorMessage.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    errorMessage.textContent = translations[currentLang]['resend_error'];
                    errorMessage.classList.remove('d-none');
                });
        });

        // Initialize translations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const currentLang = document.documentElement.lang || 'ar';
            document.querySelectorAll('[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[currentLang][key]) {
                    if (key === 'verify_message') {
                        const email = element.getAttribute('data-email');
                        element.innerHTML = `${translations[currentLang][key]} <strong>${email}</strong>`;
                    } else {
                        element.textContent = translations[currentLang][key];
                    }
                }
            });
        });
    </script>
</body>

</html>
