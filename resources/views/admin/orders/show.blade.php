@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h4>Order Details #{{ $order->order_number }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Customer Information</h5>
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Car Information</h5>
                    <p><strong>Brand:</strong> {{ $order->car->brand->brand }}</p>
                    <p><strong>Model:</strong> {{ $order->car->model }}</p>
                    <p><strong>Year:</strong> {{ $order->car->year }}</p>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Order Information</h5>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'cancelled' ? 'danger' : 'success') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Delivery Type:</strong> {{ ucfirst($order->delivery_type) }}</p>
                    <p><strong>Delivery City:</strong> {{ $order->delivery_city }}</p>
                    <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Payment Information</h5>
                    <p><strong>Payment Type:</strong> {{ ucfirst($order->payment_type) }}</p>
                    @if($order->payment_type === 'installment')
                        <p><strong>Installment Plan:</strong> {{ $order->installment_months }} months</p>
                        <p><strong>Monthly Payment:</strong> PKR {{ number_format($order->total_amount / $order->installment_months, 2) }}</p>
                    @endif
                    <p><strong>Delivery Charge:</strong> PKR {{ number_format($order->delivery_charge) }}</p>
                    <p><strong>Total Amount:</strong> PKR {{ number_format($order->total_amount) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection