<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
| API Routes - Quotation Workflow System
|--------------------------------------------------------------------------
|
| These routes use the same new controllers. The base CRUD controller returns
| JSON automatically when no matching Blade view exists or when JSON is requested.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('quotation-workflow')->as('api.quotation-workflow.')->group(function () {
    Route::get('/workflow/open-tasks', [WorkflowController::class, 'openTasks'])->name('workflow.open-tasks');
    Route::post('/workflow/instances/{workflowInstance}/move', [WorkflowController::class, 'move'])->name('workflow.instances.move');

    Route::post('/quote-requests/{quoteRequest}/submit', [QuoteRequestController::class, 'submit'])->name('quote-requests.submit');
    Route::post('/quote-requests/{quoteRequest}/assign-sales-rep', [QuoteRequestController::class, 'assignSalesRep'])->name('quote-requests.assign-sales-rep');
    Route::post('/quote-requests/{quoteRequest}/completeness', [QuoteRequestController::class, 'completeness'])->name('quote-requests.completeness');

    Route::post('/cost-estimations/{costEstimation}/submit', [CostEstimationController::class, 'submit'])->name('cost-estimations.submit');
    Route::post('/design-reviews/{designReview}/decide', [DesignReviewController::class, 'decide'])->name('design-reviews.decide');
    Route::post('/accounts-reviews/{accountsReview}/decide', [AccountsReviewController::class, 'decide'])->name('accounts-reviews.decide');
    Route::post('/management-approvals/{managementApproval}/decide', [ManagementApprovalController::class, 'decide'])->name('management-approvals.decide');

    Route::post('/quotations/{quotation}/send-to-customer', [QuotationController::class, 'sendToCustomer'])->name('quotations.send-to-customer');
    Route::post('/quotations/{quotation}/record-customer-response', [QuotationController::class, 'recordCustomerResponse'])->name('quotations.record-customer-response');

    Route::post('/sales-orders/{salesOrder}/create-job-ticket', [SalesOrderController::class, 'createJobTicket'])->name('sales-orders.create-job-ticket');
    Route::post('/sales-orders/{salesOrder}/hold', [SalesOrderController::class, 'hold'])->name('sales-orders.hold');
    Route::post('/sales-orders/{salesOrder}/cancel', [SalesOrderController::class, 'cancel'])->name('sales-orders.cancel');
    Route::post('/sales-orders/{salesOrder}/reopen', [SalesOrderController::class, 'reopen'])->name('sales-orders.reopen');
    Route::post('/sales-orders/{salesOrder}/close', [SalesOrderController::class, 'close'])->name('sales-orders.close');

    Route::post('/job-tickets/{jobTicket}/update-status', [JobTicketController::class, 'updateStatus'])->name('job-tickets.update-status');
    Route::post('/production-plans/{productionPlan}/approve', [ProductionPlanController::class, 'approve'])->name('production-plans.approve');
    Route::post('/production-plans/{productionPlan}/release', [ProductionPlanController::class, 'release'])->name('production-plans.release');
    Route::post('/production-plans/{productionPlan}/complete', [ProductionPlanController::class, 'complete'])->name('production-plans.complete');
    Route::post('/quality-checks/{qualityCheck}/decide', [QualityCheckController::class, 'decide'])->name('quality-checks.decide');
    Route::post('/dispatches/{dispatch}/mark-dispatched', [DispatchController::class, 'markDispatched'])->name('dispatches.mark-dispatched');
    Route::post('/deliveries/{delivery}/confirm', [DeliveryController::class, 'confirm'])->name('deliveries.confirm');
    Route::post('/invoices/{invoice}/issue', [InvoiceController::class, 'issue'])->name('invoices.issue');
    Route::post('/invoices/{invoice}/mark-paid', [InvoiceController::class, 'markPaid'])->name('invoices.mark-paid');

    Route::apiResources([
        'departments' => DepartmentController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'users' => UserController::class,
        'currencies' => CurrencyController::class,
        'payment-terms' => PaymentTermController::class,
        'file-types' => FileTypeController::class,
        'products' => ProductController::class,
        'product-specs' => ProductSpecController::class,
        'customers' => CustomerController::class,
        'customer-contacts' => CustomerContactController::class,
        'workflow-steps' => WorkflowStepController::class,
        'workflow-transitions' => WorkflowTransitionController::class,
        'workflow-instances' => WorkflowInstanceController::class,
        'workflow-tasks' => WorkflowTaskController::class,
        'workflow-history' => WorkflowHistoryController::class,
        'quote-requests' => QuoteRequestController::class,
        'quote-request-items' => QuoteRequestItemController::class,
        'request-files' => RequestFileController::class,
        'clarifications' => ClarificationController::class,
        'cost-estimations' => CostEstimationController::class,
        'cost-estimation-items' => CostEstimationItemController::class,
        'design-reviews' => DesignReviewController::class,
        'accounts-reviews' => AccountsReviewController::class,
        'management-approvals' => ManagementApprovalController::class,
        'quotations' => QuotationController::class,
        'quotation-versions' => QuotationVersionController::class,
        'quotation-items' => QuotationItemController::class,
        'quotation-files' => QuotationFileController::class,
        'customer-responses' => CustomerResponseController::class,
        'sales-orders' => SalesOrderController::class,
        'job-tickets' => JobTicketController::class,
        'production-plans' => ProductionPlanController::class,
        'production-logs' => ProductionLogController::class,
        'quality-checks' => QualityCheckController::class,
        'dispatches' => DispatchController::class,
        'deliveries' => DeliveryController::class,
        'invoices' => InvoiceController::class,
        'invoice-items' => InvoiceItemController::class,
        'reminders' => ReminderController::class,
        'notifications' => NotificationController::class,
        'notification-recipients' => NotificationRecipientController::class,
        'audit-logs' => AuditLogController::class,
    ]);
});
