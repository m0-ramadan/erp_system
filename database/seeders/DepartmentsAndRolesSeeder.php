<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['code' => 'SETUP', 'name' => 'Setup', 'description' => 'System setup, master data and user roles'],
            ['code' => 'SALES', 'name' => 'Sales', 'description' => 'Sales representative and sales coordinator activities'],
            ['code' => 'ESTIMATION', 'name' => 'Estimation Office', 'description' => 'Completeness review, clarification and cost estimation'],
            ['code' => 'DESIGN', 'name' => 'Design', 'description' => 'Design feasibility and approval'],
            ['code' => 'ACCOUNTS', 'name' => 'Accounts', 'description' => 'Financial review and accounts approval'],
            ['code' => 'MANAGEMENT', 'name' => 'Management', 'description' => 'Final approval'],
            ['code' => 'SYSTEM', 'name' => 'System', 'description' => 'Automated workflow, PDF, notifications, audit'],
            ['code' => 'PRODUCTION', 'name' => 'Production / Dispatch', 'description' => 'Production planning, quality, dispatch and delivery'],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->updateOrInsert(
                ['code' => $department['code']],
                $department
            );
        }

        $departmentIds = DB::table('departments')
            ->whereIn('code', array_column($departments, 'code'))
            ->pluck('id', 'code');

        $roles = [
            ['code' => 'ADMIN', 'name' => 'Administrator', 'department_code' => 'SETUP', 'is_system_role' => true, 'is_active' => true],
            ['code' => 'SALES_REP', 'name' => 'Sales Rep', 'department_code' => 'SALES', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'SALES_COORDINATOR', 'name' => 'Sales Coordinator', 'department_code' => 'SALES', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'ESTIMATION_OFFICER', 'name' => 'Estimation Officer', 'department_code' => 'ESTIMATION', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'DESIGNER', 'name' => 'Designer', 'department_code' => 'DESIGN', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'ACCOUNTS_USER', 'name' => 'Accounts User', 'department_code' => 'ACCOUNTS', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'MANAGER', 'name' => 'Manager', 'department_code' => 'MANAGEMENT', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'PRODUCTION_USER', 'name' => 'Production User', 'department_code' => 'PRODUCTION', 'is_system_role' => false, 'is_active' => true],
            ['code' => 'SYSTEM', 'name' => 'System User', 'department_code' => 'SYSTEM', 'is_system_role' => true, 'is_active' => true],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['code' => $role['code']],
                [
                    'name' => $role['name'],
                    'department_id' => $departmentIds[$role['department_code']] ?? null,
                    'is_system_role' => $role['is_system_role'],
                    'is_active' => $role['is_active'],
                ]
            );
        }

        $permissions = [
            ['code' => 'dashboard.access', 'name' => 'Access Dashboard', 'module' => 'dashboard'],
            ['code' => 'departments.access', 'name' => 'Access Departments', 'module' => 'setup'],
            ['code' => 'roles.access', 'name' => 'Access Roles', 'module' => 'setup'],
            ['code' => 'permissions.access', 'name' => 'Access Permissions', 'module' => 'setup'],
            ['code' => 'users.access', 'name' => 'Access Users', 'module' => 'setup'],
            ['code' => 'currencies.access', 'name' => 'Access Currencies', 'module' => 'setup'],
            ['code' => 'payment-terms.access', 'name' => 'Access Payment Terms', 'module' => 'setup'],
            ['code' => 'file-types.access', 'name' => 'Access File Types', 'module' => 'setup'],
            ['code' => 'products.access', 'name' => 'Access Products', 'module' => 'catalog'],
            ['code' => 'product-specs.access', 'name' => 'Access Product Specs', 'module' => 'catalog'],
            ['code' => 'customers.access', 'name' => 'Access Customers', 'module' => 'catalog'],
            ['code' => 'customer-contacts.access', 'name' => 'Access Customer Contacts', 'module' => 'catalog'],
            ['code' => 'workflow-steps.access', 'name' => 'Access Workflow Steps', 'module' => 'workflow'],
            ['code' => 'workflow-transitions.access', 'name' => 'Access Workflow Transitions', 'module' => 'workflow'],
            ['code' => 'workflow-instances.access', 'name' => 'Access Workflow Instances', 'module' => 'workflow'],
            ['code' => 'workflow-tasks.access', 'name' => 'Access Workflow Tasks', 'module' => 'workflow'],
            ['code' => 'workflow-history.access', 'name' => 'Access Workflow History', 'module' => 'workflow'],
            ['code' => 'quote-requests.access', 'name' => 'Access Quote Requests', 'module' => 'quotation'],
            ['code' => 'quote-request-items.access', 'name' => 'Access Quote Request Items', 'module' => 'quotation'],
            ['code' => 'request-files.access', 'name' => 'Access Request Files', 'module' => 'quotation'],
            ['code' => 'clarifications.access', 'name' => 'Access Clarifications', 'module' => 'quotation'],
            ['code' => 'cost-estimations.access', 'name' => 'Access Cost Estimations', 'module' => 'quotation'],
            ['code' => 'cost-estimation-items.access', 'name' => 'Access Cost Estimation Items', 'module' => 'quotation'],
            ['code' => 'design-reviews.access', 'name' => 'Access Design Reviews', 'module' => 'quotation'],
            ['code' => 'accounts-reviews.access', 'name' => 'Access Accounts Reviews', 'module' => 'quotation'],
            ['code' => 'management-approvals.access', 'name' => 'Access Management Approvals', 'module' => 'quotation'],
            ['code' => 'quotations.access', 'name' => 'Access Quotations', 'module' => 'quotation'],
            ['code' => 'quotation-versions.access', 'name' => 'Access Quotation Versions', 'module' => 'quotation'],
            ['code' => 'quotation-items.access', 'name' => 'Access Quotation Items', 'module' => 'quotation'],
            ['code' => 'quotation-files.access', 'name' => 'Access Quotation Files', 'module' => 'quotation'],
            ['code' => 'customer-responses.access', 'name' => 'Access Customer Responses', 'module' => 'quotation'],
            ['code' => 'sales-orders.access', 'name' => 'Access Sales Orders', 'module' => 'operations'],
            ['code' => 'job-tickets.access', 'name' => 'Access Job Tickets', 'module' => 'operations'],
            ['code' => 'production-plans.access', 'name' => 'Access Production Plans', 'module' => 'operations'],
            ['code' => 'production-logs.access', 'name' => 'Access Production Logs', 'module' => 'operations'],
            ['code' => 'quality-checks.access', 'name' => 'Access Quality Checks', 'module' => 'operations'],
            ['code' => 'dispatches.access', 'name' => 'Access Dispatches', 'module' => 'operations'],
            ['code' => 'deliveries.access', 'name' => 'Access Deliveries', 'module' => 'operations'],
            ['code' => 'invoices.access', 'name' => 'Access Invoices', 'module' => 'finance'],
            ['code' => 'invoice-items.access', 'name' => 'Access Invoice Items', 'module' => 'finance'],
            ['code' => 'reminders.access', 'name' => 'Access Reminders', 'module' => 'support'],
            ['code' => 'notifications.access', 'name' => 'Access Notifications', 'module' => 'support'],
            ['code' => 'notification-recipients.access', 'name' => 'Access Notification Recipients', 'module' => 'support'],
            ['code' => 'audit-logs.access', 'name' => 'Access Audit Logs', 'module' => 'support'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['code' => $permission['code']],
                [
                    'name' => $permission['name'],
                    'module' => $permission['module'],
                    'description' => $permission['name'],
                ]
            );
        }

        $roleIds = DB::table('roles')
            ->whereIn('code', array_column($roles, 'code'))
            ->pluck('id', 'code');

        $permissionIds = DB::table('permissions')
            ->whereIn('code', array_column($permissions, 'code'))
            ->pluck('id', 'code');

        $rolePermissions = [
            'ADMIN' => array_column($permissions, 'code'),
            'SALES_REP' => [
                'dashboard.access',
                'customers.access',
                'customer-contacts.access',
                'products.access',
                'product-specs.access',
                'workflow-tasks.access',
                'quote-requests.access',
                'quote-request-items.access',
                'request-files.access',
                'clarifications.access',
                'quotations.access',
                'quotation-versions.access',
                'quotation-items.access',
                'quotation-files.access',
                'customer-responses.access',
                'sales-orders.access',
                'reminders.access',
                'notifications.access',
            ],
            'SALES_COORDINATOR' => [
                'dashboard.access',
                'customers.access',
                'customer-contacts.access',
                'products.access',
                'product-specs.access',
                'workflow-tasks.access',
                'quote-requests.access',
                'quote-request-items.access',
                'request-files.access',
                'clarifications.access',
                'quotations.access',
                'quotation-versions.access',
                'quotation-items.access',
                'quotation-files.access',
                'customer-responses.access',
                'sales-orders.access',
                'reminders.access',
                'notifications.access',
            ],
            'ESTIMATION_OFFICER' => [
                'dashboard.access',
                'customers.access',
                'customer-contacts.access',
                'products.access',
                'product-specs.access',
                'workflow-tasks.access',
                'workflow-history.access',
                'quote-requests.access',
                'quote-request-items.access',
                'request-files.access',
                'clarifications.access',
                'cost-estimations.access',
                'cost-estimation-items.access',
                'quotations.access',
                'quotation-versions.access',
                'quotation-items.access',
                'quotation-files.access',
                'reminders.access',
                'notifications.access',
            ],
            'DESIGNER' => [
                'dashboard.access',
                'products.access',
                'product-specs.access',
                'workflow-tasks.access',
                'quote-requests.access',
                'quote-request-items.access',
                'request-files.access',
                'clarifications.access',
                'cost-estimations.access',
                'cost-estimation-items.access',
                'design-reviews.access',
                'quotations.access',
                'quotation-versions.access',
                'quotation-items.access',
                'quotation-files.access',
                'reminders.access',
                'notifications.access',
            ],
            'ACCOUNTS_USER' => [
                'dashboard.access',
                'customers.access',
                'workflow-tasks.access',
                'quote-requests.access',
                'cost-estimations.access',
                'accounts-reviews.access',
                'quotations.access',
                'sales-orders.access',
                'invoices.access',
                'invoice-items.access',
                'reminders.access',
                'notifications.access',
            ],
            'MANAGER' => [
                'dashboard.access',
                'customers.access',
                'workflow-tasks.access',
                'workflow-history.access',
                'quote-requests.access',
                'cost-estimations.access',
                'design-reviews.access',
                'accounts-reviews.access',
                'management-approvals.access',
                'quotations.access',
                'sales-orders.access',
                'invoices.access',
                'invoice-items.access',
                'audit-logs.access',
                'reminders.access',
                'notifications.access',
            ],
            'PRODUCTION_USER' => [
                'dashboard.access',
                'products.access',
                'product-specs.access',
                'workflow-tasks.access',
                'sales-orders.access',
                'job-tickets.access',
                'production-plans.access',
                'production-logs.access',
                'quality-checks.access',
                'dispatches.access',
                'deliveries.access',
                'reminders.access',
                'notifications.access',
            ],
            'SYSTEM' => [
                'dashboard.access',
                'workflow-steps.access',
                'workflow-transitions.access',
                'workflow-instances.access',
                'workflow-tasks.access',
                'workflow-history.access',
                'notifications.access',
                'notification-recipients.access',
                'reminders.access',
                'audit-logs.access',
            ],
        ];

        DB::table('role_permissions')
            ->whereIn('role_id', $roleIds->values())
            ->delete();

        $rows = [];

        foreach ($rolePermissions as $roleCode => $codes) {
            $roleId = $roleIds[$roleCode] ?? null;

            if (! $roleId) {
                continue;
            }

            foreach ($codes as $permissionCode) {
                $permissionId = $permissionIds[$permissionCode] ?? null;

                if ($permissionId) {
                    $rows[] = [
                        'role_id' => $roleId,
                        'permission_id' => $permissionId,
                    ];
                }
            }
        }

        if ($rows !== []) {
            DB::table('role_permissions')->insert($rows);
        }
    }
}
