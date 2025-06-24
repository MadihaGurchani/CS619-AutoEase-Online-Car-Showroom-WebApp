@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Delivery Tracking - Order #{{ $order->order_number }}</h2>
        
        <div class="mb-6">
            <div class="flex items-center">
                @foreach($deliveryStatuses as $status => $label)
                    <div class="flex-1 text-center">
                        <div class="w-10 h-10 mx-auto rounded-full {{ $order->status === $status ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                            <span class="text-white">✓</span>
                        </div>
                        <p class="mt-2 text-sm">{{ $label }}</p>
                    </div>
                    @if(!$loop->last)
                        <div class="flex-1 h-1 bg-gray-300"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold mb-2">Delivery Details</h3>
            <p>Delivery Type: {{ ucfirst($order->delivery_type) }}</p>
            <p>Delivery Address: {{ $order->delivery_address }}</p>
            <p>City: {{ $order->delivery_city }}</p>
        </div>
    </div>
</div>
@endsection