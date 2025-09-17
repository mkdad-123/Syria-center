/* about-us.js — نظيف وخفيف بدون تبديل نصوص بعد التحميل
   - لا ?lang=... ولا كوكي للغة (منع الفلاش تمامًا)
   - تبديل اللغة بتعديل أول مقطع من المسار (/ar | /en) ثم إعادة التوجيه
   - تهيئة هيدر ديناميكي + سلايد شو خلفية بسيطة
*/

(() => {
    "use strict";

    // --------- أدوات صغيرة ---------
    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
    const on = (el, ev, fn, opts) => el && el.addEventListener(ev, fn, opts);
    const rafThrottle = (fn) => {
        let t = false;
        return (...args) => {
            if (!t) {
                requestAnimationFrame(() => { t = false; fn(...args); });
                t = true;
            }
        };
    };
    const ready = (fn) =>
        document.readyState === "loading"
            ? document.addEventListener("DOMContentLoaded", fn, { once: true })
            : fn();

    // ابني رابط بنفس المسار لكن مع استبدال البادئة إلى ar|en
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

    // --------- الهيدر: ارتفاع ديناميكي + إخفاء عند التمرير ---------
    function setupHeader() {
        const header = $("#siteHeader") || $(".header");
        if (!header) return;

        const setHeaderPad = () => {
            document.documentElement.style.setProperty("--header-dyn", `${header.offsetHeight || 0}px`);
        };

        if ("ResizeObserver" in window) {
            const ro = new ResizeObserver(setHeaderPad);
            ro.observe(header);
        } else {
            on(window, "resize", rafThrottle(setHeaderPad), { passive: true });
            on(window, "load", setHeaderPad, { once: true });
        }
        setHeaderPad();

        const toggleHeader = () => {
            if (window.scrollY > 0) header.classList.add("is-hidden");
            else header.classList.remove("is-hidden");
        };
        toggleHeader();
        on(document, "scroll", rafThrottle(toggleHeader), { passive: true });
    }

    // --------- خلفية متبدّلة (fade عبر .active) ---------
    function setupBackgroundSlideshow(intervalMs = 5000) {
        const imgs = $$(".background-slideshow img");
        if (!imgs.length) return;
        if (imgs.length === 1) {
            imgs[0].classList.add("active");
            return;
        }
        let idx = 0;
        imgs[idx].classList.add("active");
        setInterval(() => {
            const prev = idx;
            idx = (idx + 1) % imgs.length;
            imgs[prev].classList.remove("active");
            imgs[idx].classList.add("active");
        }, intervalMs);
    }

    // --------- مبدّل اللغة (قائمة بسيطة) ---------
    function setupLanguageSwitcher() {
        const switcher = $(".language-switcher");
        if (!switcher) return;

        const btn = $(".language-btn", switcher);
        const menu = $(".language-menu", switcher);

        if (btn && menu) {
            on(btn, "click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                menu.style.display = menu.style.display === "block" ? "none" : "block";
            });
            on(document, "click", (e) => {
                if (!switcher.contains(e.target)) menu.style.display = "none";
            });
            on(menu, "click", (e) => e.stopPropagation());
        }

        $$("[data-lang]", switcher).forEach((node) => {
            on(node, "click", (e) => {
                e.preventDefault();
                const newLocale = node.getAttribute("data-lang");
                if (!/^(ar|en)$/.test(newLocale)) return;
                window.location.assign(buildLocaleUrl(newLocale)); // يولّد HTML الصحيح فورًا
            });
        });
    }

    // --------- تشغيل ---------
    ready(() => {
        setupHeader();
        setupBackgroundSlideshow(5000);
        setupLanguageSwitcher();
    });
})();
