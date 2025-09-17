    // فتح/إغلاق قائمة اللغة
        const switcher = document.getElementById('langSwitcher');
        if (switcher) {
            const trigger = switcher.querySelector('.trigger');
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                switcher.classList.toggle('open');
            });
            document.addEventListener('click', (e) => {
                if (!switcher.contains(e.target)) switcher.classList.remove('open');
            });
        }
        (function() {
            const nav = document.querySelector('.nav');
            const toggle = document.querySelector('.nav-toggle');
            if (!nav || !toggle) return;

            toggle.addEventListener('click', () => {
                const open = nav.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });

            // إغلاق عند الضغط خارج القائمة
            document.addEventListener('click', (e) => {
                if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                    nav.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        })();
