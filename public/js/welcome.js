/* welcome.js — locale-prefix friendly, no post-render text swaps
   - No ?lang=… or cookie-driven DOM changes (prevents language flash)
   - Language switching updates the first URL segment (/ar|/en) and reloads
   - Efficient header sizing (ResizeObserver) and scroll hide/show (rAF throttle)
   - Safe, lightweight carousels + background slideshow
*/

(() => {
    "use strict";

    // ---------- small utils ----------
    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
    const on = (el, ev, fn, opts) => el && el.addEventListener(ev, fn, opts);
    const rafThrottle = (fn) => {
        let ticking = false;
        return (...args) => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    ticking = false;
                    fn(...args);
                });
                ticking = true;
            }
        };
    };

    const ready = (fn) => {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", fn, { once: true });
        } else {
            fn();
        }
    };

    // Replace/ensure first path segment is locale (ar|en)
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

    // ---------- header: dynamic padding + hide on scroll ----------
    function setupHeader() {
        const header = $("#siteHeader") || $(".header");
        if (!header) return;

        // Keep CSS var --header-dyn in sync with actual header height
        const setHeaderPad = () => {
            const h = header.offsetHeight || 0;
            document.documentElement.style.setProperty("--header-dyn", `${h}px`);
        };

        // Prefer ResizeObserver (no reflow loops on resize)
        if ("ResizeObserver" in window) {
            const ro = new ResizeObserver(setHeaderPad);
            ro.observe(header);
        } else {
            on(window, "resize", rafThrottle(setHeaderPad), { passive: true });
            on(window, "load", setHeaderPad, { once: true });
        }
        setHeaderPad();

        // Hide header when scrolling down (simple: hidden if scrollY > 0)
        const toggleHeader = () => {
            if (window.scrollY > 0) header.classList.add("is-hidden");
            else header.classList.remove("is-hidden");
        };
        toggleHeader();
        on(document, "scroll", rafThrottle(toggleHeader), { passive: true });
    }

    // ---------- background slideshow (simple fade via .active class) ----------
    function setupBackgroundSlideshow(intervalMs = 5000) {
        const imgs = $$(".background-slideshow img");
        if (imgs.length <= 1) {
            if (imgs[0]) imgs[0].classList.add("active");
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

    // ---------- generic carousel (for teams/partners) ----------
    function initCarousel(carouselId, prevBtnId, nextBtnId) {
        const root = document.getElementById(carouselId);
        if (!root) return;

        const slides = $$(".team-member, .partner", root);
        const indicatorsContainer = $(".carousel-indicators", root);
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);

        // No or single slide: simplify UI and bail
        if (slides.length <= 1) {
            if (prevBtn) prevBtn.style.display = "none";
            if (nextBtn) nextBtn.style.display = "none";
            if (indicatorsContainer) indicatorsContainer.style.display = "none";
            if (slides.length === 1) {
                slides[0].classList.add("active");
                slides[0].style.display = "block";
                slides[0].style.opacity = "1";
                slides[0].style.transform = "scale(1)";
            }
            return;
        }

        // Build indicators once
        if (indicatorsContainer) {
            indicatorsContainer.innerHTML = "";
            slides.forEach((_, i) => {
                const dot = document.createElement("div");
                dot.className = "carousel-indicator" + (i === 0 ? " active" : "");
                dot.setAttribute("data-index", String(i));
                indicatorsContainer.appendChild(dot);
            });
        }

        const indicators = $$(".carousel-indicator", root);
        let current = 0;
        let timer = 0;
        const DURATION = 5000;
        const TRANSITION_MS = 800;

        // Initial state
        slides.forEach((s, i) => {
            s.style.display = i === 0 ? "block" : "none";
            if (i === 0) s.classList.add("active");
        });

        function goto(index) {
            if (index === current) return;
            const prev = current;
            current = index;

            // Indicators
            indicators.forEach((d, i) =>
                d.classList.toggle("active", i === current)
            );

            const out = slides[prev];
            const _in = slides[current];

            // Prepare incoming
            _in.style.display = "block";

            // Animate (CSS-friendly: rely on .active class)
            out.classList.remove("active");
            out.style.opacity = "0";
            out.style.transform = "scale(0.92)";

            // Force next tick to apply styles consistently
            requestAnimationFrame(() => {
                _in.classList.add("active");
                _in.style.opacity = "1";
                _in.style.transform = "scale(1)";
            });

            // After transition, hide previous to avoid tab order & pointer issues
            window.clearTimeout(timer);
            timer = window.setTimeout(() => {
                out.style.display = "none";
            }, TRANSITION_MS);
        }

        function move(dir) {
            const next = (current + dir + slides.length) % slides.length;
            stop();
            goto(next);
            start();
        }

        function start() {
            stop();
            timer = window.setInterval(() => move(1), DURATION);
        }
        function stop() {
            window.clearInterval(timer);
        }

        // Bindings
        indicators.forEach((dot) =>
            on(dot, "click", () => goto(Number(dot.getAttribute("data-index"))))
        );
        on(prevBtn, "click", () => move(-1));
        on(nextBtn, "click", () => move(1));
        on(root, "mouseenter", stop, { passive: true });
        on(root, "mouseleave", start, { passive: true });

        start();
    }

    // ---------- language switcher (URL prefix swap) ----------
    function setupLanguageSwitcher() {
        const switcher = $(".language-switcher");
        if (!switcher) return;

        const btn = $(".language-btn", switcher);
        const menu = $(".language-menu", switcher);

        if (btn && menu) {
            on(btn, "click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                const open = menu.style.display === "block";
                menu.style.display = open ? "none" : "block";
            });

            on(document, "click", (e) => {
                if (!switcher.contains(e.target)) menu.style.display = "none";
            });

            on(menu, "click", (e) => e.stopPropagation());
        }

        // Accept links/buttons with data-lang anywhere inside the menu
        $$("[data-lang]", switcher).forEach((node) => {
            on(node, "click", (e) => {
                e.preventDefault();
                const newLocale = node.getAttribute("data-lang");
                if (!newLocale || !/^(ar|en)$/.test(newLocale)) return;
                // Navigate to same path but with locale prefix changed — server will render correct HTML immediately.
                window.location.assign(buildLocaleUrl(newLocale));
            });
        });
    }

    // ---------- mobile dropdowns ----------
    function setupMobileDropdowns() {
        const mq = window.matchMedia("(max-width: 768px)");
        const apply = () => {
            const dropdowns = $$(".dropdown");
            if (!dropdowns.length) return;

            // Clean previous to avoid stacking listeners if breakpoint toggles
            dropdowns.forEach((dd) => dd.classList.remove("active"));

            if (mq.matches) {
                dropdowns.forEach((dropdown) => {
                    const btn = $(".dropbtn", dropdown);
                    if (!btn) return;
                    on(btn, "click", (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropdown.classList.toggle("active");
                    });
                });

                on(document, "click", () => {
                    dropdowns.forEach((d) => d.classList.remove("active"));
                });
            }
        };

        apply();
        // Update behavior when crossing breakpoint
        mq.addEventListener?.("change", apply);
    }

    // ---------- boot ----------
    ready(() => {
        setupHeader();
        setupBackgroundSlideshow(5000);

        // Carousels (IDs as per your markup)
        initCarousel("teamCarousel", "prevBtn", "nextBtn");
        initCarousel("partnersCarousel", "partnersPrevBtn", "partnersNextBtn");

        setupLanguageSwitcher();
        setupMobileDropdowns();
    });
})();
