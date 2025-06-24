@extends('admin.layouts.app')

@section('title', 'Installment Management')

@section('content')
<div class="container">
    <h2>Installment Details for Order #{{ $order->id }}</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <p>Total Amount: ${{ number_format($order->total_amount, 2) }}</p>
            <p>Customer: {{ $order->user->name }}</p>
            <p>Order Date: {{ $order->created_at->format('Y-m-d') }}</p>
            <p>Status: {{ ucfirst($order->status) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Installment Schedule</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Installment #</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($installments as $payment)
                        <tr>
                            <td>{{ $payment['installment_number'] }}</td>
                            <td>${{ number_format($payment['amount'], 2) }}</td>
                            <td>{{ $payment['due_date'] }}</td>
                            <td>
                                <span class="badge bg-{{ $payment['status'] === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($payment['status']) }}
                                </span>
                            </td>
                            <td>{{ isset($payment['payment_date']) ? $payment['payment_date'] : 'Not paid' }}</td>
                            <td>
                                @if($payment['status'] !== 'paid')
                                <form action="{{ route('admin.orders.updateInstallment', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="installment_number" value="{{ $payment['installment_number'] }}">
                                    <button type="submit" class="btn btn-sm btn-success">Mark as Paid</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection