
<?php

return [
    'setting' => [
        'navigation_label' => 'Settings',
        'model_label' => 'Setting',
        'plural_label' => 'Settings',
        'navigation_group' => 'Public Settings',
        'section' => [
            'label' => 'Key',
            'options' => [
                'about us' => 'About Us',
                'vision' => 'Vision',
                'mission' => 'Mission',
                'target group' => 'Target Group',
            ],
        ],
        'title' => [
            'label' => 'Title',
        ],
        'image' => [
            'label' => 'Image',
        ],
        'content' => [
            'label' => 'Content',
        ],
        'extra' => [
            'label' => 'Additional Settings',
            'key_label' => 'Field Name',
            'value_label' => 'Value',
        ],
        'table' => [
            'title' => 'Title',
            'updated_at' => 'Updated At',
        ],
        'actions' => [
            'edit' => 'Edit',
        ],
    ],




    'article' => [
        'navigation_label' => 'Articles',
        'model_label' => 'Article',
        'plural_model_label' => 'Articles',
        'navigation_group' => 'Content Management',
        'service' => [
            'label' => 'Service',
        ],
        'section' => [
            'label' => 'Section',
        ],
        'title' => [
            'label' => 'Title',
        ],
        'content' => [
            'hint' => 'Upload images and use them easily',
        ],
        'created_at' => [
            'label' => 'Created At',
        ],
        'updated_at' => [
            'label' => 'Updated At',
        ],
        'filters' => [
            'service' => 'Filter by service',
            'section' => 'Filter by section',
        ],
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
            'view' => 'View',
        ],
        'bulk_actions' => [
            'delete' => 'Delete',
        ],
    ],

    'compliant' => [
        'navigation_label' => 'Complaints/Suggestions',
        'model_label' => 'Complaint/Suggestion',
        'plural_model_label' => 'Complaints & Suggestions',
        'navigation_group' => 'Public Settings',
        'user' => [
            'label' => 'User',
        ],
        'content' => [
            'label' => 'Complaint Content',
        ],
        'filters' => [
            'user' => 'Filter by user',
            'today' => "Today's complaints",
        ],
        'actions' => [
            'view' => [
                'modal_heading' => 'Complaint Details',
            ],
            'delete' => [
                'modal_heading' => 'Delete Complaint',
                'modal_description' => 'The complaint will be permanently deleted and cannot be recovered later.',
                'modal_submit' => 'Confirm Delete',
                'modal_cancel' => 'Cancel',
            ],
        ],
        'bulk_actions' => [
            'delete' => 'Delete Selected',
            'delete_modal' => 'Delete Selected Complaints',
            'mark_important' => 'Mark as Important',
        ],
        'groups' => [
            'by_user' => 'By User',
            'by_date' => 'By Date',
        ],
        'empty_state' => [
            'heading' => 'No complaints registered',
            'description' => 'Complaints will be displayed here automatically when submitted from the website',
        ],
    ],


    'user' => [
        'navigation_label' => 'Users',
        'model_label' => 'User',
        'plural_model_label' => 'Users',
        'navigation_group' => 'Member Management',
        'columns' => [
            'name' => 'Name',
            'email' => 'Email',
            'registration_date' => 'Registration Date',
        ],
        'filters' => [
            'registered_this_month' => 'Registered this month',
        ],
        'actions' => [
            'delete' => [
                'modal_heading' => 'Delete User',
                'modal_description' => 'Are you sure you want to delete this user? All associated data will be permanently removed.',
                'modal_submit' => 'Yes, Delete',
                'modal_cancel' => 'Cancel',
            ],
        ],
        'bulk_actions' => [
            'delete' => 'Delete',
            'restore' => 'Restore',
        ],
        'groups' => [
            'by_registration_date' => 'By Registration Date',
        ],
    ],


    'event' => [
        'navigation_label' => 'Events',
        'model_label' => 'Event',
        'plural_model_label' => 'Events',
        'navigation_group' => 'Event Management',

        'sections' => [
            'basic_info' => 'Basic Information',
            'time_location' => 'Time & Location',
            'image_settings' => 'Image & Settings',
        ],

        'fields' => [
            'title' => 'Event Title',
            'type' => 'Event Type',
            'description' => 'Description',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'location' => 'Location',
            'max_participants' => 'Max Participants',
            'cover_image' => 'Cover Image',
            'is_published' => 'Publish Event',
            'status' => 'Status',
            'start' => 'Start',
            'participants' => 'Participants',
        ],

        'types' => [
            'festival' => 'Festival',
            'volunteering' => 'Volunteering',
            'workshop' => 'Workshop',
        ],

        'participants_count' => ':count participants',
        'no_limit' => 'No limit',

        'filters' => [
            'type' => 'Event Type',
            'published_only' => 'Published Only',
            'upcoming' => 'Upcoming Events',
            'upcoming_indicator' => 'Upcoming',
        ],

        'actions' => [
            'label' => 'Actions',
            'publish' => 'Publish',
        ],

        'bulk_actions' => [
            'label' => 'Bulk Actions',
            'delete' => 'Delete Selected',
            'publish' => 'Publish Selected',
        ],

        'groups' => [
            'by_date' => 'By Date',
            'by_type' => 'By Type',
        ],
    ],

    'partner' => [
        'navigation_label' => 'Partners',
        'model_label' => 'Partner',
        'plural_model_label' => 'Partners',
        'navigation_group' => 'Member Management',

        'sections' => [
            'basic_info' => 'Basic Information',
        ],

        'fields' => [
            'logo' => 'Partner Logo',
            'name' => 'Name',
            'description' => 'Description',
        ],

        'actions' => [
            'edit' => 'Edit',
            'delete' => [
                'label' => 'Delete',
                'modal_heading' => 'Delete Partner',
                'modal_description' => 'Are you sure you want to delete this partner? All associated data will be deleted.',
                'success_message' => 'Partner deleted successfully',
            ],
        ],

        'bulk_actions' => [
            'delete' => 'Delete Selected',
            'delete_modal' => 'Delete Selected Partners',
        ],

        'groups' => [
            'by_date' => 'By Addition Date',
        ],

        'empty_state' => [
            'heading' => 'No partners registered yet',
            'description' => 'Click "Add Partner" button to start registration',
        ],
    ],

    'section' => [
        'navigation_label' => 'Sections',
        'model_label' => 'Section',
        'plural_model_label' => 'Sections',
        'navigation_group' => 'Content Management',

        'fields' => [
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'services_count' => 'Services Count',
            'created_at' => 'Created At',
        ],

        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
            'view' => 'View',
        ],

        'bulk_actions' => [
            'delete' => 'Delete',
        ],
    ],

    'service' => [
        'navigation_label' => 'Services',
        'model_label' => 'Service',
        'plural_model_label' => 'Services',
        'navigation_group' => 'Content Management',

        'fields' => [
            'section' => 'Section',
            'name' => 'Name',
            'description' => 'Description',
            'section_name' => 'Section Name',
            'service_name' => 'Service Name',
            'articles_count' => 'Articles Count',
            'created_at' => 'Created At',
        ],

        'filters' => [
            'section' => 'Filter by Section',
        ],

        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],

        'bulk_actions' => [
            'delete' => 'Delete',
        ],
    ],


    'volunteer' => [
        'navigation_label' => 'Volunteers',
        'model_label' => 'Volunteer',
        'plural_model_label' => 'Volunteers',
        'navigation_group' => 'Member Management',

        'sections' => [
            'basic_info' => 'Basic Information',
            'professional_info' => 'Professional Information',
            'availability_management' => 'Availability & Management',
        ],

        'fields' => [
            'profile_photo' => 'Profile Photo',
            'full_name' => 'Full Name',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'national_id' => 'National ID',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'profession' => 'Profession',
            'positions' => 'Positions',
            'positions_placeholder' => 'Add new position',
            'cv' => 'CV',
            'availability' => 'Availability',
            'join_date' => 'Join Date',
            'is_active' => 'Active Volunteer',
            'notes' => 'Notes',
            'status' => 'Status',
        ],

        'gender' => [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
        ],

        'availability' => [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'weekends' => 'Weekends',
        ],

        'skills' => [
            'team_leadership' => 'Team Leadership',
            'translation' => 'Translation',
            'design' => 'Design',
            'programming' => 'Programming',
            'teaching' => 'Teaching',
            'first_aid' => 'First Aid',
        ],

        'filters' => [
            'active_only' => 'Active Volunteers Only',
        ],

        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'view_cv' => 'View CV',
            'delete' => [
                'label' => 'Delete',
                'modal_heading' => 'Delete Volunteer',
                'modal_description' => 'Are you sure you want to delete this volunteer?',
                'modal_submit' => 'Yes, Delete',
                'modal_cancel' => 'Cancel',
            ],
        ],

        'bulk_actions' => [
            'delete' => 'Delete',
            'restore' => 'Restore',
            'activate' => 'Activate Selected',
            'deactivate' => 'Deactivate Selected',
        ],

        'groups' => [
            'by_availability' => 'By Availability',
            'by_status' => 'By Status',
        ],
    ],


];
