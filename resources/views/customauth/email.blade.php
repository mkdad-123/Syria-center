<!DOCTYPE html>
<html>
<head>
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .code { font-size: 24px; font-weight: bold; padding: 10px 20px; background: #f4f4f4; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h2>مرحباً!</h2>
        <p>لقد تلقيت هذا البريد لأنك طلبت إعادة تعيين كلمة المرور لحسابك.</p>
        <p>رمز إعادة التعيين الخاص بك هو:</p>
        <div class="code">{{ $code }}</div>
        <p>هذا الرمز صالح لمدة 30 دقيقة فقط.</p>
        <p>إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد.</p>
        <p>شكراً لاستخدامك تطبيقنا!</p>
    </div>
</body>
</html>