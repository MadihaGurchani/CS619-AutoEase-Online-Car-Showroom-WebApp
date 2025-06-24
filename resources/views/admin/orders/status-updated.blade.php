@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Status Updated Successfully!</h2>
        <p class="text-gray-600 mb-6">The order status has been updated and all relevant parties have been notified.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('admin.orders.manage') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Orders
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection