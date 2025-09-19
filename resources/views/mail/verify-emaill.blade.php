<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>تفعيل حسابك — المركز السوري للتنمية المستدامة والتمكين المجتمعي</title>
</head>

<body
    style="margin:0;padding:0;background:#f6f7f9;font-family:Tahoma,Segoe UI,Arial,sans-serif;color:#333;line-height:1.7;">

    <!-- غلاف -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f6f7f9;padding:24px 0;">
        <tr>
            <td align="center">

                <!-- البطاقة -->
                <table role="presentation" width="640" cellpadding="0" cellspacing="0"
                    style="max-width:640px;width:94%;background:#ffffff;border:1px solid #e9eef3;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.06);">
                    <!-- الهيدر -->
                    <tr>
                        <td align="center"
                            style="padding:22px 20px;background:linear-gradient(135deg, rgba(46,134,171,.08), rgba(241,143,1,.08));border-bottom:1px solid #e9eef3;">
                            <img src="https://www.sustainsyria.org/logo.png"
                                alt="المركز السوري للتنمية المستدامة والتمكين المجتمعي"
                                style="max-height:56px;display:block;margin:0 auto 10px;">
                            <div style="font-weight:700;color:#2E86AB;font-size:16px;">
                                المركز السوري للتنمية المستدامة والتمكين المجتمعي
                            </div>
                        </td>
                    </tr>

                    <!-- المحتوى -->
                    <tr>
                        <td style="padding:26px 22px 10px;">
                            <h1 style="margin:0 0 10px;font-size:20px;color:#2E86AB;">مرحبًا
                                {{ $user->name ?? 'صديقنا' }} 👋</h1>
                            <p style="margin:8px 0 0;color:#333;">
                                شكرًا لتسجيلك لدينا. لتفعيل حسابك، يرجى الضغط على الزر التالي:
                            </p>

                            <!-- زر التفعيل -->
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:18px 0 12px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $url }}"
                                            style="display:inline-block;background:#F18F01;color:#ffffff;text-decoration:none;padding:12px 20px;border-radius:10px;font-weight:700;">
                                            تفعيل الحساب الآن
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- رابط بديل -->
                            <p style="margin:10px 0 0;font-size:14px;color:#6b7280;">
                                إذا لم يعمل الزر، انسخ الرابط التالي والصقه في متصفحك:
                            </p>
                            <p style="margin:6px 0 0;word-break:break-all;direction:ltr;text-align:left;color:#2E86AB;">
                                {{ $url }}
                            </p>

                            <!-- ملاحظات -->
                            <div
                                style="margin:16px 0 0;padding:10px 12px;background:#fff7ed;border:1px solid #fbbf24;border-radius:10px;color:#92400e;font-size:14px;">
                                إذا لم تنشئ حسابًا، يمكنك تجاهل هذه الرسالة.
                            </div>
                        </td>
                    </tr>

                    <!-- فاصل زخرفي -->
                    <tr>
                        <td style="padding:0 22px 0;">
                            <div style="height:4px;width:64px;background:#5BBA6F;border-radius:2px;margin:16px 0 8px;">
                            </div>
                        </td>
                    </tr>

                    <!-- الفوتر -->
                    <tr>
                        <td
                            style="padding:10px 22px 22px;background:#f9fafb;border-top:1px solid #e9eef3;color:#6b7280;font-size:12px;">
                            <div style="margin-bottom:6px;">
                                © {{ now()->year }} المركز السوري للتنمية المستدامة والتمكين المجتمعي — جميع الحقوق
                                محفوظة.
                            </div>
                            <div>
                                هذه الرسالة أُرسلت تلقائيًا. لا ترد على هذا البريد.
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- /البطاقة -->

            </td>
        </tr>
    </table>

</body>

</html>
