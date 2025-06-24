<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Get overall statistics
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        // Get payment method statistics
        $paymentStats = Order::select('payment_type', DB::raw('count(*) as count'))
            ->groupBy('payment_type')
            ->get();

        // Get recent orders
        $recentOrders = Order::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();

        // Get monthly sales data
        $monthlySales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as total_sales'),
            DB::raw('COUNT(*) as order_count')
        )
        ->where('status', '!=', 'cancelled')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->take(12)
        ->get();

        return view('admin.reports.index', compact(
            'totalSales',
            'totalOrders',
            'completedOrders',
            'paymentStats',
            'recentOrders',
            'monthlySales'
        ));
    }
}