document.querySelectorAll('.language-menu a').forEach(item => {
    item.addEventListener('click', function (e) {
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
document.addEventListener('DOMContentLoaded', function () {
    // وظيفة لتعيين الكوكي
    function setLanguageCookie(lang) {
        document.cookie = `lang=${lang};path=/;max-age=${30 * 24 * 60 * 60};SameSite=Lax`;
    }

    // وظيفة لقراءة الكوكي
    function getLanguageCookie() {
        return document.cookie.split('; ').find(row => row.startsWith('lang='))?.split('=')[1];
    }

    // تبديل اللغة عند النقر على الروابط
    document.querySelectorAll('[data-lang]').forEach(link => {
        link.addEventListener('click', function (e) {
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
document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('siteHeader') || document.querySelector('.header');

    // تعويض ارتفاع الهيدر الحقيقي
    function setHeaderPad() {
        if (!header) return;
        document.documentElement.style.setProperty('--header-dyn', header.offsetHeight + 'px');
    }
    setHeaderPad();
    addEventListener('resize', setHeaderPad);
    addEventListener('load', setHeaderPad);

    // أخفِ الهيدر عند أي نزول، وأظهره فقط عند أعلى الصفحة
    function toggleHeader() {
        if (window.scrollY > 0) header.classList.add('is-hidden');
        else header.classList.remove('is-hidden');
    }
    toggleHeader();
    document.addEventListener('scroll', toggleHeader, {
        passive: true
    });
});
