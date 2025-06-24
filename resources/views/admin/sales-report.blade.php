@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Sales Report</h2>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-blue-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Total Sales</h3>
                <p class="text-2xl">PKR {{ number_format($totalSales) }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Total Orders</h3>
                <p class="text-2xl">{{ $totalOrders }}</p>
            </div>
            <div class="bg-purple-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Payment Methods</h3>
                @foreach($paymentStats as $stat)
                    <p>{{ ucfirst($stat->payment_type) }}: {{ $stat->count }}</p>
                @endforeach
            </div>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b">Order Number</th>
                        <th class="px-6 py-3 border-b">Customer</th>
                        <th class="px-6 py-3 border-b">Car Model</th>
                        <th class="px-6 py-3 border-b">Payment Type</th>
                        <th class="px-6 py-3 border-b">Amount</th>
                        <th class="px-6 py-3 border-b">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->car->brand->brand }} {{ $order->car->model }}</td>
                        <td class="px-6 py-4 border-b">{{ ucfirst($order->payment_type) }}</td>
                        <td class="px-6 py-4 border-b">PKR {{ number_format($order->total_amount) }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection