/* about-us.js — نسخة محسّنة ونظيفة
   - بدون كوكي لغة ولا ?lang= (منع وميض اللغة)
   - تبديل اللغة بتعديل البادئة (/ar|/en) مباشرة
   - سلايد شو خلفية + نوافذ مودال للأحداث + زر "عرض المزيد"
*/
(() => {
    "use strict";

    // ---------- أدوات صغيرة ----------
    const $ = (s, r = document) => r.querySelector(s);
    const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));

    // يبني رابط بنفس المسار مع تبديل أول سيغمنت إلى ar|en
    function buildLocaleUrl(newLocale) {
        const { pathname, search, hash, origin } = window.location;
        const parts = pathname.split("/").filter(Boolean);
        if (parts.length && (parts[0] === "ar" || parts[0] === "en")) {
            parts[0] = newLocale;
        } else {
            parts.unshift(newLocale);
        }
        return origin + "/" + parts.join("/") + search + hash;
    }

    // ---------- تبديل اللغة من .language-switcher ----------
    function setupLanguageSwitcher() {
        const switcher = $(".language-switcher");
        if (!switcher) return;

        const btn = $(".language-btn", switcher);
        const menu = $(".language-menu", switcher);

        if (btn && menu) {
            btn.addEventListener("click", (e) => {
                e.preventDefault(); e.stopPropagation();
                menu.style.display = menu.style.display === "block" ? "none" : "block";
            });
            document.addEventListener("click", (e) => {
                if (!switcher.contains(e.target)) menu.style.display = "none";
            });
            menu.addEventListener("click", (e) => e.stopPropagation());
        }

        $$("[data-lang]", switcher).forEach((node) => {
            node.addEventListener("click", (e) => {
                e.preventDefault();
                const newLocale = node.getAttribute("data-lang");
                if (!/^(ar|en)$/.test(newLocale)) return;
                window.location.assign(buildLocaleUrl(newLocale)); // HTML صحيح فورًا
            });
        });
    }

    // ---------- سلايد شو الخلفية ----------
    function setupBackgroundSlideshow(intervalMs = 5000) {
        const imgs = $$(".background-slideshow img");
        if (!imgs.length) return;
        if (imgs.length === 1) { imgs[0].classList.add("active"); return; }

        let idx = 0;
        imgs[idx].classList.add("active");
        setInterval(() => {
            const prev = idx;
            idx = (idx + 1) % imgs.length;
            imgs[prev].classList.remove("active");
            imgs[idx].classList.add("active");
        }, intervalMs);
    }

    // ---------- نوافذ مودال للأحداث ----------
    function setupEventModals() {
        const body = document.body;

        function openEventModal(eventId) {
            const modal = document.getElementById("eventModal" + eventId);
            if (!modal) return;
            modal.style.display = "block";
            body.style.overflow = "hidden";
            body.style.position = "fixed";
        }

        function closeEventModal(eventId) {
            const modal = document.getElementById("eventModal" + eventId);
            if (!modal) return;
            modal.style.display = "none";
            body.style.overflow = "auto";
            body.style.position = "static";
        }

        // اجعل الدوال متاحة عالميًا إذا كان القالب يناديها بالـHTML
        window.openEventModal = openEventModal;
        window.closeEventModal = closeEventModal;

        // إغلاق عند النقر خارج المودال
        document.addEventListener("click", (e) => {
            if (e.target.classList?.contains("event-modal")) {
                const modalId = e.target.id.replace("eventModal", "");
                closeEventModal(modalId);
            }
        });

        // إغلاق عند ESC
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                const openModal = document.querySelector('.event-modal[style*="display: block"]');
                if (openModal) {
                    const modalId = openModal.id.replace("eventModal", "");
                    closeEventModal(modalId);
                }
            }
        });

        // زر "عرض المزيد"
        $$(".details-btn").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                const directId = btn.getAttribute("data-event-id");
                const fromHref = btn.href ? btn.href.split("/").pop() : null;
                const eventId = directId || fromHref;
                if (eventId) openEventModal(eventId);
            });
        });
    }

    // ---------- تشغيل ----------
    document.addEventListener("DOMContentLoaded", () => {
        setupLanguageSwitcher();
        setupBackgroundSlideshow(5000);
        setupEventModals();
    });
})();
