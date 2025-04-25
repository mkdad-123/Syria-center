<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعيين كلمة مرور جديدة - المركز السوري للتنمية المستدامة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            background-color: var(--light-color);
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

        /* شريط التنقل العلوي */
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
            justify-content: center;
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

        /* تصميم الصفحة الرئيسية */
        .reset-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 80px 0;
        }

        .reset-container {
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
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 1.8rem;
            position: relative;
        }

        .form-title::after {
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

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-color);
            z-index: 2;
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

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--white);
            padding: 12px 30px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: #e07f00;
            border-color: #e07f00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* رسائل الخطأ والنجاح */
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
            text-align: right;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: right;
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
            .reset-container {
                padding: 30px 20px;
                margin: 20px 10px;
            }

            .form-title {
                font-size: 1.5rem;
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
                right: 10px;
                font-size: 0.9rem;
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

    <!-- شريط التنقل العلوي -->
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="شعار المركز السوري للتنمية المستدامة">
                </div>
                <div class="org-name">المركز السوري للتنمية المستدامة والتمكين المجتمعي</div>
            </div>
        </div>
    </header>

    <!-- قسم تعيين كلمة المرور الجديدة -->
    <div class="reset-page">
        <div class="reset-container">
            <h2 class="form-title">تعيين كلمة مرور جديدة</h2>

            <form id="resetPasswordForm">
                @csrf
                <input type="hidden" name="email" value="{{ request()->query('email') }}">
                <input type="hidden" name="token" value="{{ request()->query('token') }}">

                <div class="form-group">
                    <label for="password">كلمة المرور الجديدة</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="invalid-feedback" id="passwordError"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="invalid-feedback" id="passwordConfirmationError"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <span id="submitText">تعيين كلمة المرور</span>
                    <span id="submitSpinner" class="d-none">
                        <i class="fas fa-spinner fa-spin"></i> جاري المعالجة...
                    </span>
                </button>
            </form>

            <div class="alert alert-success mt-3 d-none" id="successMessage"></div>
            <div class="alert alert-danger mt-3 d-none" id="errorMessage"></div>
        </div>
    </div>

    <!-- تذييل الصفحة -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Reset validation states
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.textContent = '';
            });

            // Show loading state
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            const submitBtn = this.querySelector('button[type="submit"]');

            submitText.classList.add('d-none');
            submitSpinner.classList.remove('d-none');
            submitBtn.disabled = true;

            const formData = {
                email: document.querySelector('input[name="email"]').value,
                token: document.querySelector('input[name="token"]').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };

            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            // Reset messages
            successMessage.classList.add('d-none');
            errorMessage.classList.add('d-none');

            fetch('/reset', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    successMessage.textContent = data.message;
                    successMessage.classList.remove('d-none');

                    // Redirect to login after 3 seconds
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 3000);
                } else {
                    if (data.errors) {
                        // Handle validation errors
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.getElementById(`${key}Error`);
                            const inputElement = document.getElementById(key);
                            if (errorElement && inputElement) {
                                errorElement.textContent = data.errors[key][0];
                                inputElement.classList.add('is-invalid');
                            }
                        });
                    }

                    errorMessage.textContent = data.message || 'حدث خطأ أثناء تعيين كلمة المرور';
                    errorMessage.classList.remove('d-none');
                }
            })
            .catch(error => {
                errorMessage.textContent = 'حدث خطأ في الاتصال بالخادم';
                errorMessage.classList.remove('d-none');
                console.error('Error:', error);
            })
            .finally(() => {
                submitText.classList.remove('d-none');
                submitSpinner.classList.add('d-none');
                submitBtn.disabled = false;
            });
        });
    </script>
</body>
</html>
