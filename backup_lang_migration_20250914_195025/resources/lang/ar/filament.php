<?php

return [
    'setting' => [
        'navigation_label' => 'الإعدادات',
        'model_label' => 'إعداد',
        'plural_label' => 'إعدادات',
        'navigation_group' => 'الإعدادات العامة',
        'section' => [
            'label' => 'مفتاح',
            'options' => [
                'about us' => 'من نحن',
                'vision' => 'رؤيتنا',
                'mission' => 'مهمتنا',
                'target group' => 'أهدافنا',
            ],
        ],
        'title' => [
            'label' => 'العنوان',
        ],
        'image' => [
            'label' => 'صورة',
        ],
        'content' => [
            'label' => 'المحتوى',
        ],
        'extra' => [
            'label' => 'إعدادات إضافية',
            'key_label' => 'اسم الحقل',
            'value_label' => 'القيمة',
        ],
        'table' => [
            'title' => 'العنوان',
            'updated_at' => 'تم التحديث في',
        ],
        'actions' => [
            'edit' => 'تعديل',
        ],
    ],



    'article' => [
        'navigation_label' => 'المقالات',
        'model_label' => 'مقال',
        'plural_model_label' => 'مقالات',
        'navigation_group' => 'إدارة المحتوى',
        'service' => [
            'label' => 'الخدمة',
        ],
        'section' => [
            'label' => 'القسم',
        ],
        'title' => [
            'label' => 'العنوان',
        ],
        'content' => [
            'hint' => 'قم برفع الصور واستخدامها بسهولة',
            'label' => 'المحتوى',
        ],
        'created_at' => [
            'label' => 'تاريخ الإنشاء',
        ],
        'updated_at' => [
            'label' => 'تاريخ التحديث',
        ],
        'filters' => [
            'service' => 'تصفية حسب الخدمة',
            'section' => 'تصفية حسب القسم',
        ],
        'actions' => [
            'edit' => 'تعديل',
            'delete' => 'حذف',
            'view' => 'عرض',
        ],
        'bulk_actions' => [
            'delete' => 'حذف',
        ],
    ],

    'compliant' => [
        'navigation_label' => 'الشكاوى والمقترحات',
        'model_label' => 'شكوى/مقترح',
        'plural_model_label' => 'الشكاوى والمقترحات',
        'navigation_group' => 'الإعدادات العامة',
        'user' => [
            'label' => 'المستخدم',
        ],
        'content' => [
            'label' => 'محتوى الشكوى',
        ],
        'filters' => [
            'user' => 'تصفية بالمستخدم',
            'today' => 'شكاوى اليوم',
        ],
        'actions' => [
            'view' => [
                'modal_heading' => 'تفاصيل الشكوى',
            ],
            'delete' => [
                'modal_heading' => 'حذف الشكوى',
                'modal_description' => 'سيتم حذف الشكوى بشكل دائم ولا يمكن استرجاعها لاحقاً.',
                'modal_submit' => 'تأكيد الحذف',
                'modal_cancel' => 'إلغاء',
            ],
        ],
        'bulk_actions' => [
            'delete' => 'حذف المحدد',
            'delete_modal' => 'حذف الشكاوى المحددة',
            'mark_important' => 'وضع علامة مهم',
        ],
        'groups' => [
            'by_user' => 'حسب المستخدم',
            'by_date' => 'حسب التاريخ',
        ],
        'empty_state' => [
            'heading' => 'لا توجد شكاوى مسجلة',
            'description' => 'سيتم عرض الشكاوى هنا تلقائياً عند إرسالها من الموقع',
        ],
    ],

    'user' => [
        'navigation_label' => 'المستخدمين',
        'model_label' => 'مستخدم',
        'plural_model_label' => 'المستخدمين',
        'navigation_group' => 'إدارة الأعضاء',
        'columns' => [
            'name' => 'الاسم',
            'email' => 'البريد',
            'registration_date' => 'تاريخ التسجيل',
        ],
        'filters' => [
            'registered_this_month' => 'مسجلون هذا الشهر',
        ],
        'actions' => [
            'delete' => [
                'modal_heading' => 'حذف المستخدم',
                'modal_description' => 'هل أنت متأكد من رغبتك في حذف هذا المستخدم؟ سيتم إزالة جميع البيانات المرتبطة به بشكل دائم.',
                'modal_submit' => 'نعم، احذف',
                'modal_cancel' => 'إلغاء',
            ],
        ],
        'bulk_actions' => [
            'delete' => 'حذف',
            'restore' => 'استعادة',
        ],
        'groups' => [
            'by_registration_date' => 'حسب تاريخ التسجيل',
        ],
    ],

    'event' => [
        'navigation_label' => 'الفعاليات',
        'model_label' => 'فعالية',
        'plural_model_label' => 'الفعاليات',
        'navigation_group' => 'إدارة الفعاليات',

        'sections' => [
            'basic_info' => 'المعلومات الأساسية',
            'time_location' => 'التوقيت والمكان',
            'image_settings' => 'الصورة والإعدادات',
        ],

        'fields' => [
            'title' => 'عنوان الفعالية',
            'type' => 'نوع الفعالية',
            'description' => 'وصف الفعالية',
            'start_date' => 'تاريخ البداية',
            'end_date' => 'تاريخ النهاية',
            'location' => 'المكان',
            'max_participants' => 'العدد الأقصى للمشاركين',
            'cover_image' => 'صورة الغلاف',
            'is_published' => 'نشر الفعالية',
            'status' => 'الحالة',
            'start' => 'البداية',
            'participants' => 'المشاركون',
        ],

        'types' => [
            'festival' => 'مهرجان',
            'volunteering' => 'تطوع',
            'workshop' => 'ورشة عمل',
        ],

        'participants_count' => ':count مشارك',
        'no_limit' => 'لا يوجد حد',

        'filters' => [
            'type' => 'نوع الفعالية',
            'published_only' => 'الفعاليات المنشورة فقط',
            'upcoming' => 'الفعاليات القادمة',
            'upcoming_indicator' => 'قادمة',
        ],

        'actions' => [
            'label' => 'الإجراءات',
            'publish' => 'نشر',
        ],

        'bulk_actions' => [
            'label' => 'إجراءات جماعية',
            'delete' => 'حذف المحدد',
            'publish' => 'نشر المحدد',
        ],

        'groups' => [
            'by_date' => 'حسب التاريخ',
            'by_type' => 'حسب النوع',
        ],
    ],

    'partner' => [
        'navigation_label' => 'الشركاء',
        'model_label' => 'شريك',
        'plural_model_label' => 'الشركاء',
        'navigation_group' => 'إدارة الأعضاء',

        'sections' => [
            'basic_info' => 'المعلومات الأساسية',
        ],

        'fields' => [
            'logo' => 'شعار الشريك',
            'name' => 'الاسم',
            'description' => 'الوصف',
        ],

        'actions' => [
            'edit' => 'تعديل',
            'delete' => [
                'label' => 'حذف',
                'modal_heading' => 'حذف الشريك',
                'modal_description' => 'هل أنت متأكد من رغبتك في حذف هذا الشريك؟ سيتم حذف جميع البيانات المرتبطة به.',
                'success_message' => 'تم حذف الشريك بنجاح',
            ],
        ],

        'bulk_actions' => [
            'delete' => 'حذف المحدد',
            'delete_modal' => 'حذف الشركاء المحددين',
        ],

        'groups' => [
            'by_date' => 'حسب تاريخ الإضافة',
        ],

        'empty_state' => [
            'heading' => 'لا يوجد شركاء مسجلين بعد',
            'description' => 'اضغط على زر "إضافة شريك" لبدء التسجيل',
        ],
    ],

    'section' => [
        'navigation_label' => 'الأقسام',
        'model_label' => 'قسم',
        'plural_model_label' => 'الأقسام',
        'navigation_group' => 'إدارة المحتوى',

        'fields' => [
            'name' => 'الاسم',
            'description' => 'الوصف',
            'image' => 'الصورة',
            'services_count' => 'عدد الخدمات',
            'created_at' => 'تاريخ الإنشاء',
        ],

        'actions' => [
            'edit' => 'تعديل',
            'delete' => 'حذف',
            'view' => 'عرض',
        ],

        'bulk_actions' => [
            'delete' => 'حذف',
        ],
    ],


    'service' => [
        'navigation_label' => 'الخدمات',
        'model_label' => 'خدمة',
        'plural_model_label' => 'الخدمات',
        'navigation_group' => 'إدارة المحتوى',

        'fields' => [
            'section' => 'القسم',
            'name' => 'الاسم',
            'description' => 'الوصف',
            'section_name' => 'اسم القسم',
            'service_name' => 'اسم الخدمة',
            'articles_count' => 'عدد المقالات',
            'created_at' => 'تاريخ الإنشاء',
        ],

        'filters' => [
            'section' => 'تصفية حسب القسم',
        ],

        'actions' => [
            'edit' => 'تعديل',
            'delete' => 'حذف',
        ],

        'bulk_actions' => [
            'delete' => 'حذف',
        ],
    ],


    'volunteer' => [
        'navigation_label' => 'المتطوعين',
        'model_label' => 'متطوع',
        'plural_model_label' => 'المتطوعين',
        'navigation_group' => 'إدارة الأعضاء',

        'sections' => [
            'basic_info' => 'المعلومات الأساسية',
            'professional_info' => 'المعلومات المهنية',
            'availability_management' => 'التوفر والإدارة',
        ],

        'fields' => [
            'profile_photo' => 'صورة شخصية',
            'full_name' => 'الاسم بالكامل',
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'national_id' => 'رقم الهوية',
            'birth_date' => 'تاريخ الميلاد',
            'gender' => 'الجنس',
            'profession' => 'المهنة',
            'positions' => 'المنصب',
            'positions_placeholder' => 'أضف منصب جديد',
            'cv' => 'السيرة الذاتية',
            'availability' => 'التوفر',
            'join_date' => 'تاريخ الانضمام',
            'is_active' => 'متطوع نشط',
            'notes' => 'ملاحظات',
            'status' => 'الحالة',
        ],

        'gender' => [
            'male' => 'ذكر',
            'female' => 'أنثى',
            'other' => 'أخرى',
        ],

        'availability' => [
            'full_time' => 'دوام كامل',
            'part_time' => 'دوام جزئي',
            'weekends' => 'عطلات نهاية الأسبوع',
        ],

        'skills' => [
            'team_leadership' => 'قيادة فرق',
            'translation' => 'الترجمة',
            'design' => 'التصميم',
            'programming' => 'البرمجة',
            'teaching' => 'التدريس',
            'first_aid' => 'الإسعافات الأولية',
        ],

        'filters' => [
            'active_only' => 'المتطوعين النشطين فقط',
        ],

        'actions' => [
            'view' => 'عرض',
            'edit' => 'تعديل',
            'view_cv' => 'عرض السيرة الذاتية',
            'delete' => [
                'label' => 'حذف',
                'modal_heading' => 'حذف المتطوع',
                'modal_description' => 'هل أنت متأكد من رغبتك في حذف هذا المتطوع؟',
                'modal_submit' => 'نعم، احذف',
                'modal_cancel' => 'إلغاء',
            ],
        ],

        'bulk_actions' => [
            'delete' => 'حذف',
            'restore' => 'استعادة',
            'activate' => 'تفعيل المحدد',
            'deactivate' => 'تعطيل المحدد',
        ],

        'groups' => [
            'by_availability' => 'حسب التوفر',
            'by_status' => 'حسب الحالة',
        ],
    ],


];
