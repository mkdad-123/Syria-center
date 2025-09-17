        document.addEventListener('DOMContentLoaded', function() {
            // تغيير خلفية الصفحة تلقائياً
            const backgroundImages = document.querySelectorAll('.background-slideshow img');
            let currentImage = 0;

            if (backgroundImages.length > 0) {
                backgroundImages[0].classList.add('active');
            }

            function changeBackground() {
                backgroundImages[currentImage].classList.remove('active');
                currentImage = (currentImage + 1) % backgroundImages.length;
                backgroundImages[currentImage].classList.add('active');
            }

            if (backgroundImages.length > 1) {
                setInterval(changeBackground, 5000);
            }

            // التحقق من صحة النموذج وإرساله
            const form = document.getElementById('complaintForm');
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Reset errors and success message
                    document.querySelectorAll('.error-message').forEach(el => {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.form-control').forEach(el => {
                        el.classList.remove('error');
                    });
                    document.getElementById('successMessage').style.display = 'none';

                    // Validate form
                    const emailInput = document.getElementById('email');
                    const contentInput = document.getElementById('content');
                    const emailError = document.getElementById('emailError');
                    const contentError = document.getElementById('contentError');

                    let isValid = true;

                    // Email validation
                    if (!emailInput.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                        emailInput.classList.add('error');
                        emailError.style.display = 'block';
                        isValid = false;
                    }

                    // Content validation
                    if (!contentInput.value || contentInput.value.length < 10) {
                        contentInput.classList.add('error');
                        contentError.style.display = 'block';
                        isValid = false;
                    }

                    if (!isValid) return;

                    // Show loading state
                    const submitBtn = form.querySelector('.submit-btn');
                    const originalBtnText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
                    submitBtn.disabled = true;

                    try {
                        // Create FormData object
                        const formData = new FormData(form);

                        // Convert FormData to plain object
                        const plainFormData = Object.fromEntries(formData.entries());

                        // Add date to the form data
                        plainFormData.date = new Date().toISOString().split('T')[0];

                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(plainFormData)
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw data;
                        }

                        if (data.status === 'success') {
                            // Hide form and show success message
                            form.style.display = 'none';
                            document.getElementById('successMessage').style.display = 'block';

                            // Optional: Redirect after 3 seconds
                            setTimeout(() => {
                                window.location.href = "{{ route('compliants') }}";
                            }, 3000);
                        } else {
                            throw new Error(data.message || 'حدث خطأ غير متوقع');
                        }
                    } catch (error) {
                        console.error('Error:', error);

                        // Handle server-side validation errors
                        if (error.errors) {
                            if (error.errors.email) {
                                emailInput.classList.add('error');
                                emailError.textContent = error.errors.email[0];
                                emailError.style.display = 'block';
                            }
                            if (error.errors.content) {
                                contentInput.classList.add('error');
                                contentError.textContent = error.errors.content[0];
                                contentError.style.display = 'block';
                            }
                        } else {
                            alert(error.message ||
                                'حدث خطأ أثناء إرسال الشكوى، يرجى المحاولة مرة أخرى');
                        }
                    } finally {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    }
                });
            }

            const translations = {
                en: {
                    nav: {
                        sit_n1: "Syrian Center for Sustainable Development",
                        sit_n2: 'and Community Empowerment',
                        home: "Home",
                        services: "Services",
                        events: "Events",
                        complaints: "Contact Us",
                        logout: "Logout"
                    },
                    form: {
                        email: "Email",
                        email_placeholder: "example@domain.com",
                        email_error: "Please enter a valid email address",
                        content: "Complaint Content",
                        content_placeholder: "Please write your complaint details here...",
                        content_error: "Please enter complaint content (at least 10 characters)",
                        submit: "Submit Complaint",
                        note: "We promise to handle your complaint with confidentiality and care",
                    },
                    footer: {
                        copyright: "&copy; 2023 Syrian Center for Sustainable Development. All rights reserved.",
                        quick_links: "Quick Links"
                    },
                    language: {
                        current: "English",
                        ar: "Arabic",
                        en: "English"
                    }
                },
                ar: {
                    nav: {
                        sit_n1: 'المركز السوري للتنمية المستدامة',
                        sit_n2: 'والتمكين المجتمعي',
                        home: "الرئيسية",
                        services: "الخدمات",
                        events: "النشاطات والفعاليات",
                        complaints: "اتصل بنا",
                        logout: "تسجيل خروج"
                    },
                    form: {
                        email: "البريد الإلكتروني",
                        email_placeholder: "example@domain.com",
                        email_error: "يرجى إدخال بريد إلكتروني صحيح",
                        content: "محتوى الشكوى",
                        content_placeholder: "يرجى كتابة تفاصيل شكواك هنا...",
                        content_error: "يرجى إدخال محتوى الشكوى (10 أحرف على الأقل)",
                        submit: "إرسال الشكوى",
                        note: "نعدك بمعالجة شكواك بكل سرية واهتمام"
                    },
                    footer: {
                        copyright: "&copy; 2023 المركز السوري للتنمية المستدامة. جميع الحقوق محفوظة.",
                        quick_links: "روابط سريعة"
                    },
                    language: {
                        current: "العربية",
                        ar: "العربية",
                        en: "English"
                    }
                }
            };

            // تغيير اللغة
            function changeLanguage(lang) {
                document.documentElement.lang = lang;
                document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';

                // تحديث النصوص المترجمة
                document.querySelectorAll('[data-translate]').forEach(element => {
                    const key = element.getAttribute('data-translate');
                    const keys = key.split('.');
                    if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][
                            keys[1]
                        ]) {
                        element.textContent = translations[lang][keys[0]][keys[1]];
                    }
                });

                // تحديث النصوص البديلة
                document.querySelectorAll('[data-translate-placeholder]').forEach(element => {
                    const key = element.getAttribute('data-translate-placeholder');
                    const keys = key.split('.');
                    if (translations[lang] && translations[lang][keys[0]] && translations[lang][keys[0]][
                            keys[1]
                        ]) {
                        element.setAttribute('placeholder', translations[lang][keys[0]][keys[1]]);
                    }
                });

                // تحديث اللغة الحالية في زر اللغة
                document.querySelector('.current-lang').textContent = translations[lang].language.current;
            }

            // معالجة تغيير اللغة
            document.querySelectorAll('[data-lang]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    changeLanguage(lang);
                    localStorage.setItem('preferredLanguage', lang);
                });
            });

            // تحميل اللغة المفضلة من localStorage إذا كانت موجودة
            const preferredLanguage = localStorage.getItem('preferredLanguage') || 'ar';
            changeLanguage(preferredLanguage);
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');

            // Load non-critical JS dynamically
            var script = document.createElement('script');
            script.src = "{{ asset('js/article.js') }}";
            script.defer = true;
            document.body.appendChild(script);
        });
        document.addEventListener('DOMContentLoaded', function() {
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

