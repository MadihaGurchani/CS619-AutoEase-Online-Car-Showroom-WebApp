@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Order Details</h1>
        <a href="{{ route('customer.logout') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Logout</a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Order Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="order-info">
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Order Number:</span> {{ $order->order_number }}</p>
                    <p><span class="font-medium">Order Date:</span> {{ $order->order_date->format('M d, Y') }}</p>
                    <p><span class="font-medium">Status:</span> 
                        <span class="px-2 py-1 rounded text-white 
                            {{ $order->status === 'pending' ? 'bg-yellow-500' : 
                               ($order->status === 'completed' ? 'bg-green-500' : 'bg-red-500') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="payment-info">
                <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Payment Type:</span> {{ ucfirst($order->payment_type) }}</p>
                    <p><span class="font-medium">Total Amount:</span> PKR {{ number_format($order->total_amount, 2) }}</p>
                    @if($order->payment_type === 'installment')
                    <p><span class="font-medium">Installment Months:</span> {{ $order->installment_months }}</p>
                    <p><span class="font-medium">Payment Status:</span> {{ ucfirst($order->payment_status) }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Delivery Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <p><span class="font-medium">Delivery Type:</span> {{ ucfirst($order->delivery_type) }}</p>
                    <p><span class="font-medium">Delivery City:</span> {{ $order->delivery_city }}</p>
                    <p><span class="font-medium">Delivery Address:</span> {{ $order->delivery_address }}</p>
                    <p><span class="font-medium">Delivery Charge:</span> PKR {{ number_format($order->delivery_charge, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Car Information -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Car Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <p><span class="font-medium">Brand:</span> {{ $order->car->brand->brand }}</p>
                    <p><span class="font-medium">Model:</span> {{ $order->car->model }}</p>
                    <p><span class="font-medium">Year:</span> {{ $order->car->year }}</p>
                    <p><span class="font-medium">Price:</span> PKR {{ number_format($order->car->price, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection