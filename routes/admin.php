<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WorkflowController;

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\PaymentTermController;
use App\Http\Controllers\Admin\FileTypeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSpecController;

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerContactController;

use App\Http\Controllers\Admin\WorkflowStepController;
use App\Http\Controllers\Admin\WorkflowTransitionController;
use App\Http\Controllers\Admin\WorkflowInstanceController;
use App\Http\Controllers\Admin\WorkflowTaskController;
use App\Http\Controllers\Admin\WorkflowHistoryController;

use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\Admin\QuoteRequestItemController;
use App\Http\Controllers\Admin\RequestFileController;
use App\Http\Controllers\Admin\ClarificationController;
use App\Http\Controllers\Admin\CostEstimationController;
use App\Http\Controllers\Admin\CostEstimationItemController;
use App\Http\Controllers\Admin\DesignReviewController;
use App\Http\Controllers\Admin\AccountsReviewController;
use App\Http\Controllers\Admin\ManagementApprovalController;

use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\QuotationVersionController;
use App\Http\Controllers\Admin\QuotationItemController;
use App\Http\Controllers\Admin\QuotationFileController;
use App\Http\Controllers\Admin\CustomerResponseController;

use App\Http\Controllers\Admin\SalesOrderController;
use App\Http\Controllers\Admin\JobTicketController;
use App\Http\Controllers\Admin\ProductionPlanController;
use App\Http\Controllers\Admin\ProductionLogController;
use App\Http\Controllers\Admin\QualityCheckController;
use App\Http\Controllers\Admin\DispatchController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoiceItemController;

use App\Http\Controllers\Admin\ReminderController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\NotificationRecipientController;
use App\Http\Controllers\Admin\AuditLogController;

/*
|--------------------------------------------------------------------------
| Admin Routes - Quotation Workflow System
|--------------------------------------------------------------------------
|
| Old system routes were removed.
| These routes match the new app/Http/Controllers/Admin controllers.
|
*/

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
    $registerProtectedResource = function (string $uri, string $controller, string $permission) {
        Route::resource($uri, $controller)->middleware("permission:{$permission}");
    };

    Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', [DashboardController::class, 'index'])->middleware('permission:dashboard.access')->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:dashboard.access')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Workflow Actions
    |--------------------------------------------------------------------------
    */
    Route::prefix('workflow')->as('workflow.')->group(function () {
        Route::get('/open-tasks', [WorkflowController::class, 'openTasks'])->middleware('permission:workflow-tasks.access')->name('open-tasks');
        Route::post('/instances/{workflowInstance}/move', [WorkflowController::class, 'move'])->middleware('permission:workflow-tasks.access')->name('instances.move');
    });

    /*
    |--------------------------------------------------------------------------
    | Setup / Master Data / Users / Roles
    |--------------------------------------------------------------------------
    */
    $registerProtectedResource('departments', DepartmentController::class, 'departments.access');
    $registerProtectedResource('roles', RoleController::class, 'roles.access');
    $registerProtectedResource('permissions', PermissionController::class, 'permissions.access');
    $registerProtectedResource('users', UserController::class, 'users.access');
    $registerProtectedResource('currencies', CurrencyController::class, 'currencies.access');
    $registerProtectedResource('payment-terms', PaymentTermController::class, 'payment-terms.access');
    $registerProtectedResource('file-types', FileTypeController::class, 'file-types.access');
    $registerProtectedResource('products', ProductController::class, 'products.access');
    $registerProtectedResource('product-specs', ProductSpecController::class, 'product-specs.access');

    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
    */
    $registerProtectedResource('customers', CustomerController::class, 'customers.access');
    $registerProtectedResource('customer-contacts', CustomerContactController::class, 'customer-contacts.access');

    /*
    |--------------------------------------------------------------------------
    | Workflow Setup / Tracking
    |--------------------------------------------------------------------------
    */
    $registerProtectedResource('workflow-steps', WorkflowStepController::class, 'workflow-steps.access');
    $registerProtectedResource('workflow-transitions', WorkflowTransitionController::class, 'workflow-transitions.access');
    $registerProtectedResource('workflow-instances', WorkflowInstanceController::class, 'workflow-instances.access');
    $registerProtectedResource('workflow-tasks', WorkflowTaskController::class, 'workflow-tasks.access');
    $registerProtectedResource('workflow-history', WorkflowHistoryController::class, 'workflow-history.access');

    /*
    |--------------------------------------------------------------------------
    | Quote Request / Estimation / Design / Accounts / Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('quote-requests')->as('quote-requests.')->group(function () {
        Route::post('/{quoteRequest}/submit', [QuoteRequestController::class, 'submit'])->middleware('permission:quote-requests.access')->name('submit');
        Route::post('/{quoteRequest}/assign-sales-rep', [QuoteRequestController::class, 'assignSalesRep'])->middleware('permission:quote-requests.access')->name('assign-sales-rep');
        Route::post('/{quoteRequest}/completeness', [QuoteRequestController::class, 'completeness'])->middleware('permission:quote-requests.access')->name('completeness');
    });

    Route::prefix('cost-estimations')->as('cost-estimations.')->group(function () {
        Route::post('/{costEstimation}/submit', [CostEstimationController::class, 'submit'])->middleware('permission:cost-estimations.access')->name('submit');
    });

    Route::prefix('design-reviews')->as('design-reviews.')->group(function () {
        Route::post('/{designReview}/decide', [DesignReviewController::class, 'decide'])->middleware('permission:design-reviews.access')->name('decide');
    });

    Route::prefix('accounts-reviews')->as('accounts-reviews.')->group(function () {
        Route::post('/{accountsReview}/decide', [AccountsReviewController::class, 'decide'])->middleware('permission:accounts-reviews.access')->name('decide');
    });

    Route::prefix('management-approvals')->as('management-approvals.')->group(function () {
        Route::post('/{managementApproval}/decide', [ManagementApprovalController::class, 'decide'])->middleware('permission:management-approvals.access')->name('decide');
    });

    $registerProtectedResource('quote-requests', QuoteRequestController::class, 'quote-requests.access');
    $registerProtectedResource('quote-request-items', QuoteRequestItemController::class, 'quote-request-items.access');
    $registerProtectedResource('request-files', RequestFileController::class, 'request-files.access');
    $registerProtectedResource('clarifications', ClarificationController::class, 'clarifications.access');
    $registerProtectedResource('cost-estimations', CostEstimationController::class, 'cost-estimations.access');
    $registerProtectedResource('cost-estimation-items', CostEstimationItemController::class, 'cost-estimation-items.access');
    $registerProtectedResource('design-reviews', DesignReviewController::class, 'design-reviews.access');
    $registerProtectedResource('accounts-reviews', AccountsReviewController::class, 'accounts-reviews.access');
    $registerProtectedResource('management-approvals', ManagementApprovalController::class, 'management-approvals.access');

    /*
    |--------------------------------------------------------------------------
    | Quotations / Versions / Customer Responses
    |--------------------------------------------------------------------------
    */
    Route::prefix('quotations')->as('quotations.')->group(function () {
        Route::post('/{quotation}/send-to-customer', [QuotationController::class, 'sendToCustomer'])->middleware('permission:quotations.access')->name('send-to-customer');
        Route::post('/{quotation}/record-customer-response', [QuotationController::class, 'recordCustomerResponse'])->middleware('permission:quotations.access')->name('record-customer-response');
    });

    $registerProtectedResource('quotations', QuotationController::class, 'quotations.access');
    $registerProtectedResource('quotation-versions', QuotationVersionController::class, 'quotation-versions.access');
    $registerProtectedResource('quotation-items', QuotationItemController::class, 'quotation-items.access');
    $registerProtectedResource('quotation-files', QuotationFileController::class, 'quotation-files.access');
    $registerProtectedResource('customer-responses', CustomerResponseController::class, 'customer-responses.access');

    /*
    |--------------------------------------------------------------------------
    | Sales Orders / Production / Dispatch / Delivery / Invoices
    |--------------------------------------------------------------------------
    */
    Route::prefix('sales-orders')->as('sales-orders.')->group(function () {
        Route::post('/{salesOrder}/create-job-ticket', [SalesOrderController::class, 'createJobTicket'])->middleware('permission:sales-orders.access')->name('create-job-ticket');
        Route::post('/{salesOrder}/hold', [SalesOrderController::class, 'hold'])->middleware('permission:sales-orders.access')->name('hold');
        Route::post('/{salesOrder}/cancel', [SalesOrderController::class, 'cancel'])->middleware('permission:sales-orders.access')->name('cancel');
        Route::post('/{salesOrder}/reopen', [SalesOrderController::class, 'reopen'])->middleware('permission:sales-orders.access')->name('reopen');
        Route::post('/{salesOrder}/close', [SalesOrderController::class, 'close'])->middleware('permission:sales-orders.access')->name('close');
    });

    Route::prefix('job-tickets')->as('job-tickets.')->group(function () {
        Route::post('/{jobTicket}/update-status', [JobTicketController::class, 'updateStatus'])->middleware('permission:job-tickets.access')->name('update-status');
    });

    Route::prefix('production-plans')->as('production-plans.')->group(function () {
        Route::post('/{productionPlan}/approve', [ProductionPlanController::class, 'approve'])->middleware('permission:production-plans.access')->name('approve');
        Route::post('/{productionPlan}/release', [ProductionPlanController::class, 'release'])->middleware('permission:production-plans.access')->name('release');
        Route::post('/{productionPlan}/complete', [ProductionPlanController::class, 'complete'])->middleware('permission:production-plans.access')->name('complete');
    });

    Route::prefix('quality-checks')->as('quality-checks.')->group(function () {
        Route::post('/{qualityCheck}/decide', [QualityCheckController::class, 'decide'])->middleware('permission:quality-checks.access')->name('decide');
    });

    Route::prefix('dispatches')->as('dispatches.')->group(function () {
        Route::post('/{dispatch}/mark-dispatched', [DispatchController::class, 'markDispatched'])->middleware('permission:dispatches.access')->name('mark-dispatched');
    });

    Route::prefix('deliveries')->as('deliveries.')->group(function () {
        Route::post('/{delivery}/confirm', [DeliveryController::class, 'confirm'])->middleware('permission:deliveries.access')->name('confirm');
    });

    Route::prefix('invoices')->as('invoices.')->group(function () {
        Route::post('/{invoice}/issue', [InvoiceController::class, 'issue'])->middleware('permission:invoices.access')->name('issue');
        Route::post('/{invoice}/mark-paid', [InvoiceController::class, 'markPaid'])->middleware('permission:invoices.access')->name('mark-paid');
    });

    $registerProtectedResource('sales-orders', SalesOrderController::class, 'sales-orders.access');
    $registerProtectedResource('job-tickets', JobTicketController::class, 'job-tickets.access');
    $registerProtectedResource('production-plans', ProductionPlanController::class, 'production-plans.access');
    $registerProtectedResource('production-logs', ProductionLogController::class, 'production-logs.access');
    $registerProtectedResource('quality-checks', QualityCheckController::class, 'quality-checks.access');
    $registerProtectedResource('dispatches', DispatchController::class, 'dispatches.access');
    $registerProtectedResource('deliveries', DeliveryController::class, 'deliveries.access');
    $registerProtectedResource('invoices', InvoiceController::class, 'invoices.access');
    $registerProtectedResource('invoice-items', InvoiceItemController::class, 'invoice-items.access');

    /*
    |--------------------------------------------------------------------------
    | Notifications / Reminders / Audit
    |--------------------------------------------------------------------------
    */
    $registerProtectedResource('reminders', ReminderController::class, 'reminders.access');
    $registerProtectedResource('notifications', NotificationController::class, 'notifications.access');
    $registerProtectedResource('notification-recipients', NotificationRecipientController::class, 'notification-recipients.access');
    $registerProtectedResource('audit-logs', AuditLogController::class, 'audit-logs.access');
});
