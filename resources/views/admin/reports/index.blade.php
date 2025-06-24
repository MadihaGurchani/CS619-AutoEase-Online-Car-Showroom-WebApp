@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Sales</h3>
            <p class="text-3xl font-bold text-gray-900">PKR {{ number_format($totalSales) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Orders</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Completed Orders</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $completedOrders }}</p>
        </div>
    </div>

    <!-- Payment Methods Chart -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Payment Methods Distribution</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Payment Type</th>
                        <th class="px-6 py-3 text-left">Number of Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentStats as $stat)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ ucfirst($stat->payment_type) }}</td>
                        <td class="px-6 py-4">{{ $stat->count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly Sales Chart -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Monthly Sales Overview</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Month</th>
                        <th class="px-6 py-3 text-left">Total Sales</th>
                        <th class="px-6 py-3 text-left">Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlySales as $sale)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ date('F Y', mktime(0, 0, 0, $sale->month, 1, $sale->year)) }}</td>
                        <td class="px-6 py-4">PKR {{ number_format($sale->total_sales) }}</td>
                        <td class="px-6 py-4">{{ $sale->order_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Orders</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Order Number</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Car</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $order->order_number }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">{{ $order->car->brand->brand }} {{ $order->car->model }}</td>
                        <td class="px-6 py-4">PKR {{ number_format($order->total_amount) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs 
                                {{ $order->status === 'completed' ? 'bg-green-200 text-green-800' : 
                                   ($order->status === 'cancelled' ? 'bg-red-200 text-red-800' : 
                                   'bg-yellow-200 text-yellow-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection