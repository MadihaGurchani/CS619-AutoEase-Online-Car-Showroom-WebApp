@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Delivery Charge Management -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Manage Delivery Charges</h3>
        <!-- Update the form action -->
        <form action="{{ route('admin.delivery-charge.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Doorstep Delivery Charge (PKR)</label>
                    <input type="number" name="delivery_charge" value="{{ \App\Models\Setting::where('key', 'delivery_charge')->first()?->value }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Charge
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Orders Management -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Order Management</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Order Number</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Payment Type</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $order->order_number }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">PKR {{ number_format($order->total_amount) }}</td>
                        <td class="px-6 py-4">{{ ucfirst($order->payment_type) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.orders.status.update', $order->id) }}" method="POST" class="status-update-form">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
    <div class="flex flex-wrap gap-2">
        @if($order->payment_type === 'installment')
            <a href="{{ route('admin.orders.installments', $order->id) }}"
               class="bg-green-500 hover:bg-green-600 text-white font-medium text-sm px-3 py-2 rounded-md shadow transition duration-200 text-center">
                Manage Installments
            </a>
        @endif

        <a href="{{ route('admin.orders.track', $order->id) }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-medium text-sm px-3 py-2 rounded-md shadow transition duration-200 text-center">
            Track
        </a>
    </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const orderId = this.dataset.orderId;
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: this.value,
                    _method: 'PUT'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optional: Show success message
                    alert('Status updated successfully');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating status');
            });
        });
    });
});
</script>
@endpush