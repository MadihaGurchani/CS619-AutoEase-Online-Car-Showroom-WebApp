@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Sales Report</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5>Summary</h5>
            <p>Total Sales: ${{ number_format($totalSales, 2) }}</p>
            <p>Total Orders: {{ $totalOrders }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Sales by Category</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Orders</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesByCategory as $categorySales)
                    <tr>
                        <td>{{ $categorySales['category'] }}</td>
                        <td>{{ $categorySales['count'] }}</td>
                        <td>${{ number_format($categorySales['total'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Recent Sales</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Category</th>
                        <th>Car</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->category->brand }}</td>
                        <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
