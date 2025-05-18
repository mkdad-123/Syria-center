
// وظيفة لتعيين الكوكي
function setLanguageCookie(lang) {
    document.cookie = `preferred_language=${lang};path=/;max-age=${30 * 24 * 60 * 60}`;
}

// وظيفة لقراءة الكوكي
function getLanguageCookie() {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'preferred_language') {
            return value;
        }
    }
    return null;
}

// وظيفة تهيئة الكاروسيل
function initCarousel(carouselId, prevBtnId, nextBtnId) {
    const carousel = document.getElementById(carouselId);
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.team-member, .partner');

    if (slides.length <= 1) {
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);
        const indicatorsContainer = carousel.querySelector('.carousel-indicators');

        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        if (indicatorsContainer) indicatorsContainer.style.display = 'none';

        if (slides.length === 1) {
            slides[0].classList.add('active');
            slides[0].style.display = 'block';
            slides[0].style.opacity = '1';
            slides[0].style.transform = 'scale(1)';
        }
        return;
    }

    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);
    let currentIndex = 0;
    let slideInterval;
    const slideDuration = 5000;

    // إنشاء المؤشرات
    const indicatorsContainer = carousel.querySelector('.carousel-indicators');
    if (indicatorsContainer) {
        slides.forEach((_, index) => {
            const indicator = document.createElement('div');
            indicator.className = 'carousel-indicator';
            if (index === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => goToSlide(index));
            indicatorsContainer.appendChild(indicator);
        });
    }

    const indicators = carousel.querySelectorAll('.carousel-indicator');

    function init() {
        slides.forEach((slide, index) => {
            if (index === 0) {
                slide.classList.add('active');
            } else {
                slide.style.display = 'none';
            }
        });
        startSlideShow();
    }

    function goToSlide(index) {
        if (index === currentIndex) return;
        clearInterval(slideInterval);

        const prevIndex = currentIndex;
        currentIndex = index;

        updateCarousel(prevIndex, currentIndex);
        startSlideShow();
    }

    function moveSlide(direction) {
        clearInterval(slideInterval);
        const prevIndex = currentIndex;
        currentIndex = (currentIndex + direction + slides.length) % slides.length;
        updateCarousel(prevIndex, currentIndex);
        startSlideShow();
    }

    function updateCarousel(prevIndex, newIndex) {
        indicators.forEach((indicator, idx) => {
            if (idx === newIndex) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });

        const outgoingSlide = slides[prevIndex];
        outgoingSlide.classList.remove('active');
        outgoingSlide.style.opacity = '0';
        outgoingSlide.style.transform = 'scale(0.8)';

        const incomingSlide = slides[newIndex];
        incomingSlide.style.display = 'block';

        setTimeout(() => {
            incomingSlide.classList.add('active');
            incomingSlide.style.opacity = '1';
            incomingSlide.style.transform = 'scale(1)';

            setTimeout(() => {
                outgoingSlide.style.display = 'none';
            }, 800);
        }, 10);
    }

    function startSlideShow() {
        clearInterval(slideInterval);
        slideInterval = setInterval(() => {
            moveSlide(1);
        }, slideDuration);
    }

    if (prevBtn) prevBtn.addEventListener('click', () => moveSlide(-1));
    if (nextBtn) nextBtn.addEventListener('click', () => moveSlide(1));

    init();
    carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
    carousel.addEventListener('mouseleave', startSlideShow);
}

// تهيئة جميع الوظائف عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // التحقق من لغة الكوكي
    const preferredLang = getLanguageCookie();
    const currentLang = document.documentElement.lang;

    if (preferredLang && preferredLang !== currentLang) {
        const url = new URL(window.location.href);
        url.searchParams.set('lang', preferredLang);
        window.location.href = url.toString();
    }

    // عرض الشرائح الخلفية
    const backgroundImages = document.querySelectorAll('.background-slideshow img');
    let currentImage = 0;

    function changeBackground() {
        backgroundImages[currentImage].classList.remove('active');
        currentImage = (currentImage + 1) % backgroundImages.length;
        backgroundImages[currentImage].classList.add('active');
    }

    setInterval(changeBackground, 5000);

    // تهيئة الكاروسيلات
    initCarousel('teamCarousel', 'prevBtn', 'nextBtn');
    initCarousel('partnersCarousel', 'partnersPrevBtn', 'partnersNextBtn');

    // تبديل اللغة
    const languageSwitcher = document.querySelector('.language-switcher');
    if (languageSwitcher) {
        const languageBtn = languageSwitcher.querySelector('.language-btn');
        const languageMenu = languageSwitcher.querySelector('.language-menu');

        languageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = languageMenu.style.display === 'block';
            languageMenu.style.display = isOpen ? 'none' : 'block';
        });

        document.addEventListener('click', function(e) {
            if (!languageSwitcher.contains(e.target)) {
                languageMenu.style.display = 'none';
            }
        });

        languageMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        document.querySelectorAll('.language-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const lang = this.getAttribute('data-lang');
                setLanguageCookie(lang);
                const url = new URL(window.location.href);
                url.searchParams.set('lang', lang);
                window.location.href = url.toString();
            });
        });
    }

    // القوائم المنسدلة للهواتف
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        if (window.innerWidth <= 768) {
            const dropbtn = dropdown.querySelector('.dropbtn');
            dropbtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            });
        }
    });

    document.addEventListener('click', function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn *')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });

    
});