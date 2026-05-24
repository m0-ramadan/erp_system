@php
$qwResourceMap = [
    'accounts_reviews' => [
        'title' => 'مراجعات الحسابات',
        'singular' => 'مراجعات الحسابات',
        'route' => 'admin.accounts-reviews',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'cost_estimation_id' => [
                'label' => 'تقدير التكلفة',
                'type' => 'relation',
                'model' => '\\App\\Models\\CostEstimation',
                'option_label' => 'estimation_no'
            ],
            'reviewed_by' => [
                'label' => 'تمت المراجعة بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'decision' => [
                'label' => 'القرار',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'approved' => 'معتمد',
                    'returned_for_correction' => 'مرتجع للتصحيح',
                    'rejected' => 'مرفوض'
                ]
            ],
            'credit_limit_checked' => [
                'label' => 'تم فحص الحد الائتماني',
                'type' => 'boolean'
            ],
            'payment_terms_id' => [
                'label' => 'شروط الدفع',
                'type' => 'relation',
                'model' => '\\App\\Models\\PaymentTerm',
                'option_label' => 'name'
            ],
            'financial_notes' => [
                'label' => 'ملاحظات مالية',
                'type' => 'textarea'
            ],
            'correction_required' => [
                'label' => 'التصحيح المطلوب',
                'type' => 'textarea'
            ],
            'reviewed_at' => [
                'label' => 'وقت المراجعة',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quote_request_id', 'cost_estimation_id', 'reviewed_by', 'decision', 'credit_limit_checked', 'payment_terms_id', 'financial_notes'],
        'form' => ['quote_request_id', 'cost_estimation_id', 'reviewed_by', 'decision', 'credit_limit_checked', 'payment_terms_id', 'financial_notes', 'correction_required', 'reviewed_at']
    ],
    'audit_logs' => [
        'title' => 'سجل التدقيق',
        'singular' => 'سجل التدقيق',
        'route' => 'admin.audit-logs',
        'icon' => 'ti ti-table',
        'fields' => [
            'entity_type' => [
                'label' => 'نوع الكيان',
                'type' => 'text'
            ],
            'entity_id' => [
                'label' => 'رقم الكيان',
                'type' => 'text'
            ],
            'action' => [
                'label' => 'Action',
                'type' => 'text'
            ],
            'old_values' => [
                'label' => 'القيم القديمة',
                'type' => 'textarea'
            ],
            'new_values' => [
                'label' => 'القيم الجديدة',
                'type' => 'textarea'
            ],
            'ip_address' => [
                'label' => 'IP',
                'type' => 'text'
            ],
            'user_agent' => [
                'label' => 'المتصفح',
                'type' => 'textarea'
            ],
            'performed_by' => [
                'label' => 'تم بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'performed_at' => [
                'label' => 'وقت التنفيذ',
                'type' => 'datetime'
            ]
        ],
        'table' => ['entity_type', 'entity_id', 'action', 'ip_address', 'performed_by', 'performed_at'],
        'form' => ['entity_type', 'entity_id', 'action', 'old_values', 'new_values', 'ip_address', 'user_agent', 'performed_by', 'performed_at']
    ],
    'clarifications' => [
        'title' => 'الاستفسارات والتوضيحات',
        'singular' => 'الاستفسارات والتوضيحات',
        'route' => 'admin.clarifications',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'requested_by' => [
                'label' => 'طلب بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'assigned_to' => [
                'label' => 'مسند إلى',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'question' => [
                'label' => 'السؤال',
                'type' => 'textarea'
            ],
            'response' => [
                'label' => 'الرد',
                'type' => 'textarea'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'open' => 'مفتوح',
                    'answered' => 'تم الرد',
                    'closed' => 'مغلق',
                    'cancelled' => 'ملغي'
                ]
            ],
            'requested_at' => [
                'label' => 'وقت الطلب',
                'type' => 'datetime'
            ],
            'responded_at' => [
                'label' => 'وقت الرد',
                'type' => 'datetime'
            ],
            'closed_at' => [
                'label' => 'وقت الإغلاق',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quote_request_id', 'requested_by', 'assigned_to', 'question', 'response', 'status'],
        'form' => ['quote_request_id', 'requested_by', 'assigned_to', 'question', 'response', 'status', 'requested_at', 'responded_at', 'closed_at']
    ],
    'cost_estimations' => [
        'title' => 'تقديرات التكلفة',
        'singular' => 'تقديرات التكلفة',
        'route' => 'admin.cost-estimations',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'estimation_no' => [
                'label' => 'رقم التقدير',
                'type' => 'text'
            ],
            'version_no' => [
                'label' => 'رقم الإصدار',
                'type' => 'text'
            ],
            'estimated_by' => [
                'label' => 'قدّر بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'submitted' => 'تم الإرسال',
                    'revised' => 'تم التعديل',
                    'approved' => 'معتمد',
                    'rejected' => 'مرفوض'
                ]
            ],
            'material_cost' => [
                'label' => 'تكلفة المواد',
                'type' => 'number'
            ],
            'labor_cost' => [
                'label' => 'تكلفة العمالة',
                'type' => 'number'
            ],
            'overhead_cost' => [
                'label' => 'تكاليف تشغيلية',
                'type' => 'number'
            ],
            'subcontract_cost' => [
                'label' => 'تكلفة مقاول باطن',
                'type' => 'number'
            ],
            'margin_percent' => [
                'label' => 'نسبة هامش الربح',
                'type' => 'number'
            ],
            'discount_percent' => [
                'label' => 'نسبة الخصم',
                'type' => 'number'
            ],
            'tax_percent' => [
                'label' => 'نسبة الضريبة',
                'type' => 'number'
            ],
            'total_cost' => [
                'label' => 'إجمالي التكلفة',
                'type' => 'number'
            ],
            'selling_price' => [
                'label' => 'سعر البيع',
                'type' => 'number'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['quote_request_id', 'estimation_no', 'version_no', 'estimated_by', 'status', 'material_cost'],
        'form' => ['quote_request_id', 'estimation_no', 'version_no', 'estimated_by', 'status', 'material_cost', 'labor_cost', 'overhead_cost', 'subcontract_cost', 'margin_percent', 'discount_percent', 'tax_percent', 'total_cost', 'selling_price', 'notes']
    ],
    'cost_estimation_items' => [
        'title' => 'بنود تقدير التكلفة',
        'singular' => 'بنود تقدير التكلفة',
        'route' => 'admin.cost-estimation-items',
        'icon' => 'ti ti-table',
        'fields' => [
            'cost_estimation_id' => [
                'label' => 'تقدير التكلفة',
                'type' => 'relation',
                'model' => '\\App\\Models\\CostEstimation',
                'option_label' => 'estimation_no'
            ],
            'quote_request_item_id' => [
                'label' => 'بند طلب العرض',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequestItem',
                'option_label' => 'product_name'
            ],
            'line_no' => [
                'label' => 'رقم البند',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'cost_type' => [
                'label' => 'نوع التكلفة',
                'type' => 'select',
                'options' => [
                    'material' => 'مواد',
                    'labor' => 'عمالة',
                    'overhead' => 'تشغيلي',
                    'subcontract' => 'مقاول باطن',
                    'other' => 'أخرى'
                ]
            ],
            'quantity' => [
                'label' => 'الكمية',
                'type' => 'number'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'unit_cost' => [
                'label' => 'تكلفة الوحدة',
                'type' => 'number'
            ],
            'total_cost' => [
                'label' => 'إجمالي التكلفة',
                'type' => 'number'
            ],
            'supplier_name' => [
                'label' => 'اسم المورد',
                'type' => 'text'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['cost_estimation_id', 'quote_request_item_id', 'line_no', 'cost_type', 'quantity', 'unit', 'supplier_name'],
        'form' => ['cost_estimation_id', 'quote_request_item_id', 'line_no', 'description', 'cost_type', 'quantity', 'unit', 'unit_cost', 'total_cost', 'supplier_name', 'notes']
    ],
    'currencies' => [
        'title' => 'العملات',
        'singular' => 'العملات',
        'route' => 'admin.currencies',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'symbol' => [
                'label' => 'الرمز',
                'type' => 'text'
            ],
            'exchange_rate_to_base' => [
                'label' => 'سعر التحويل للعملة الأساسية',
                'type' => 'number'
            ],
            'is_base' => [
                'label' => 'عملة أساسية',
                'type' => 'boolean'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['code', 'name', 'symbol', 'exchange_rate_to_base', 'is_base', 'is_active'],
        'form' => ['code', 'name', 'symbol', 'exchange_rate_to_base', 'is_base', 'is_active']
    ],
    'customer_contacts' => [
        'title' => 'جهات اتصال العملاء',
        'singular' => 'جهات اتصال العملاء',
        'route' => 'admin.customer-contacts',
        'icon' => 'ti ti-table',
        'fields' => [
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'contact_name' => [
                'label' => 'اسم جهة الاتصال',
                'type' => 'text'
            ],
            'job_title' => [
                'label' => 'المسمى الوظيفي',
                'type' => 'text'
            ],
            'email' => [
                'label' => 'البريد الإلكتروني',
                'type' => 'text'
            ],
            'phone' => [
                'label' => 'الهاتف',
                'type' => 'text'
            ],
            'is_primary' => [
                'label' => 'أساسي',
                'type' => 'boolean'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['customer_id', 'contact_name', 'job_title', 'email', 'phone', 'is_primary'],
        'form' => ['customer_id', 'contact_name', 'job_title', 'email', 'phone', 'is_primary', 'notes']
    ],
    'customers' => [
        'title' => 'العملاء',
        'singular' => 'العملاء',
        'route' => 'admin.customers',
        'icon' => 'ti ti-table',
        'fields' => [
            'customer_code' => [
                'label' => 'كود العميل',
                'type' => 'text'
            ],
            'company_name' => [
                'label' => 'اسم الشركة',
                'type' => 'text'
            ],
            'customer_type' => [
                'label' => 'نوع العميل',
                'type' => 'select',
                'options' => [
                    'new' => 'جديد',
                    'existing' => 'حالي',
                    'prospect' => 'محتمل'
                ]
            ],
            'tax_number' => [
                'label' => 'الرقم الضريبي',
                'type' => 'text'
            ],
            'commercial_register' => [
                'label' => 'السجل التجاري',
                'type' => 'text'
            ],
            'email' => [
                'label' => 'البريد الإلكتروني',
                'type' => 'text'
            ],
            'phone' => [
                'label' => 'الهاتف',
                'type' => 'text'
            ],
            'address_line1' => [
                'label' => 'العنوان 1',
                'type' => 'text'
            ],
            'address_line2' => [
                'label' => 'العنوان 2',
                'type' => 'text'
            ],
            'city' => [
                'label' => 'المدينة',
                'type' => 'text'
            ],
            'country' => [
                'label' => 'الدولة',
                'type' => 'text'
            ],
            'assigned_sales_rep_id' => [
                'label' => 'مسؤول المبيعات',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'active' => 'نشط',
                    'inactive' => 'غير نشط',
                    'blacklisted' => 'محظور'
                ]
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['customer_code', 'company_name', 'customer_type', 'tax_number', 'commercial_register', 'email', 'phone', 'status'],
        'form' => ['customer_code', 'company_name', 'customer_type', 'tax_number', 'commercial_register', 'email', 'phone', 'address_line1', 'address_line2', 'city', 'country', 'assigned_sales_rep_id', 'status', 'notes', 'created_by']
    ],
    'customer_responses' => [
        'title' => 'ردود العملاء',
        'singular' => 'ردود العملاء',
        'route' => 'admin.customer-responses',
        'icon' => 'ti ti-table',
        'fields' => [
            'quotation_id' => [
                'label' => 'عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\Quotation',
                'option_label' => 'quotation_no'
            ],
            'quotation_version_id' => [
                'label' => 'إصدار عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuotationVersion',
                'option_label' => 'version_no'
            ],
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'contact_id' => [
                'label' => 'جهة الاتصال',
                'type' => 'relation',
                'model' => '\\App\\Models\\CustomerContact',
                'option_label' => 'contact_name'
            ],
            'response' => [
                'label' => 'الرد',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'accepted' => 'مقبول',
                    'rejected' => 'مرفوض',
                    'revision_requested' => 'تعديل مطلوب',
                    'no_response' => 'لا يوجد رد'
                ]
            ],
            'response_notes' => [
                'label' => 'ملاحظات الرد',
                'type' => 'textarea'
            ],
            'revision_details' => [
                'label' => 'تفاصيل التعديل',
                'type' => 'textarea'
            ],
            'rejection_reason' => [
                'label' => 'سبب الرفض',
                'type' => 'textarea'
            ],
            'responded_at' => [
                'label' => 'وقت الرد',
                'type' => 'datetime'
            ],
            'recorded_by' => [
                'label' => 'سجل بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['quotation_id', 'quotation_version_id', 'customer_id', 'contact_id', 'response', 'response_notes'],
        'form' => ['quotation_id', 'quotation_version_id', 'customer_id', 'contact_id', 'response', 'response_notes', 'revision_details', 'rejection_reason', 'responded_at', 'recorded_by']
    ],
    'deliveries' => [
        'title' => 'التسليمات',
        'singular' => 'التسليمات',
        'route' => 'admin.deliveries',
        'icon' => 'ti ti-table',
        'fields' => [
            'dispatch_id' => [
                'label' => 'الشحنة',
                'type' => 'relation',
                'model' => '\\App\\Models\\Dispatch',
                'option_label' => 'dispatch_no'
            ],
            'sales_order_id' => [
                'label' => 'أمر البيع',
                'type' => 'relation',
                'model' => '\\App\\Models\\SalesOrder',
                'option_label' => 'order_no'
            ],
            'delivery_no' => [
                'label' => 'رقم التسليم',
                'type' => 'text'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'confirmed' => 'تم التأكيد',
                    'failed' => 'فشل',
                    'returned' => 'مرتجع'
                ]
            ],
            'received_by_name' => [
                'label' => 'اسم المستلم',
                'type' => 'text'
            ],
            'received_by_phone' => [
                'label' => 'هاتف المستلم',
                'type' => 'text'
            ],
            'proof_file_path' => [
                'label' => 'إثبات التسليم',
                'type' => 'text'
            ],
            'delivered_at' => [
                'label' => 'وقت التسليم',
                'type' => 'datetime'
            ],
            'confirmed_by' => [
                'label' => 'أكد بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['dispatch_id', 'sales_order_id', 'delivery_no', 'status', 'received_by_name', 'received_by_phone'],
        'form' => ['dispatch_id', 'sales_order_id', 'delivery_no', 'status', 'received_by_name', 'received_by_phone', 'proof_file_path', 'delivered_at', 'confirmed_by', 'notes']
    ],
    'departments' => [
        'title' => 'الأقسام',
        'singular' => 'الأقسام',
        'route' => 'admin.departments',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['code', 'name', 'is_active'],
        'form' => ['code', 'name', 'description', 'is_active']
    ],
    'design_reviews' => [
        'title' => 'مراجعات التصميم',
        'singular' => 'مراجعات التصميم',
        'route' => 'admin.design-reviews',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'reviewed_by' => [
                'label' => 'تمت المراجعة بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'feasibility_status' => [
                'label' => 'حالة الجدوى',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'feasible' => 'ممكن',
                    'feasible_with_notes' => 'ممكن بملاحظات',
                    'not_feasible' => 'غير ممكن'
                ]
            ],
            'decision' => [
                'label' => 'القرار',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'approved' => 'معتمد',
                    'approved_with_notes' => 'معتمد بملاحظات',
                    'rejected' => 'مرفوض'
                ]
            ],
            'design_notes' => [
                'label' => 'ملاحظات التصميم',
                'type' => 'textarea'
            ],
            'rejection_reason' => [
                'label' => 'سبب الرفض',
                'type' => 'textarea'
            ],
            'reviewed_at' => [
                'label' => 'وقت المراجعة',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quote_request_id', 'reviewed_by', 'feasibility_status', 'decision', 'design_notes', 'rejection_reason'],
        'form' => ['quote_request_id', 'reviewed_by', 'feasibility_status', 'decision', 'design_notes', 'rejection_reason', 'reviewed_at']
    ],
    'dispatches' => [
        'title' => 'الشحنات',
        'singular' => 'الشحنات',
        'route' => 'admin.dispatches',
        'icon' => 'ti ti-table',
        'fields' => [
            'sales_order_id' => [
                'label' => 'أمر البيع',
                'type' => 'relation',
                'model' => '\\App\\Models\\SalesOrder',
                'option_label' => 'order_no'
            ],
            'job_ticket_id' => [
                'label' => 'تذكرة التشغيل',
                'type' => 'relation',
                'model' => '\\App\\Models\\JobTicket',
                'option_label' => 'ticket_no'
            ],
            'dispatch_no' => [
                'label' => 'رقم الشحنة',
                'type' => 'text'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'dispatched' => 'تم الشحن',
                    'returned' => 'مرتجع',
                    'cancelled' => 'ملغي'
                ]
            ],
            'carrier_name' => [
                'label' => 'شركة الشحن',
                'type' => 'text'
            ],
            'tracking_no' => [
                'label' => 'رقم التتبع',
                'type' => 'text'
            ],
            'dispatch_address' => [
                'label' => 'عنوان الشحن',
                'type' => 'textarea'
            ],
            'dispatched_by' => [
                'label' => 'شحن بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'dispatched_at' => [
                'label' => 'وقت الشحن',
                'type' => 'datetime'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['sales_order_id', 'job_ticket_id', 'dispatch_no', 'status', 'carrier_name', 'tracking_no'],
        'form' => ['sales_order_id', 'job_ticket_id', 'dispatch_no', 'status', 'carrier_name', 'tracking_no', 'dispatch_address', 'dispatched_by', 'dispatched_at', 'notes']
    ],
    'file_types' => [
        'title' => 'أنواع الملفات',
        'singular' => 'أنواع الملفات',
        'route' => 'admin.file-types',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'allowed_extensions' => [
                'label' => 'الامتدادات المسموحة',
                'type' => 'text'
            ],
            'max_size_mb' => [
                'label' => 'أقصى حجم MB',
                'type' => 'text'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['code', 'name', 'allowed_extensions', 'max_size_mb', 'is_active'],
        'form' => ['code', 'name', 'allowed_extensions', 'max_size_mb', 'is_active']
    ],
    'invoices' => [
        'title' => 'الفواتير',
        'singular' => 'الفواتير',
        'route' => 'admin.invoices',
        'icon' => 'ti ti-table',
        'fields' => [
            'sales_order_id' => [
                'label' => 'أمر البيع',
                'type' => 'relation',
                'model' => '\\App\\Models\\SalesOrder',
                'option_label' => 'order_no'
            ],
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'invoice_no' => [
                'label' => 'رقم الفاتورة',
                'type' => 'text'
            ],
            'invoice_date' => [
                'label' => 'تاريخ الفاتورة',
                'type' => 'date'
            ],
            'due_date' => [
                'label' => 'تاريخ الاستحقاق',
                'type' => 'date'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'issued' => 'مصدرة',
                    'partially_paid' => 'مدفوعة جزئيًا',
                    'paid' => 'مدفوعة',
                    'overdue' => 'متأخرة',
                    'cancelled' => 'ملغي'
                ]
            ],
            'subtotal' => [
                'label' => 'الإجمالي الفرعي',
                'type' => 'number'
            ],
            'discount_amount' => [
                'label' => 'قيمة الخصم',
                'type' => 'number'
            ],
            'tax_amount' => [
                'label' => 'قيمة الضريبة',
                'type' => 'number'
            ],
            'total_amount' => [
                'label' => 'الإجمالي',
                'type' => 'number'
            ],
            'paid_amount' => [
                'label' => 'المدفوع',
                'type' => 'number'
            ],
            'pdf_path' => [
                'label' => 'مسار PDF',
                'type' => 'text'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'issued_at' => [
                'label' => 'وقت الإصدار',
                'type' => 'datetime'
            ]
        ],
        'table' => ['sales_order_id', 'customer_id', 'invoice_no', 'invoice_date', 'due_date', 'status'],
        'form' => ['sales_order_id', 'customer_id', 'invoice_no', 'invoice_date', 'due_date', 'status', 'subtotal', 'discount_amount', 'tax_amount', 'total_amount', 'paid_amount', 'pdf_path', 'created_by', 'issued_at']
    ],
    'invoice_items' => [
        'title' => 'بنود الفواتير',
        'singular' => 'بنود الفواتير',
        'route' => 'admin.invoice-items',
        'icon' => 'ti ti-table',
        'fields' => [
            'invoice_id' => [
                'label' => 'الفاتورة',
                'type' => 'relation',
                'model' => '\\App\\Models\\Invoice',
                'option_label' => 'invoice_no'
            ],
            'line_no' => [
                'label' => 'رقم البند',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'quantity' => [
                'label' => 'الكمية',
                'type' => 'number'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'unit_price' => [
                'label' => 'Unit Price',
                'type' => 'number'
            ],
            'discount_percent' => [
                'label' => 'نسبة الخصم',
                'type' => 'number'
            ],
            'tax_percent' => [
                'label' => 'نسبة الضريبة',
                'type' => 'number'
            ],
            'line_total' => [
                'label' => 'Line Total',
                'type' => 'text'
            ]
        ],
        'table' => ['invoice_id', 'line_no', 'quantity', 'unit', 'unit_price', 'discount_percent'],
        'form' => ['invoice_id', 'line_no', 'description', 'quantity', 'unit', 'unit_price', 'discount_percent', 'tax_percent', 'line_total']
    ],
    'job_tickets' => [
        'title' => 'تذاكر التشغيل',
        'singular' => 'تذاكر التشغيل',
        'route' => 'admin.job-tickets',
        'icon' => 'ti ti-table',
        'fields' => [
            'sales_order_id' => [
                'label' => 'أمر البيع',
                'type' => 'relation',
                'model' => '\\App\\Models\\SalesOrder',
                'option_label' => 'order_no'
            ],
            'ticket_no' => [
                'label' => 'رقم التذكرة',
                'type' => 'text'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'created' => 'تم الإنشاء',
                    'production_feasibility_review' => 'مراجعة جدوى الإنتاج',
                    'production_planning' => 'تخطيط الإنتاج',
                    'released_to_production' => 'مرسل للإنتاج',
                    'in_production' => 'قيد الإنتاج',
                    'quality_check' => 'فحص جودة',
                    'passed' => 'ناجح',
                    'failed' => 'فشل',
                    'ready_for_dispatch' => 'جاهز للشحن',
                    'dispatched' => 'تم الشحن',
                    'delivered' => 'تم التسليم',
                    'closed' => 'مغلق',
                    'cancelled' => 'ملغي',
                    'on_hold' => 'معلق'
                ]
            ],
            'priority' => [
                'label' => 'الأولوية',
                'type' => 'select',
                'options' => [
                    'low' => 'منخفض',
                    'normal' => 'عادي',
                    'high' => 'مرتفع',
                    'urgent' => 'عاجل'
                ]
            ],
            'production_notes' => [
                'label' => 'ملاحظات الإنتاج',
                'type' => 'textarea'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['sales_order_id', 'ticket_no', 'status', 'priority', 'production_notes', 'created_by'],
        'form' => ['sales_order_id', 'ticket_no', 'status', 'priority', 'production_notes', 'created_by']
    ],
    'management_approvals' => [
        'title' => 'اعتمادات الإدارة',
        'singular' => 'اعتمادات الإدارة',
        'route' => 'admin.management-approvals',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'quotation_id' => [
                'label' => 'عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\Quotation',
                'option_label' => 'quotation_no'
            ],
            'approved_by' => [
                'label' => 'اعتمد بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'decision' => [
                'label' => 'القرار',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'approved' => 'معتمد',
                    'rejected' => 'مرفوض',
                    'returned_to_accounts' => 'مرتجع للحسابات',
                    'returned_to_estimation' => 'مرتجع للتقدير'
                ]
            ],
            'approval_limit_amount' => [
                'label' => 'حد الاعتماد',
                'type' => 'number'
            ],
            'comments' => [
                'label' => 'تعليقات',
                'type' => 'textarea'
            ],
            'decided_at' => [
                'label' => 'وقت القرار',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quote_request_id', 'quotation_id', 'approved_by', 'decision', 'approval_limit_amount', 'comments'],
        'form' => ['quote_request_id', 'quotation_id', 'approved_by', 'decision', 'approval_limit_amount', 'comments', 'decided_at']
    ],
    'notifications' => [
        'title' => 'الإشعارات',
        'singular' => 'الإشعارات',
        'route' => 'admin.notifications',
        'icon' => 'ti ti-table',
        'fields' => [
            'related_entity_type' => [
                'label' => 'نوع الكيان المرتبط',
                'type' => 'select',
                'options' => [
                    'quote_request' => 'طلب عرض',
                    'quotation' => 'عرض سعر',
                    'sales_order' => 'أمر بيع',
                    'job_ticket' => 'تذكرة تشغيل',
                    'invoice' => 'فاتورة',
                    'workflow_task' => 'مهمة سير عمل'
                ]
            ],
            'related_entity_id' => [
                'label' => 'رقم الكيان المرتبط',
                'type' => 'text'
            ],
            'notification_type' => [
                'label' => 'نوع الإشعار',
                'type' => 'select',
                'options' => [
                    'system' => 'نظام',
                    'email' => 'إيميل',
                    'sms' => 'SMS',
                    'whatsapp' => 'واتساب',
                    'in_app' => 'داخل النظام'
                ]
            ],
            'title' => [
                'label' => 'العنوان',
                'type' => 'text'
            ],
            'body' => [
                'label' => 'المحتوى',
                'type' => 'textarea'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'queued' => 'في الانتظار',
                    'sent' => 'مرسل',
                    'failed' => 'فشل',
                    'read' => 'مقروء'
                ]
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'sent_at' => [
                'label' => 'وقت الإرسال',
                'type' => 'datetime'
            ]
        ],
        'table' => ['related_entity_type', 'related_entity_id', 'notification_type', 'title', 'status', 'created_by'],
        'form' => ['related_entity_type', 'related_entity_id', 'notification_type', 'title', 'body', 'status', 'created_by', 'sent_at']
    ],
    'notification_recipients' => [
        'title' => 'مستلمو الإشعارات',
        'singular' => 'مستلمو الإشعارات',
        'route' => 'admin.notification-recipients',
        'icon' => 'ti ti-table',
        'fields' => [
            'notification_id' => [
                'label' => 'الإشعار',
                'type' => 'relation',
                'model' => '\\App\\Models\\Notification',
                'option_label' => 'title'
            ],
            'user_id' => [
                'label' => 'المستخدم',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'customer_contact_id' => [
                'label' => 'جهة اتصال العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\CustomerContact',
                'option_label' => 'contact_name'
            ],
            'recipient_email' => [
                'label' => 'بريد المستلم',
                'type' => 'text'
            ],
            'recipient_phone' => [
                'label' => 'هاتف المستلم',
                'type' => 'text'
            ],
            'delivery_status' => [
                'label' => 'حالة التسليم',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'sent' => 'مرسل',
                    'failed' => 'فشل',
                    'read' => 'مقروء'
                ]
            ],
            'delivered_at' => [
                'label' => 'وقت التسليم',
                'type' => 'datetime'
            ],
            'read_at' => [
                'label' => 'وقت القراءة',
                'type' => 'datetime'
            ]
        ],
        'table' => ['notification_id', 'user_id', 'customer_contact_id', 'recipient_email', 'recipient_phone', 'delivery_status'],
        'form' => ['notification_id', 'user_id', 'customer_contact_id', 'recipient_email', 'recipient_phone', 'delivery_status', 'delivered_at', 'read_at']
    ],
    'payment_terms' => [
        'title' => 'شروط الدفع',
        'singular' => 'شروط الدفع',
        'route' => 'admin.payment-terms',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'days_count' => [
                'label' => 'عدد الأيام',
                'type' => 'text'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['code', 'name', 'days_count', 'is_active'],
        'form' => ['code', 'name', 'description', 'days_count', 'is_active']
    ],
    'permissions' => [
        'title' => 'الصلاحيات',
        'singular' => 'الصلاحيات',
        'route' => 'admin.permissions',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'module' => [
                'label' => 'الموديول',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ]
        ],
        'table' => ['code', 'name', 'module'],
        'form' => ['code', 'name', 'module', 'description']
    ],
    'products' => [
        'title' => 'المنتجات',
        'singular' => 'المنتجات',
        'route' => 'admin.products',
        'icon' => 'ti ti-table',
        'fields' => [
            'sku' => [
                'label' => 'SKU',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'category' => [
                'label' => 'التصنيف',
                'type' => 'text'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['sku', 'name', 'category', 'unit', 'is_active'],
        'form' => ['sku', 'name', 'category', 'unit', 'description', 'is_active']
    ],
    'product_specs' => [
        'title' => 'مواصفات المنتجات',
        'singular' => 'مواصفات المنتجات',
        'route' => 'admin.product-specs',
        'icon' => 'ti ti-table',
        'fields' => [
            'product_id' => [
                'label' => 'المنتج',
                'type' => 'relation',
                'model' => '\\App\\Models\\Product',
                'option_label' => 'name'
            ],
            'spec_name' => [
                'label' => 'اسم المواصفة',
                'type' => 'text'
            ],
            'spec_value' => [
                'label' => 'قيمة المواصفة',
                'type' => 'text'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'is_required' => [
                'label' => 'إجباري',
                'type' => 'boolean'
            ]
        ],
        'table' => ['product_id', 'spec_name', 'spec_value', 'unit', 'is_required'],
        'form' => ['product_id', 'spec_name', 'spec_value', 'unit', 'is_required']
    ],
    'production_logs' => [
        'title' => 'سجلات الإنتاج',
        'singular' => 'سجلات الإنتاج',
        'route' => 'admin.production-logs',
        'icon' => 'ti ti-table',
        'fields' => [
            'job_ticket_id' => [
                'label' => 'تذكرة التشغيل',
                'type' => 'relation',
                'model' => '\\App\\Models\\JobTicket',
                'option_label' => 'ticket_no'
            ],
            'production_plan_id' => [
                'label' => 'خطة الإنتاج',
                'type' => 'relation',
                'model' => '\\App\\Models\\ProductionPlan',
                'option_label' => 'id'
            ],
            'logged_by' => [
                'label' => 'سجل بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'log_type' => [
                'label' => 'نوع السجل',
                'type' => 'select',
                'options' => [
                    'progress' => 'تقدم',
                    'delay' => 'تأخير',
                    'issue' => 'مشكلة',
                    'material' => 'مواد',
                    'labor' => 'عمالة',
                    'machine' => 'ماكينة',
                    'note' => 'ملاحظة'
                ]
            ],
            'progress_percent' => [
                'label' => 'نسبة الإنجاز',
                'type' => 'number'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'logged_at' => [
                'label' => 'وقت التسجيل',
                'type' => 'datetime'
            ]
        ],
        'table' => ['job_ticket_id', 'production_plan_id', 'logged_by', 'log_type', 'progress_percent', 'logged_at'],
        'form' => ['job_ticket_id', 'production_plan_id', 'logged_by', 'log_type', 'progress_percent', 'description', 'logged_at']
    ],
    'production_plans' => [
        'title' => 'خطط الإنتاج',
        'singular' => 'خطط الإنتاج',
        'route' => 'admin.production-plans',
        'icon' => 'ti ti-table',
        'fields' => [
            'job_ticket_id' => [
                'label' => 'تذكرة التشغيل',
                'type' => 'relation',
                'model' => '\\App\\Models\\JobTicket',
                'option_label' => 'ticket_no'
            ],
            'planned_by' => [
                'label' => 'خطط بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'feasibility_status' => [
                'label' => 'حالة الجدوى',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'feasible' => 'ممكن',
                    'not_feasible' => 'غير ممكن',
                    'feasible_with_notes' => 'ممكن بملاحظات'
                ]
            ],
            'feasibility_notes' => [
                'label' => 'ملاحظات الجدوى',
                'type' => 'textarea'
            ],
            'plan_status' => [
                'label' => 'حالة الخطة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'approved' => 'معتمد',
                    'released' => 'تم الإصدار',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغي'
                ]
            ],
            'planned_start_date' => [
                'label' => 'تاريخ بداية مخطط',
                'type' => 'date'
            ],
            'planned_end_date' => [
                'label' => 'تاريخ نهاية مخطط',
                'type' => 'date'
            ],
            'actual_start_at' => [
                'label' => 'بداية فعلية',
                'type' => 'datetime'
            ],
            'actual_end_at' => [
                'label' => 'نهاية فعلية',
                'type' => 'datetime'
            ],
            'plan_notes' => [
                'label' => 'ملاحظات الخطة',
                'type' => 'textarea'
            ]
        ],
        'table' => ['job_ticket_id', 'planned_by', 'feasibility_status', 'feasibility_notes', 'plan_status', 'planned_start_date', 'planned_end_date', 'plan_notes'],
        'form' => ['job_ticket_id', 'planned_by', 'feasibility_status', 'feasibility_notes', 'plan_status', 'planned_start_date', 'planned_end_date', 'actual_start_at', 'actual_end_at', 'plan_notes']
    ],
    'quality_checks' => [
        'title' => 'فحص الجودة',
        'singular' => 'فحص الجودة',
        'route' => 'admin.quality-checks',
        'icon' => 'ti ti-table',
        'fields' => [
            'job_ticket_id' => [
                'label' => 'تذكرة التشغيل',
                'type' => 'relation',
                'model' => '\\App\\Models\\JobTicket',
                'option_label' => 'ticket_no'
            ],
            'checked_by' => [
                'label' => 'تم الفحص بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'result' => [
                'label' => 'النتيجة',
                'type' => 'select',
                'options' => [
                    'pending' => 'قيد الانتظار',
                    'passed' => 'ناجح',
                    'failed' => 'فشل',
                    'passed_with_notes' => 'ناجح بملاحظات'
                ]
            ],
            'checklist' => [
                'label' => 'قائمة الفحص',
                'type' => 'textarea'
            ],
            'defects_found' => [
                'label' => 'العيوب',
                'type' => 'textarea'
            ],
            'corrective_action' => [
                'label' => 'الإجراء التصحيحي',
                'type' => 'textarea'
            ],
            'checked_at' => [
                'label' => 'وقت الفحص',
                'type' => 'datetime'
            ]
        ],
        'table' => ['job_ticket_id', 'checked_by', 'result', 'defects_found', 'corrective_action', 'checked_at'],
        'form' => ['job_ticket_id', 'checked_by', 'result', 'checklist', 'defects_found', 'corrective_action', 'checked_at']
    ],
    'quotations' => [
        'title' => 'عروض الأسعار',
        'singular' => 'عروض الأسعار',
        'route' => 'admin.quotations',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'quotation_no' => [
                'label' => 'رقم عرض السعر',
                'type' => 'text'
            ],
            'current_version_no' => [
                'label' => 'الإصدار الحالي',
                'type' => 'text'
            ],
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'sales_rep_id' => [
                'label' => 'مسؤول المبيعات',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'currency_id' => [
                'label' => 'العملة',
                'type' => 'relation',
                'model' => '\\App\\Models\\Currency',
                'option_label' => 'code'
            ],
            'payment_terms_id' => [
                'label' => 'شروط الدفع',
                'type' => 'relation',
                'model' => '\\App\\Models\\PaymentTerm',
                'option_label' => 'name'
            ],
            'quotation_date' => [
                'label' => 'تاريخ العرض',
                'type' => 'date'
            ],
            'valid_until' => [
                'label' => 'صالح حتى',
                'type' => 'date'
            ],
            'subtotal' => [
                'label' => 'الإجمالي الفرعي',
                'type' => 'number'
            ],
            'discount_amount' => [
                'label' => 'قيمة الخصم',
                'type' => 'number'
            ],
            'tax_amount' => [
                'label' => 'قيمة الضريبة',
                'type' => 'number'
            ],
            'total_amount' => [
                'label' => 'الإجمالي',
                'type' => 'number'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'pending_design' => 'بانتظار التصميم',
                    'pending_accounts' => 'بانتظار الحسابات',
                    'pending_management' => 'بانتظار الإدارة',
                    'approved' => 'معتمد',
                    'sent' => 'مرسل',
                    'revision_requested' => 'تعديل مطلوب',
                    'accepted' => 'مقبول',
                    'rejected' => 'مرفوض',
                    'expired' => 'منتهي',
                    'cancelled' => 'ملغي',
                    'closed' => 'مغلق'
                ]
            ],
            'pdf_path' => [
                'label' => 'مسار PDF',
                'type' => 'text'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['quote_request_id', 'quotation_no', 'current_version_no', 'customer_id', 'sales_rep_id', 'currency_id', 'quotation_date', 'status'],
        'form' => ['quote_request_id', 'quotation_no', 'current_version_no', 'customer_id', 'sales_rep_id', 'currency_id', 'payment_terms_id', 'quotation_date', 'valid_until', 'subtotal', 'discount_amount', 'tax_amount', 'total_amount', 'status', 'pdf_path', 'notes', 'created_by']
    ],
    'quotation_files' => [
        'title' => 'ملفات عروض الأسعار',
        'singular' => 'ملفات عروض الأسعار',
        'route' => 'admin.quotation-files',
        'icon' => 'ti ti-table',
        'fields' => [
            'quotation_id' => [
                'label' => 'عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\Quotation',
                'option_label' => 'quotation_no'
            ],
            'quotation_version_id' => [
                'label' => 'إصدار عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuotationVersion',
                'option_label' => 'version_no'
            ],
            'file_type_id' => [
                'label' => 'نوع الملف',
                'type' => 'relation',
                'model' => '\\App\\Models\\FileType',
                'option_label' => 'name'
            ],
            'uploaded_by' => [
                'label' => 'رفع بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'original_name' => [
                'label' => 'اسم الملف الأصلي',
                'type' => 'text'
            ],
            'stored_name' => [
                'label' => 'اسم الملف المخزن',
                'type' => 'text'
            ],
            'file_path' => [
                'label' => 'مسار الملف',
                'type' => 'text'
            ],
            'mime_type' => [
                'label' => 'نوع الملف',
                'type' => 'text'
            ],
            'size_bytes' => [
                'label' => 'الحجم بالبايت',
                'type' => 'text'
            ],
            'uploaded_at' => [
                'label' => 'وقت الرفع',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quotation_id', 'quotation_version_id', 'file_type_id', 'uploaded_by', 'original_name', 'stored_name'],
        'form' => ['quotation_id', 'quotation_version_id', 'file_type_id', 'uploaded_by', 'original_name', 'stored_name', 'file_path', 'mime_type', 'size_bytes', 'uploaded_at']
    ],
    'quotation_items' => [
        'title' => 'بنود عروض الأسعار',
        'singular' => 'بنود عروض الأسعار',
        'route' => 'admin.quotation-items',
        'icon' => 'ti ti-table',
        'fields' => [
            'quotation_version_id' => [
                'label' => 'إصدار عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuotationVersion',
                'option_label' => 'version_no'
            ],
            'quote_request_item_id' => [
                'label' => 'بند طلب العرض',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequestItem',
                'option_label' => 'product_name'
            ],
            'line_no' => [
                'label' => 'رقم البند',
                'type' => 'text'
            ],
            'product_id' => [
                'label' => 'المنتج',
                'type' => 'relation',
                'model' => '\\App\\Models\\Product',
                'option_label' => 'name'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'quantity' => [
                'label' => 'الكمية',
                'type' => 'number'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'unit_price' => [
                'label' => 'Unit Price',
                'type' => 'number'
            ],
            'discount_percent' => [
                'label' => 'نسبة الخصم',
                'type' => 'number'
            ],
            'tax_percent' => [
                'label' => 'نسبة الضريبة',
                'type' => 'number'
            ],
            'line_total' => [
                'label' => 'Line Total',
                'type' => 'text'
            ],
            'specs' => [
                'label' => 'المواصفات',
                'type' => 'textarea'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['quotation_version_id', 'quote_request_item_id', 'line_no', 'product_id', 'quantity', 'unit'],
        'form' => ['quotation_version_id', 'quote_request_item_id', 'line_no', 'product_id', 'description', 'quantity', 'unit', 'unit_price', 'discount_percent', 'tax_percent', 'line_total', 'specs', 'notes']
    ],
    'quotation_versions' => [
        'title' => 'إصدارات عروض الأسعار',
        'singular' => 'إصدارات عروض الأسعار',
        'route' => 'admin.quotation-versions',
        'icon' => 'ti ti-table',
        'fields' => [
            'quotation_id' => [
                'label' => 'عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\Quotation',
                'option_label' => 'quotation_no'
            ],
            'version_no' => [
                'label' => 'رقم الإصدار',
                'type' => 'text'
            ],
            'cost_estimation_id' => [
                'label' => 'تقدير التكلفة',
                'type' => 'relation',
                'model' => '\\App\\Models\\CostEstimation',
                'option_label' => 'estimation_no'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'version_reason' => [
                'label' => 'سبب الإصدار',
                'type' => 'select',
                'options' => [
                    'initial' => 'أولي',
                    'revision_requested' => 'تعديل مطلوب',
                    'internal_revision' => 'تعديل داخلي',
                    'price_change' => 'تغيير سعر',
                    'scope_change' => 'تغيير نطاق',
                    'correction' => 'تصحيح'
                ]
            ],
            'subtotal' => [
                'label' => 'الإجمالي الفرعي',
                'type' => 'number'
            ],
            'discount_amount' => [
                'label' => 'قيمة الخصم',
                'type' => 'number'
            ],
            'tax_amount' => [
                'label' => 'قيمة الضريبة',
                'type' => 'number'
            ],
            'total_amount' => [
                'label' => 'الإجمالي',
                'type' => 'number'
            ],
            'pdf_path' => [
                'label' => 'مسار PDF',
                'type' => 'text'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ]
        ],
        'table' => ['quotation_id', 'version_no', 'cost_estimation_id', 'created_by', 'version_reason', 'subtotal'],
        'form' => ['quotation_id', 'version_no', 'cost_estimation_id', 'created_by', 'version_reason', 'subtotal', 'discount_amount', 'tax_amount', 'total_amount', 'pdf_path', 'notes']
    ],
    'quote_requests' => [
        'title' => 'طلبات عروض الأسعار',
        'singular' => 'طلبات عروض الأسعار',
        'route' => 'admin.quote-requests',
        'icon' => 'ti ti-table',
        'fields' => [
            'request_no' => [
                'label' => 'رقم الطلب',
                'type' => 'text',
                'readonly' => true,
                'placeholder' => 'تلقائي...'
            ],
            'request_source' => [
                'label' => 'مصدر الطلب',
                'type' => 'select',
                'options' => [
                    'sales_rep' => 'مسؤول مبيعات',
                    'sales_coordinator' => 'منسق مبيعات',
                    'customer_portal' => 'بوابة العميل',
                    'phone' => 'هاتف',
                    'email' => 'إيميل',
                    'walk_in' => 'زيارة',
                    'other' => 'أخرى'
                ]
            ],
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'contact_id' => [
                'label' => 'جهة الاتصال',
                'type' => 'relation',
                'model' => '\\App\\Models\\CustomerContact',
                'option_label' => 'contact_name'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'sales_rep_id' => [
                'label' => 'مسؤول المبيعات',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'sales_coordinator_id' => [
                'label' => 'منسق المبيعات',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'assigned_estimation_user_id' => [
                'label' => 'مسؤول التقدير',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'title' => [
                'label' => 'العنوان',
                'type' => 'text'
            ],
            'project_name' => [
                'label' => 'اسم المشروع',
                'type' => 'text'
            ],
            'priority' => [
                'label' => 'الأولوية',
                'type' => 'select',
                'options' => [
                    'low' => 'منخفض',
                    'normal' => 'عادي',
                    'high' => 'مرتفع',
                    'urgent' => 'عاجل'
                ]
            ],
            'requested_delivery_date' => [
                'label' => 'تاريخ التسليم المطلوب',
                'type' => 'date'
            ],
            'currency_id' => [
                'label' => 'العملة',
                'type' => 'relation',
                'model' => '\\App\\Models\\Currency',
                'option_label' => 'code'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'draft' => 'مسودة',
                    'submitted' => 'تم الإرسال',
                    'in_review' => 'قيد المراجعة',
                    'clarification_requested' => 'توضيح مطلوب',
                    'estimation_in_progress' => 'التقدير جارٍ',
                    'design_review' => 'مراجعة التصميم',
                    'accounts_review' => 'مراجعة الحسابات',
                    'management_review' => 'مراجعة الإدارة',
                    'quotation_generated' => 'تم إنشاء العرض',
                    'sent_to_customer' => 'مرسل للعميل',
                    'revision_requested' => 'تعديل مطلوب',
                    'accepted' => 'مقبول',
                    'rejected' => 'مرفوض',
                    'cancelled' => 'ملغي',
                    'closed' => 'مغلق'
                ]
            ],
            'completeness_status' => [
                'label' => 'حالة اكتمال البيانات',
                'type' => 'select',
                'options' => [
                    'unchecked' => 'لم يتم الفحص',
                    'complete' => 'مكتمل',
                    'incomplete' => 'غير مكتمل'
                ]
            ],
            'customer_requirements' => [
                'label' => 'متطلبات العميل',
                'type' => 'textarea'
            ],
            'internal_notes' => [
                'label' => 'ملاحظات داخلية',
                'type' => 'textarea'
            ]
        ],
        'table' => ['request_no', 'request_source', 'customer_id', 'contact_id', 'created_by', 'sales_rep_id', 'title', 'project_name'],
        'form' => ['request_no', 'request_source', 'customer_id', 'contact_id', 'created_by', 'sales_rep_id', 'sales_coordinator_id', 'assigned_estimation_user_id', 'title', 'project_name', 'priority', 'requested_delivery_date', 'currency_id', 'status', 'completeness_status', 'customer_requirements', 'internal_notes']
    ],
    'quote_request_items' => [
        'title' => 'بنود طلب العرض',
        'singular' => 'بنود طلب العرض',
        'route' => 'admin.quote-request-items',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'product_id' => [
                'label' => 'المنتج',
                'type' => 'relation',
                'model' => '\\App\\Models\\Product',
                'option_label' => 'name'
            ],
            'line_no' => [
                'label' => 'رقم البند',
                'type' => 'text'
            ],
            'product_name' => [
                'label' => 'اسم المنتج',
                'type' => 'text'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'quantity' => [
                'label' => 'الكمية',
                'type' => 'number'
            ],
            'unit' => [
                'label' => 'الوحدة',
                'type' => 'text'
            ],
            'product_specs' => [
                'label' => 'مواصفات المنتج',
                'type' => 'textarea'
            ],
            'customer_notes' => [
                'label' => 'ملاحظات العميل',
                'type' => 'textarea'
            ]
        ],
        'table' => ['quote_request_id', 'product_id', 'line_no', 'product_name', 'quantity', 'unit', 'customer_notes'],
        'form' => ['quote_request_id', 'product_id', 'line_no', 'product_name', 'description', 'quantity', 'unit', 'product_specs', 'customer_notes']
    ],
    'reminders' => [
        'title' => 'التذكيرات',
        'singular' => 'التذكيرات',
        'route' => 'admin.reminders',
        'icon' => 'ti ti-table',
        'fields' => [
            'related_entity_type' => [
                'label' => 'نوع الكيان المرتبط',
                'type' => 'select',
                'options' => [
                    'quote_request' => 'طلب عرض',
                    'quotation' => 'عرض سعر',
                    'sales_order' => 'أمر بيع',
                    'job_ticket' => 'تذكرة تشغيل',
                    'invoice' => 'فاتورة'
                ]
            ],
            'related_entity_id' => [
                'label' => 'رقم الكيان المرتبط',
                'type' => 'text'
            ],
            'reminder_type' => [
                'label' => 'نوع التذكير',
                'type' => 'select',
                'options' => [
                    'customer_follow_up' => 'متابعة عميل',
                    'internal_task' => 'مهمة داخلية',
                    'quotation_expiry' => 'انتهاء عرض سعر',
                    'approval_pending' => 'اعتماد معلق',
                    'production_delay' => 'تأخير إنتاج',
                    'payment_due' => 'استحقاق دفع'
                ]
            ],
            'message' => [
                'label' => 'الرسالة',
                'type' => 'textarea'
            ],
            'remind_at' => [
                'label' => 'وقت التذكير',
                'type' => 'datetime'
            ],
            'sent_at' => [
                'label' => 'وقت الإرسال',
                'type' => 'datetime'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'scheduled' => 'مجدول',
                    'sent' => 'مرسل',
                    'cancelled' => 'ملغي',
                    'failed' => 'فشل'
                ]
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'assigned_to' => [
                'label' => 'مسند إلى',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['related_entity_type', 'related_entity_id', 'reminder_type', 'remind_at', 'sent_at', 'status'],
        'form' => ['related_entity_type', 'related_entity_id', 'reminder_type', 'message', 'remind_at', 'sent_at', 'status', 'created_by', 'assigned_to']
    ],
    'request_files' => [
        'title' => 'ملفات الطلب',
        'singular' => 'ملفات الطلب',
        'route' => 'admin.request-files',
        'icon' => 'ti ti-table',
        'fields' => [
            'quote_request_id' => [
                'label' => 'طلب عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuoteRequest',
                'option_label' => 'request_no'
            ],
            'file_type_id' => [
                'label' => 'نوع الملف',
                'type' => 'relation',
                'model' => '\\App\\Models\\FileType',
                'option_label' => 'name'
            ],
            'uploaded_by' => [
                'label' => 'رفع بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'original_name' => [
                'label' => 'اسم الملف الأصلي',
                'type' => 'text'
            ],
            'stored_name' => [
                'label' => 'اسم الملف المخزن',
                'type' => 'text'
            ],
            'file_path' => [
                'label' => 'مسار الملف',
                'type' => 'text'
            ],
            'mime_type' => [
                'label' => 'نوع الملف',
                'type' => 'text'
            ],
            'size_bytes' => [
                'label' => 'الحجم بالبايت',
                'type' => 'text'
            ],
            'notes' => [
                'label' => 'ملاحظات',
                'type' => 'textarea'
            ],
            'uploaded_at' => [
                'label' => 'وقت الرفع',
                'type' => 'datetime'
            ]
        ],
        'table' => ['quote_request_id', 'file_type_id', 'uploaded_by', 'original_name', 'stored_name', 'file_path'],
        'form' => ['quote_request_id', 'file_type_id', 'uploaded_by', 'original_name', 'stored_name', 'file_path', 'mime_type', 'size_bytes', 'notes', 'uploaded_at']
    ],
    'roles' => [
        'title' => 'الأدوار',
        'singular' => 'الأدوار',
        'route' => 'admin.roles',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'department_id' => [
                'label' => 'القسم',
                'type' => 'relation',
                'model' => '\\App\\Models\\Department',
                'option_label' => 'name'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ],
            'is_system_role' => [
                'label' => 'دور نظام',
                'type' => 'boolean'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['code', 'name', 'department_id', 'is_system_role', 'is_active'],
        'form' => ['code', 'name', 'department_id', 'description', 'is_system_role', 'is_active']
    ],
    'sales_orders' => [
        'title' => 'أوامر البيع',
        'singular' => 'أوامر البيع',
        'route' => 'admin.sales-orders',
        'icon' => 'ti ti-table',
        'fields' => [
            'quotation_id' => [
                'label' => 'عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\Quotation',
                'option_label' => 'quotation_no'
            ],
            'quotation_version_id' => [
                'label' => 'إصدار عرض السعر',
                'type' => 'relation',
                'model' => '\\App\\Models\\QuotationVersion',
                'option_label' => 'version_no'
            ],
            'order_no' => [
                'label' => 'رقم الأمر',
                'type' => 'text'
            ],
            'customer_id' => [
                'label' => 'العميل',
                'type' => 'relation',
                'model' => '\\App\\Models\\Customer',
                'option_label' => 'company_name'
            ],
            'sales_rep_id' => [
                'label' => 'مسؤول المبيعات',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'created' => 'تم الإنشاء',
                    'on_hold' => 'معلق',
                    'released_to_production' => 'مرسل للإنتاج',
                    'in_production' => 'قيد الإنتاج',
                    'quality_check' => 'فحص جودة',
                    'ready_for_dispatch' => 'جاهز للشحن',
                    'dispatched' => 'تم الشحن',
                    'delivered' => 'تم التسليم',
                    'invoiced' => 'تمت الفوترة',
                    'closed' => 'مغلق',
                    'cancelled' => 'ملغي',
                    'reopened' => 'تمت إعادة الفتح'
                ]
            ],
            'order_date' => [
                'label' => 'تاريخ الأمر',
                'type' => 'date'
            ],
            'planned_delivery_date' => [
                'label' => 'تاريخ التسليم المخطط',
                'type' => 'date'
            ],
            'total_amount' => [
                'label' => 'الإجمالي',
                'type' => 'number'
            ],
            'created_by' => [
                'label' => 'أنشئ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ]
        ],
        'table' => ['quotation_id', 'quotation_version_id', 'order_no', 'customer_id', 'sales_rep_id', 'status', 'order_date', 'planned_delivery_date'],
        'form' => ['quotation_id', 'quotation_version_id', 'order_no', 'customer_id', 'sales_rep_id', 'status', 'order_date', 'planned_delivery_date', 'total_amount', 'created_by']
    ],
    'users' => [
        'title' => 'المستخدمين',
        'singular' => 'المستخدم',
        'route' => 'admin.users',
        'icon' => 'ti ti-table',
        'fields' => [
            'employee_code' => [
                'label' => 'كود الموظف',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'email' => [
                'label' => 'البريد الإلكتروني',
                'type' => 'text'
            ],
            'phone' => [
                'label' => 'الهاتف',
                'type' => 'text'
            ],
            'password' => [
                'label' => 'كلمة المرور',
                'type' => 'password'
            ],
            'department_id' => [
                'label' => 'القسم',
                'type' => 'relation',
                'model' => '\\App\\Models\\Department',
                'option_label' => 'name'
            ],
            'manager_user_id' => [
                'label' => 'المدير المباشر',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'is_active' => [
                'label' => 'نشط',
                'type' => 'boolean'
            ]
        ],
        'table' => ['employee_code', 'name', 'email', 'phone', 'department_id', 'manager_user_id'],
        'form' => ['employee_code', 'name', 'email', 'phone', 'password', 'department_id', 'manager_user_id', 'is_active']
    ],
    'workflow_history' => [
        'title' => 'سجل سير العمل',
        'singular' => 'سجل سير العمل',
        'route' => 'admin.workflow-history',
        'icon' => 'ti ti-table',
        'fields' => [
            'workflow_instance_id' => [
                'label' => 'حالة سير العمل',
                'type' => 'relation',
                'model' => '\\App\\Models\\WorkflowInstance',
                'option_label' => 'id'
            ],
            'from_step_code' => [
                'label' => 'من خطوة',
                'type' => 'text'
            ],
            'to_step_code' => [
                'label' => 'إلى خطوة',
                'type' => 'text'
            ],
            'transition_id' => [
                'label' => 'الانتقال',
                'type' => 'relation',
                'model' => '\\App\\Models\\WorkflowTransition',
                'option_label' => 'id'
            ],
            'action_code' => [
                'label' => 'كود الإجراء',
                'type' => 'text'
            ],
            'action_label' => [
                'label' => 'وصف الإجراء',
                'type' => 'text'
            ],
            'comments' => [
                'label' => 'تعليقات',
                'type' => 'textarea'
            ],
            'acted_by' => [
                'label' => 'تم بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'acted_at' => [
                'label' => 'وقت الإجراء',
                'type' => 'datetime'
            ]
        ],
        'table' => ['workflow_instance_id', 'from_step_code', 'to_step_code', 'transition_id', 'action_code', 'action_label'],
        'form' => ['workflow_instance_id', 'from_step_code', 'to_step_code', 'transition_id', 'action_code', 'action_label', 'comments', 'acted_by', 'acted_at']
    ],
    'workflow_instances' => [
        'title' => 'حالات سير العمل',
        'singular' => 'حالات سير العمل',
        'route' => 'admin.workflow-instances',
        'icon' => 'ti ti-table',
        'fields' => [
            'entity_type' => [
                'label' => 'نوع الكيان',
                'type' => 'select',
                'options' => [
                    'quote_request' => 'طلب عرض',
                    'quotation' => 'عرض سعر',
                    'sales_order' => 'أمر بيع',
                    'job_ticket' => 'تذكرة تشغيل',
                    'invoice' => 'فاتورة'
                ]
            ],
            'entity_id' => [
                'label' => 'رقم الكيان',
                'type' => 'text'
            ],
            'current_step_code' => [
                'label' => 'الخطوة الحالية',
                'type' => 'text'
            ],
            'status' => [
                'label' => 'الحالة',
                'type' => 'select',
                'options' => [
                    'active' => 'نشط',
                    'on_hold' => 'معلق',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغي',
                    'rejected' => 'مرفوض'
                ]
            ],
            'started_by' => [
                'label' => 'بدأ بواسطة',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'started_at' => [
                'label' => 'وقت البدء',
                'type' => 'datetime'
            ],
            'completed_at' => [
                'label' => 'وقت الانتهاء',
                'type' => 'datetime'
            ],
            'cancelled_at' => [
                'label' => 'وقت الإلغاء',
                'type' => 'datetime'
            ]
        ],
        'table' => ['entity_type', 'entity_id', 'current_step_code', 'status', 'started_by', 'started_at'],
        'form' => ['entity_type', 'entity_id', 'current_step_code', 'status', 'started_by', 'started_at', 'completed_at', 'cancelled_at']
    ],
    'workflow_steps' => [
        'title' => 'خطوات سير العمل',
        'singular' => 'خطوات سير العمل',
        'route' => 'admin.workflow-steps',
        'icon' => 'ti ti-table',
        'fields' => [
            'code' => [
                'label' => 'الكود',
                'type' => 'text'
            ],
            'name' => [
                'label' => 'الاسم',
                'type' => 'text'
            ],
            'lane' => [
                'label' => 'المسار',
                'type' => 'text'
            ],
            'role_code' => [
                'label' => 'كود الدور',
                'type' => 'text'
            ],
            'step_type' => [
                'label' => 'نوع الخطوة',
                'type' => 'select',
                'options' => [
                    'start' => 'بداية',
                    'task' => 'مهمة',
                    'gateway' => 'بوابة',
                    'system' => 'نظام',
                    'end' => 'نهاية'
                ]
            ],
            'sort_order' => [
                'label' => 'الترتيب',
                'type' => 'text'
            ],
            'is_terminal' => [
                'label' => 'نهاية سير العمل',
                'type' => 'boolean'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ]
        ],
        'table' => ['code', 'name', 'lane', 'role_code', 'step_type', 'sort_order'],
        'form' => ['code', 'name', 'lane', 'role_code', 'step_type', 'sort_order', 'is_terminal', 'description']
    ],
    'workflow_tasks' => [
        'title' => 'مهام سير العمل',
        'singular' => 'مهام سير العمل',
        'route' => 'admin.workflow-tasks',
        'icon' => 'ti ti-table',
        'fields' => [
            'workflow_instance_id' => [
                'label' => 'حالة سير العمل',
                'type' => 'relation',
                'model' => '\\App\\Models\\WorkflowInstance',
                'option_label' => 'id'
            ],
            'step_code' => [
                'label' => 'كود الخطوة',
                'type' => 'text'
            ],
            'assigned_role_code' => [
                'label' => 'الدور المسؤول',
                'type' => 'text'
            ],
            'assigned_user_id' => [
                'label' => 'المستخدم المسؤول',
                'type' => 'relation',
                'model' => '\\App\\Models\\User',
                'option_label' => 'name'
            ],
            'task_status' => [
                'label' => 'حالة المهمة',
                'type' => 'select',
                'options' => [
                    'open' => 'مفتوح',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'skipped' => 'متخطى',
                    'cancelled' => 'ملغي',
                    'rejected' => 'مرفوض'
                ]
            ],
            'due_at' => [
                'label' => 'تاريخ الاستحقاق',
                'type' => 'datetime'
            ],
            'started_at' => [
                'label' => 'وقت البدء',
                'type' => 'datetime'
            ],
            'completed_at' => [
                'label' => 'وقت الانتهاء',
                'type' => 'datetime'
            ],
            'result_code' => [
                'label' => 'كود النتيجة',
                'type' => 'text'
            ],
            'result_notes' => [
                'label' => 'ملاحظات النتيجة',
                'type' => 'textarea'
            ]
        ],
        'table' => ['workflow_instance_id', 'step_code', 'assigned_role_code', 'assigned_user_id', 'task_status', 'due_at', 'result_code', 'result_notes'],
        'form' => ['workflow_instance_id', 'step_code', 'assigned_role_code', 'assigned_user_id', 'task_status', 'due_at', 'started_at', 'completed_at', 'result_code', 'result_notes']
    ],
    'workflow_transitions' => [
        'title' => 'انتقالات سير العمل',
        'singular' => 'انتقالات سير العمل',
        'route' => 'admin.workflow-transitions',
        'icon' => 'ti ti-table',
        'fields' => [
            'from_step_code' => [
                'label' => 'من خطوة',
                'type' => 'text'
            ],
            'to_step_code' => [
                'label' => 'إلى خطوة',
                'type' => 'text'
            ],
            'condition_code' => [
                'label' => 'كود الشرط',
                'type' => 'text'
            ],
            'condition_label' => [
                'label' => 'وصف الشرط',
                'type' => 'text'
            ],
            'is_default' => [
                'label' => 'افتراضي',
                'type' => 'boolean'
            ],
            'description' => [
                'label' => 'الوصف',
                'type' => 'textarea'
            ]
        ],
        'table' => ['from_step_code', 'to_step_code', 'condition_code', 'condition_label', 'is_default'],
        'form' => ['from_step_code', 'to_step_code', 'condition_code', 'condition_label', 'is_default', 'description']
    ]
];
@endphp
