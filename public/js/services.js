/* about-us.js — تبديل لغة بلا كوكي/?lang= + خلفية متبدلة */
(() => {
    "use strict";

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
                window.location.assign(buildLocaleUrl(newLocale)); // يولّد HTML الصحيح فورًا
            });
        });
    }

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

    document.addEventListener("DOMContentLoaded", () => {
        setupLanguageSwitcher();
        setupBackgroundSlideshow(5000);
    });
})();
