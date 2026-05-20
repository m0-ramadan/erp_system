<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\JobTicket;
use App\Models\Quotation;
use App\Models\QuoteRequest;
use App\Models\SalesOrder;
use App\Models\WorkflowTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'customers' => Customer::count(),
            'quote_requests' => QuoteRequest::count(),
            'quotations' => Quotation::count(),
            'sales_orders' => SalesOrder::count(),
            'job_tickets' => JobTicket::count(),
            'invoices' => Invoice::count(),
            'open_tasks' => WorkflowTask::whereIn('task_status', ['open', 'in_progress'])->count(),
            'total_sales' => SalesOrder::sum('total_amount'),
            'total_invoices' => Invoice::sum('total_amount'),
        ];

        $latestQuoteRequests = QuoteRequest::with(['customer', 'salesRep'])
            ->latest()
            ->limit(10)
            ->get();

        $openTasks = WorkflowTask::with(['instance', 'step', 'assignedUser'])
            ->whereIn('task_status', ['open', 'in_progress'])
            ->latest()
            ->limit(10)
            ->get();

        if ($request->wantsJson() || ! View::exists('Admin.dashboard.index')) {
            return response()->json(compact('stats', 'latestQuoteRequests', 'openTasks'));
        }

        return view('Admin.dashboard.index', compact('stats', 'latestQuoteRequests', 'openTasks'));
    }
}
