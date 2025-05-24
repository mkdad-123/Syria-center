document.querySelectorAll('.language-menu a').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const lang = this.getAttribute('data-lang');
        // إرسال طلب لتغيير اللغة
        fetch('/change-language', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ locale: lang })
        }).then(() => {
            window.location.reload();
        });
    });
});
// تأكد من أن الكود ينفذ بعد تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // وظيفة لتعيين الكوكي
    function setLanguageCookie(lang) {
        document.cookie = `preferred_language=${lang};path=/;max-age=${30 * 24 * 60 * 60};SameSite=Lax`;
    }

    // وظيفة لقراءة الكوكي
    function getLanguageCookie() {
        return document.cookie.split('; ').find(row => row.startsWith('preferred_language='))?.split('=')[1];
    }

    // تبديل اللغة عند النقر على الروابط
    document.querySelectorAll('[data-lang]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            setLanguageCookie(lang);
            window.location.reload();
        });
    });

    // التحقق من اللغة المفضلة عند التحميل
    const preferredLang = getLanguageCookie();
    const currentLang = document.documentElement.lang;

    if (preferredLang && preferredLang !== currentLang) {
        const url = new URL(window.location.href);
        url.searchParams.set('lang', preferredLang);
        window.location.href = url.toString();
    }

    // تغيير خلفية الصفحة تلقائياً
    const backgroundImages = document.querySelectorAll('.background-slideshow img');
    let currentImage = 0;

    function changeBackground() {
        backgroundImages[currentImage].classList.remove('active');
        currentImage = (currentImage + 1) % backgroundImages.length;
        backgroundImages[currentImage].classList.add('active');
    }

    setInterval(changeBackground, 5000);
});
