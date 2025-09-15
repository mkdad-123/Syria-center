document.addEventListener('DOMContentLoaded', function () {
    // تحسين: تخزين العناصر المكررة في متغيرات
    const docEl = document.documentElement;
    const bodyEl = document.body;

    // وظيفة لتعيين الكوكي
    function setLanguageCookie(lang) {
        document.cookie = `lang=${lang};path=/;max-age=${30 * 24 * 60 * 60};SameSite=Lax`;
    }

    // وظيفة لقراءة الكوكي
    function getLanguageCookie() {
        const cookies = document.cookie.split('; ');
        for (let i = 0; i < cookies.length; i++) {
            if (cookies[i].startsWith('lang=')) {
                return cookies[i].split('=')[1];
            }
        }
        return null;
    }

    // إصلاح: تبديل اللغة - استخدام الحدث بشكل صحيح
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
    const currentLang = docEl.lang;

    if (preferredLang && preferredLang !== currentLang) {
        const url = new URL(window.location.href);
        url.searchParams.set('lang', preferredLang);
        window.location.href = url.toString();
    }

    // إصلاح: تغيير خلفية الصفحة
    const backgroundImages = document.querySelectorAll('.background-slideshow img');
    let currentImage = 0;
    let slideshowInterval;

    function initSlideshow() {
        if (backgroundImages.length > 0) {
            clearInterval(slideshowInterval);
            slideshowInterval = setInterval(changeBackground, 5000);
        }
    }

    function changeBackground() {
        if (backgroundImages.length > 0) {
            backgroundImages[currentImage]?.classList?.remove('active');
            currentImage = (currentImage + 1) % backgroundImages.length;
            backgroundImages[currentImage]?.classList?.add('active');
        }
    }

    // بدء العرض المتحرك بعد التأكد من تحميل الصور
    if (backgroundImages.length > 0) {
        initSlideshow();
    }

    // إصلاح: وظائف النافذة العائمة
    window.openEventModal = function (eventId) {
        const modal = document.getElementById('eventModal' + eventId);
        if (modal) {
            modal.style.display = 'block';
            bodyEl.style.overflow = 'hidden';
            bodyEl.style.position = 'fixed';
        }
    };

    window.closeEventModal = function (eventId) {
        const modal = document.getElementById('eventModal' + eventId);
        if (modal) {
            modal.style.display = 'none';
            bodyEl.style.overflow = 'auto';
            bodyEl.style.position = 'static';
        }
    };

    // إصلاح: إغلاق النافذة عند النقر خارجها
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('event-modal')) {
            const modalId = e.target.id.replace('eventModal', '');
            window.closeEventModal(modalId);
        }
    });

    // إصلاح: إغلاق النافذة عند الضغط على Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.event-modal[style*="display: block"]');
            if (openModal) {
                const modalId = openModal.id.replace('eventModal', '');
                window.closeEventModal(modalId);
            }
        }
    });

    // إصلاح: زر "عرض المزيد"
    document.querySelectorAll('.details-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const eventId = this.getAttribute('data-event-id') || this.href.split('/').pop();
            window.openEventModal(eventId);
        });
    });
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
