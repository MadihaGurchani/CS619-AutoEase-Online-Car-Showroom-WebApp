@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Customer Order History</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b text-left">Order ID</th>
                        <th class="px-6 py-3 border-b text-left">Customer Name</th>
                        <th class="px-6 py-3 border-b text-left">Car Model</th>
                        <th class="px-6 py-3 border-b text-left">Order Date</th>
                        <th class="px-6 py-3 border-b text-left">Total Amount</th>
                        <th class="px-6 py-3 border-b text-left">Status</th>
                        <th class="px-6 py-3 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->car->brand->brand }} {{ $order->car->model }}</td>
                        <td class="px-6 py-4 border-b">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 border-b">PKR {{ number_format($order->total_amount) }}</td>
                        <td class="px-6 py-4 border-b">
                            <span class="px-2 py-1 rounded-full text-sm 
                                {{ $order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                                   ($order->status === 'cancelled' ? 'bg-red-200 text-red-800' : 
                                   'bg-green-200 text-green-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm px-3 py-2 rounded-md shadow-sm transition duration-200 text-center">
    View Details
</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection