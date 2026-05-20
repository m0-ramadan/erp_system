<?php

namespace App\Support;

use Carbon\CarbonInterface;

class AdminViewHelpers
{
    public static function shared(): array
    {
        $enumLabels = [
            'new' => 'جديد', 'existing' => 'حالي', 'prospect' => 'محتمل', 'active' => 'نشط', 'inactive' => 'غير نشط', 'blacklisted' => 'محظور',
            'pending' => 'قيد الانتظار', 'approved' => 'معتمد', 'returned_for_correction' => 'مرتجع للتصحيح', 'rejected' => 'مرفوض', 'approved_with_notes' => 'معتمد بملاحظات', 'returned_to_accounts' => 'مرتجع للحسابات', 'returned_to_estimation' => 'مرتجع للتقدير',
            'open' => 'مفتوح', 'answered' => 'تم الرد', 'closed' => 'مغلق', 'cancelled' => 'ملغي', 'draft' => 'مسودة', 'submitted' => 'تم الإرسال', 'revised' => 'تم التعديل', 'material' => 'مواد', 'labor' => 'عمالة', 'overhead' => 'تشغيلي', 'subcontract' => 'مقاول باطن', 'other' => 'أخرى',
            'feasible' => 'ممكن', 'not_feasible' => 'غير ممكن', 'feasible_with_notes' => 'ممكن بملاحظات', 'unchecked' => 'لم يتم الفحص', 'complete' => 'مكتمل', 'incomplete' => 'غير مكتمل', 'sales_rep' => 'مسؤول مبيعات', 'sales_coordinator' => 'منسق مبيعات', 'customer_portal' => 'بوابة العميل', 'phone' => 'هاتف', 'email' => 'إيميل', 'walk_in' => 'زيارة', 'low' => 'منخفض', 'normal' => 'عادي', 'high' => 'مرتفع', 'urgent' => 'عاجل',
            'in_review' => 'قيد المراجعة', 'clarification_requested' => 'توضيح مطلوب', 'estimation_in_progress' => 'التقدير جارٍ', 'design_review' => 'مراجعة التصميم', 'accounts_review' => 'مراجعة الحسابات', 'management_review' => 'مراجعة الإدارة', 'quotation_generated' => 'تم إنشاء العرض', 'sent_to_customer' => 'مرسل للعميل', 'revision_requested' => 'تعديل مطلوب', 'accepted' => 'مقبول', 'initial' => 'أولي', 'internal_revision' => 'تعديل داخلي', 'price_change' => 'تغيير سعر', 'scope_change' => 'تغيير نطاق', 'correction' => 'تصحيح', 'no_response' => 'لا يوجد رد',
            'created' => 'تم الإنشاء', 'on_hold' => 'معلق', 'released_to_production' => 'مرسل للإنتاج', 'in_production' => 'قيد الإنتاج', 'quality_check' => 'فحص جودة', 'ready_for_dispatch' => 'جاهز للشحن', 'dispatched' => 'تم الشحن', 'delivered' => 'تم التسليم', 'invoiced' => 'تمت الفوترة', 'reopened' => 'تمت إعادة الفتح', 'production_feasibility_review' => 'مراجعة جدوى الإنتاج', 'production_planning' => 'تخطيط الإنتاج', 'passed' => 'ناجح', 'failed' => 'فشل', 'pending_design' => 'بانتظار التصميم', 'pending_accounts' => 'بانتظار الحسابات', 'pending_management' => 'بانتظار الإدارة', 'sent' => 'مرسل', 'expired' => 'منتهي', 'released' => 'تم الإصدار', 'in_progress' => 'قيد التنفيذ', 'completed' => 'مكتمل', 'progress' => 'تقدم', 'delay' => 'تأخير', 'issue' => 'مشكلة', 'machine' => 'ماكينة', 'note' => 'ملاحظة', 'passed_with_notes' => 'ناجح بملاحظات', 'returned' => 'مرتجع', 'confirmed' => 'تم التأكيد', 'issued' => 'مصدرة', 'partially_paid' => 'مدفوعة جزئيًا', 'paid' => 'مدفوعة', 'overdue' => 'متأخرة', 'scheduled' => 'مجدول', 'system' => 'نظام', 'sms' => 'SMS', 'whatsapp' => 'واتساب', 'in_app' => 'داخل النظام', 'queued' => 'في الانتظار', 'read' => 'مقروء', 'customer_follow_up' => 'متابعة عميل', 'internal_task' => 'مهمة داخلية', 'quotation_expiry' => 'انتهاء عرض سعر', 'approval_pending' => 'اعتماد معلق', 'production_delay' => 'تأخير إنتاج', 'payment_due' => 'استحقاق دفع', 'quote_request' => 'طلب عرض', 'quotation' => 'عرض سعر', 'sales_order' => 'أمر بيع', 'job_ticket' => 'تذكرة تشغيل', 'invoice' => 'فاتورة', 'workflow_task' => 'مهمة سير عمل', 'start' => 'بداية', 'task' => 'مهمة', 'gateway' => 'بوابة', 'end' => 'نهاية', 'skipped' => 'متخطى',
        ];

        $qwHuman = static function ($value) use ($enumLabels) {
            if ($value === null || $value === '') {
                return '—';
            }

            if (is_bool($value)) {
                return $value ? 'نعم' : 'لا';
            }

            if (is_array($value) || is_object($value)) {
                return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }

            $string = (string) $value;

            return $enumLabels[$string] ?? str_replace('_', ' ', $string);
        };

        $qwBadgeClass = static function ($value) {
            $value = (string) $value;

            if (in_array($value, ['approved', 'accepted', 'active', 'paid', 'passed', 'confirmed', 'complete', 'completed', 'sent', 'issued', 'delivered', 'dispatched', 'feasible'], true)) {
                return 'success';
            }

            if (in_array($value, ['rejected', 'cancelled', 'failed', 'inactive', 'blacklisted', 'not_feasible', 'overdue'], true)) {
                return 'danger';
            }

            if (in_array($value, ['pending', 'draft', 'open', 'on_hold', 'revision_requested', 'returned_for_correction', 'in_progress', 'scheduled', 'queued', 'high', 'urgent'], true)) {
                return 'warning';
            }

            return '';
        };

        $qwValue = static function ($item, $field, $config = []) use ($qwHuman) {
            $value = data_get($item, $field);

            if (($config['type'] ?? null) === 'boolean') {
                return $value ? 'نعم' : 'لا';
            }

            if ($value instanceof CarbonInterface) {
                return $value->format(str_contains($field, '_date') ? 'Y-m-d' : 'Y-m-d H:i');
            }

            return $qwHuman($value);
        };

        return compact('qwHuman', 'qwBadgeClass', 'qwValue');
    }
}
