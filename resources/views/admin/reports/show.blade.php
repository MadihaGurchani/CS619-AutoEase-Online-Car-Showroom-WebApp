@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ ucfirst($type) }} Report</h2>
            <p>Period: {{ $from }} to {{ $to }}</p>
        </div>

        @if($type === 'sales')
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 border-b">Date</th>
                            <th class="px-6 py-3 border-b">Total Sales</th>
                            <th class="px-6 py-3 border-b">Orders Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $row->date }}</td>
                            <td class="px-6 py-4 border-b">PKR {{ number_format($row->total_sales) }}</td>
                            <td class="px-6 py-4 border-b">{{ $row->orders_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif($type === 'orders')
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 border-b">Order Number</th>
                            <th class="px-6 py-3 border-b">Date</th>
                            <th class="px-6 py-3 border-b">Amount</th>
                            <th class="px-6 py-3 border-b">Status</th>
                            <th class="px-6 py-3 border-b">Payment Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $order)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 border-b">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 border-b">PKR {{ number_format($order->total_amount) }}</td>
                            <td class="px-6 py-4 border-b">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-4 border-b">{{ ucfirst($order->payment_type) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 border-b">Payment Method</th>
                            <th class="px-6 py-3 border-b">Number of Orders</th>
                            <th class="px-6 py-3 border-b">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ ucfirst($row->payment_type) }}</td>
                            <td class="px-6 py-4 border-b">{{ $row->count }}</td>
                            <td class="px-6 py-4 border-b">PKR {{ number_format($row->total_amount) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection