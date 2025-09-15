<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.8;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-top: 0;
        }
        
        p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }
        
        .code-container {
            text-align: center;
            margin: 30px 0;
        }
        
        .code {
            font-size: 28px;
            font-weight: bold;
            padding: 15px 30px;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            border-radius: 8px;
            display: inline-block;
            letter-spacing: 3px;
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.2);
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
        }
        
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
        
        .note {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-right: 4px solid #e74c3c;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- يمكنك إضافة شعارك هنا -->
            <!-- <img src="https://example.com/logo.png" alt="شعار التطبيق" class="logo"> -->
            <h2>إعادة تعيين كلمة المرور</h2>
        </div>
        
        <p>مرحباً عزيزنا المستخدم،</p>
        
        <p>لقد تلقيت هذا البريد الإلكتروني لأنك طلبت إعادة تعيين كلمة المرور لحسابك في موقع المركز السوري للتنمية المستدامة والتمكين المجتمعي </p>
        
        <div class="code-container">
            <div class="code">{{ $code }}</div>
        </div>
        
        <p>يرجى استخدام الرمز أعلاه لإعادة تعيين كلمة المرور الخاصة بك.</p>
        
        <div class="note">
            <strong>ملاحظة مهمة:</strong> هذا الرمز ساري المفعول لمدة 30 دقيقة فقط. لا تشارك هذا الرمز مع أي شخص آخر.
        </div>
        
        <p>إذا لم تطلب إعادة تعيين كلمة المرور، يرجى تجاهل هذا البريد أو الاتصال بفريق الدعم لدينا.</p>
        
        <p>نشكرك على ثقتك بنا!</p>
        
        <div class="footer">
            <p>مع أطيب التحيات،<br>فريق التطبيق</p>
            <p>© 2023 اسم التطبيق. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>
</html>