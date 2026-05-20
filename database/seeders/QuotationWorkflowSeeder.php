<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotationWorkflowSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DepartmentsAndRolesSeeder::class);

        DB::table('currencies')->insertOrIgnore([
            ['code' => 'EGP', 'name' => 'Egyptian Pound', 'symbol' => 'ج.م', 'exchange_rate_to_base' => 1, 'is_base' => true],
            ['code' => 'SAR', 'name' => 'Saudi Riyal', 'symbol' => 'SAR', 'exchange_rate_to_base' => 1],
            ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'exchange_rate_to_base' => 1],
        ]);

        DB::table('payment_terms')->insertOrIgnore([
            ['code' => 'CASH', 'name' => 'Cash', 'description' => 'Immediate payment', 'days_count' => 0],
            ['code' => 'NET15', 'name' => 'Net 15', 'description' => 'Payment due within 15 days', 'days_count' => 15],
            ['code' => 'NET30', 'name' => 'Net 30', 'description' => 'Payment due within 30 days', 'days_count' => 30],
            ['code' => 'ADVANCE_50', 'name' => '50% Advance', 'description' => '50% advance payment and balance on delivery'],
        ]);

        DB::table('file_types')->insertOrIgnore([
            ['code' => 'REQUEST_ATTACHMENT', 'name' => 'Request Attachment', 'allowed_extensions' => 'pdf,doc,docx,xls,xlsx,png,jpg,jpeg,dwg,zip', 'max_size_mb' => 50],
            ['code' => 'DESIGN_FILE', 'name' => 'Design File', 'allowed_extensions' => 'pdf,dwg,dxf,png,jpg,jpeg,zip', 'max_size_mb' => 100],
            ['code' => 'QUOTATION_PDF', 'name' => 'Quotation PDF', 'allowed_extensions' => 'pdf', 'max_size_mb' => 20],
            ['code' => 'DELIVERY_PROOF', 'name' => 'Delivery Proof', 'allowed_extensions' => 'pdf,png,jpg,jpeg', 'max_size_mb' => 20],
            ['code' => 'INVOICE_PDF', 'name' => 'Invoice PDF', 'allowed_extensions' => 'pdf', 'max_size_mb' => 20],
        ]);

        $steps = [
            ['START', 'Start', 'General', null, 'start', 1, false],
            ['SYSTEM_SETUP', 'System Setup', 'Setup', 'ADMIN', 'task', 10, false],
            ['MASTER_DATA_ENTRY', 'Master Data Entry', 'Setup', 'ADMIN', 'task', 20, false],
            ['USER_ROLES_SETUP', 'User Roles Setup', 'Setup', 'ADMIN', 'task', 30, false],
            ['LOGIN_SALES_REP', 'Login', 'Sales Rep', 'SALES_REP', 'task', 100, false],
            ['FOLLOW_UP_CUSTOMER', 'Follow Up Customer', 'Sales Rep', 'SALES_REP', 'task', 110, false],
            ['RECORD_CUSTOMER_RESPONSE', 'Record Customer Response', 'Sales Rep', 'SALES_REP', 'task', 120, false],
            ['CREATE_QUOTE_REQUEST_REP', 'Create Quote Request', 'Sales Rep', 'SALES_REP', 'task', 130, false],
            ['ENTER_CUSTOMER_DATA', 'Enter Customer Data', 'Sales Rep', 'SALES_REP', 'task', 140, false],
            ['ENTER_PRODUCT_SPECS', 'Enter Product Specs', 'Sales Rep', 'SALES_REP', 'task', 150, false],
            ['ATTACH_FILES_REP', 'Attach Files', 'Sales Rep', 'SALES_REP', 'task', 160, false],
            ['SUBMIT_QUOTE_REQUEST_REP', 'Submit Quote Request', 'Sales Rep', 'SALES_REP', 'task', 170, false],
            ['SEND_QUOTATION_TO_CUSTOMER', 'Send Quotation to Customer', 'Sales Rep', 'SALES_REP', 'task', 180, false],
            ['LOGIN_SALES_COORDINATOR', 'Login', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 200, false],
            ['CREATE_QUOTE_REQUEST_COORDINATOR', 'Create Quote Request', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 210, false],
            ['LINK_TO_CUSTOMER', 'Link to Customer', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 220, false],
            ['ASSIGN_SALES_REP', 'Assign Sales Rep', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 230, false],
            ['ATTACH_FILES_COORDINATOR', 'Attach Files', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 240, false],
            ['SUBMIT_QUOTE_REQUEST_COORDINATOR', 'Submit Quote Request', 'Sales Coordinator', 'SALES_COORDINATOR', 'task', 250, false],
            ['REVIEW_REQUEST_COMPLETENESS', 'Review Request Completeness', 'Estimation Officer', 'ESTIMATION_OFFICER', 'task', 300, false],
            ['REQUEST_CLARIFICATION', 'Request Clarification', 'Estimation Officer', 'ESTIMATION_OFFICER', 'task', 310, false],
            ['BUILD_COST_ESTIMATION', 'Build Cost Estimation', 'Estimation Officer', 'ESTIMATION_OFFICER', 'task', 320, false],
            ['GENERATE_DRAFT_QUOTATION', 'Generate Draft Quotation', 'Estimation Officer', 'ESTIMATION_OFFICER', 'task', 330, false],
            ['REVISE_ESTIMATION', 'Revise Estimation', 'Estimation Officer', 'ESTIMATION_OFFICER', 'task', 340, false],
            ['REVIEW_DESIGN_FEASIBILITY', 'Review Design Feasibility', 'Design', 'DESIGNER', 'task', 400, false],
            ['APPROVE_DESIGN', 'Approve Design', 'Design', 'DESIGNER', 'task', 410, false],
            ['APPROVE_WITH_NOTES', 'Approve with Notes', 'Design', 'DESIGNER', 'task', 420, false],
            ['REJECT_DESIGN', 'Reject Design', 'Design', 'DESIGNER', 'task', 430, false],
            ['REVIEW_FINANCIALS', 'Review Financials', 'Accounts', 'ACCOUNTS_USER', 'task', 500, false],
            ['APPROVE_ACCOUNTS', 'Approve Accounts', 'Accounts', 'ACCOUNTS_USER', 'task', 510, false],
            ['RETURN_FOR_CORRECTION', 'Return for Correction', 'Accounts', 'ACCOUNTS_USER', 'task', 520, false],
            ['FINAL_APPROVAL', 'Final Approval', 'Management', 'MANAGER', 'task', 600, false],
            ['GENERATE_QUOTATION_PDF', 'Generate Quotation PDF', 'System', 'SYSTEM', 'system', 700, false],
            ['NOTIFY_SALES_REP', 'Notify Sales Rep', 'System', 'SYSTEM', 'system', 710, false],
            ['SEND_REMINDER', 'Send Reminder', 'System', 'SYSTEM', 'system', 720, false],
            ['VERSION_QUOTATION', 'Version Quotation', 'System', 'SYSTEM', 'system', 730, false],
            ['CREATE_SALES_ORDER', 'Create Sales Order', 'System', 'SYSTEM', 'system', 740, false],
            ['CREATE_JOB_TICKET', 'Create Job Ticket', 'System', 'SYSTEM', 'system', 750, false],
            ['HOLD_ORDER', 'Hold Order', 'System', 'SYSTEM', 'system', 760, false],
            ['NOTIFY_CUSTOMER', 'Notify Customer', 'System', 'SYSTEM', 'system', 770, false],
            ['CREATE_INVOICE', 'Create Invoice', 'System', 'SYSTEM', 'system', 780, false],
            ['LOG_AUDIT_EVENT', 'Log Audit Event', 'System', 'SYSTEM', 'system', 790, false],
            ['CLOSE_ORDER', 'Close Order', 'System', 'SYSTEM', 'system', 800, true],
            ['CANCEL_ORDER', 'Cancel Order', 'System', 'SYSTEM', 'system', 810, true],
            ['REOPEN_ORDER', 'Reopen Order', 'System', 'SYSTEM', 'system', 820, false],
            ['REVIEW_PRODUCTION_FEASIBILITY', 'Review Production Feasibility', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 900, false],
            ['PLAN_PRODUCTION', 'Plan Production', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 910, false],
            ['RELEASE_JOB_TO_PRODUCTION', 'Release Job to Production', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 920, false],
            ['MONITOR_PRODUCTION', 'Monitor Production', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 930, false],
            ['QUALITY_CHECK', 'Quality Check', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 940, false],
            ['DISPATCH_ORDER', 'Dispatch Order', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 950, false],
            ['CONFIRM_DELIVERY', 'Confirm Delivery', 'Production / Dispatch', 'PRODUCTION_USER', 'task', 960, false],
            ['GW_REQUEST_SOURCE', 'Request Source?', 'Gateway', null, 'gateway', 1000, false],
            ['GW_REQUEST_COMPLETE', 'Request Complete?', 'Gateway', null, 'gateway', 1010, false],
            ['GW_DESIGN_APPROVED', 'Design Approved?', 'Gateway', null, 'gateway', 1020, false],
            ['GW_ACCOUNTS_APPROVAL', 'Accounts Approval?', 'Gateway', null, 'gateway', 1030, false],
            ['GW_FINAL_APPROVAL_NEEDED', 'Final Approval Needed?', 'Gateway', null, 'gateway', 1040, false],
            ['GW_CUSTOMER_RESPONSE', 'Customer Response?', 'Gateway', null, 'gateway', 1050, false],
            ['GW_PRODUCTION_FEASIBLE', 'Production Feasible?', 'Gateway', null, 'gateway', 1060, false],
            ['GW_QUALITY_PASSED', 'Quality Passed?', 'Gateway', null, 'gateway', 1070, false],
            ['GW_REMINDER', 'Reminder?', 'Gateway', null, 'gateway', 1080, false],
            ['GW_ORDER_ON_HOLD', 'Order On Hold?', 'Gateway', null, 'gateway', 1090, false],
            ['GW_ORDER_REOPENED', 'Order Reopened?', 'Gateway', null, 'gateway', 1100, false],
            ['END', 'End', 'General', null, 'end', 9999, true],
        ];

        foreach ($steps as $step) {
            DB::table('workflow_steps')->updateOrInsert(
                ['code' => $step[0]],
                [
                    'name' => $step[1],
                    'lane' => $step[2],
                    'role_code' => $step[3],
                    'step_type' => $step[4],
                    'sort_order' => $step[5],
                    'is_terminal' => $step[6],
                ]
            );
        }
    }
}
