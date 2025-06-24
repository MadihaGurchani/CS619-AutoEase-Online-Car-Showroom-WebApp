@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Installment Payment Reminders</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Order Number</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Total Amount</th>
                        <th class="px-6 py-3 text-left">Paid Amount</th>
                        <th class="px-6 py-3 text-left">Next Due Date</th>
                        <!-- Remove this line -->
                        <!-- <th class="px-6 py-3 text-left">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($dueInstallments as $order)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $order->order_number }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">PKR {{ number_format($order->total_amount) }}</td>
                        <td class="px-6 py-4">PKR {{ number_format($order->installmentPayments->sum('amount')) }}</td>
                        <td class="px-6 py-4">{{ optional($order->next_payment_date)->format('Y-m-d') ?? 'Not set' }}</td>
                        <td class="px-6 py-4">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm"
                                    onclick="sendReminder('{{ $order->id }}')">
                                Send Reminder
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No pending installments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function sendReminder(orderId) {
    // Add AJAX call to send reminder
    alert('Reminder sent for order #' + orderId);
}
</script>
@endsection