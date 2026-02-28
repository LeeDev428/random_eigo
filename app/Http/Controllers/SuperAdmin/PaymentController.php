<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display all payments / revenue overview.
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 'all');

        $query = Payment::with(['student', 'course']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $payments = $query->orderBy('payment_date', 'desc')->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $revenueThisMonth = Payment::where('status', 'paid')
            ->whereMonth('payment_date', $currentMonth)
            ->whereYear('payment_date', $currentYear)
            ->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->sum('amount');
        $totalTransactions = Payment::count();

        return view('superadmin.pages.payments', compact(
            'payments', 'status',
            'totalRevenue', 'revenueThisMonth', 'pendingPayments', 'totalTransactions'
        ));
    }
}
