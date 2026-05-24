<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\QuoteRequest;
use App\Models\Quotation;
use App\Models\SalesOrder;
use App\Models\WorkflowInstance;

class WorkflowInstanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get or create a default user to associate with
        $admin = User::where('email', 'demo@admin.com')->first() ?? User::first();
        if (!$admin) {
            return;
        }

        // 2. Insert mock Customers
        $customer1 = Customer::updateOrCreate(
            ['customer_code' => 'CUST-0001'],
            [
                'company_name' => 'شركة النور للمقاولات',
                'customer_type' => 'existing',
                'tax_number' => '123-456-789',
                'commercial_register' => 'CR-54321',
                'email' => 'contact@alnoor.com',
                'phone' => '01012345678',
                'address_line1' => 'شارع التحرير، الدقي',
                'city' => 'القاهرة',
                'country' => 'مصر',
                'assigned_sales_rep_id' => $admin->id,
                'status' => 'active',
                'created_by' => $admin->id
            ]
        );

        $customer2 = Customer::updateOrCreate(
            ['customer_code' => 'CUST-0002'],
            [
                'company_name' => 'مجموعة الفهد للتجارة',
                'customer_type' => 'prospect',
                'tax_number' => '987-654-321',
                'commercial_register' => 'CR-98765',
                'email' => 'info@alfahad.com',
                'phone' => '01234567890',
                'address_line1' => 'طريق الملك فهد',
                'city' => 'الرياض',
                'country' => 'السعودية',
                'assigned_sales_rep_id' => $admin->id,
                'status' => 'active',
                'created_by' => $admin->id
            ]
        );

        // Contacts
        $contact1 = CustomerContact::updateOrCreate(
            ['customer_id' => $customer1->id, 'email' => 'ahmed@alnoor.com'],
            [
                'contact_name' => 'أحمد علي',
                'phone' => '01012345679',
                'job_title' => 'مدير المشتريات',
                'is_primary' => true
            ]
        );

        $contact2 = CustomerContact::updateOrCreate(
            ['customer_id' => $customer2->id, 'email' => 'fahad@alfahad.com'],
            [
                'contact_name' => 'فهد العتيبي',
                'phone' => '01234567891',
                'job_title' => 'المدير التنفيذي',
                'is_primary' => true
            ]
        );

        // Currencies
        $egp = DB::table('currencies')->where('code', 'EGP')->first();
        $egpId = $egp ? $egp->id : 1;

        // 3. Insert mock Quote Requests
        $req1 = QuoteRequest::updateOrCreate(
            ['request_no' => 'REQ-2026-0001'],
            [
                'request_source' => 'sales_rep',
                'customer_id' => $customer1->id,
                'contact_id' => $contact1->id,
                'created_by' => $admin->id,
                'sales_rep_id' => $admin->id,
                'title' => 'تأثيث مقر الإدارة الرئيسي',
                'project_name' => 'مقر الدقي الجديد',
                'priority' => 'high',
                'requested_delivery_date' => now()->addDays(30)->toDateString(),
                'currency_id' => $egpId,
                'status' => 'estimation_in_progress',
                'completeness_status' => 'complete',
                'customer_requirements' => 'مكاتب خشبية فاخرة، كراسي مريحة، طاولة اجتماعات كبيرة.',
                'submitted_at' => now()
            ]
        );

        $req2 = QuoteRequest::updateOrCreate(
            ['request_no' => 'REQ-2026-0002'],
            [
                'request_source' => 'email',
                'customer_id' => $customer2->id,
                'contact_id' => $contact2->id,
                'created_by' => $admin->id,
                'sales_rep_id' => $admin->id,
                'title' => 'توريد مواد بناء للمشروع السكني',
                'project_name' => 'أبراج الفهد السكنية',
                'priority' => 'urgent',
                'requested_delivery_date' => now()->addDays(15)->toDateString(),
                'currency_id' => $egpId,
                'status' => 'clarification_requested',
                'completeness_status' => 'incomplete',
                'customer_requirements' => 'حديد تسليح عالي المقاومة وخرسانة جاهزة بمواصفات خاصة.',
                'submitted_at' => now()
            ]
        );

        // 4. Insert mock Quotations
        $quote1 = Quotation::updateOrCreate(
            ['quotation_no' => 'QTN-2026-0001'],
            [
                'quote_request_id' => $req1->id,
                'customer_id' => $customer1->id,
                'created_by' => $admin->id,
                'status' => 'draft',
                'quotation_date' => now()->toDateString(),
                'valid_until' => now()->addDays(30)->toDateString(),
                'currency_id' => $egpId,
                'payment_terms_id' => 1,
                'subtotal' => 150000,
                'discount_amount' => 5000,
                'tax_amount' => 20300,
                'total_amount' => 165300
            ]
        );

        // 5. Insert mock Sales Orders
        $order1 = SalesOrder::updateOrCreate(
            ['order_no' => 'ORD-2026-0001'],
            [
                'quotation_id' => $quote1->id,
                'order_date' => now()->toDateString(),
                'planned_delivery_date' => now()->addDays(45)->toDateString(),
                'customer_id' => $customer1->id,
                'sales_rep_id' => $admin->id,
                'status' => 'created',
                'total_amount' => 165300,
                'created_by' => $admin->id
            ]
        );

        // 6. Seed Workflow Instances
        // Instance 1: Quote Request at estimation step
        WorkflowInstance::updateOrCreate(
            ['entity_type' => 'quote_request', 'entity_id' => $req1->id],
            [
                'current_step_code' => 'BUILD_COST_ESTIMATION',
                'status' => 'active',
                'started_by' => $admin->id,
                'started_at' => now()->subDays(2)
            ]
        );

        // Instance 2: Quote Request at clarification step (on-hold)
        WorkflowInstance::updateOrCreate(
            ['entity_type' => 'quote_request', 'entity_id' => $req2->id],
            [
                'current_step_code' => 'REQUEST_CLARIFICATION',
                'status' => 'on_hold',
                'started_by' => $admin->id,
                'started_at' => now()->subDays(4)
            ]
        );

        // Instance 3: Quotation generated & completed
        WorkflowInstance::updateOrCreate(
            ['entity_type' => 'quotation', 'entity_id' => $quote1->id],
            [
                'current_step_code' => 'GENERATE_QUOTATION_PDF',
                'status' => 'completed',
                'started_by' => $admin->id,
                'started_at' => now()->subDays(5),
                'completed_at' => now()->subDay()
            ]
        );

        // Instance 4: Sales Order at production planning
        WorkflowInstance::updateOrCreate(
            ['entity_type' => 'sales_order', 'entity_id' => $order1->id],
            [
                'current_step_code' => 'PLAN_PRODUCTION',
                'status' => 'active',
                'started_by' => $admin->id,
                'started_at' => now()
            ]
        );
    }
}
