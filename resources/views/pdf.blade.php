<!DOCTYPE html>
<html>
<head>
    <title>Order Voucher</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        .text-center { text-align: center; }
        .mt-4 { margin-top: 1.5rem; }
        .mb-3 { margin-bottom: 1rem; }
        hr { border: 1px solid #ddd; }
        .installment-schedule {
            margin: 1rem 0;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h2>AutoEase Car Dealership</h2>
            <h3>Order Voucher</h3>
            <hr>
        </div>

        <div class="mt-4">
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Customer Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Car:</strong> {{ $order->car->brand->brand }} {{ $order->car->model }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Payment Type:</strong> {{ ucfirst($order->payment_type) }}</p>
            <p><strong>Delivery Type:</strong> {{ ucfirst($order->delivery_type) }}</p>
            <p><strong>AutoEase.com IBAN: PK11 UNIL 5001 0517 5407 3249 31</strong></p>
            <p><strong>Acceptable Banks:</strong>
                <ul>
                    <li>United Bank Limited</li>
                    <li>Habib Bank Limited</li>
                    <li>Standard Chartered</li>
                    <li>Allied Bank</li>
                </ul>


            @if($order->delivery_type === 'doorstep')
            <div class="mb-3">
                <p><strong>Delivery Details:</strong></p>
                <p>City: {{ $order->delivery_city }}</p>
                <p>Address: {{ $order->delivery_address }}</p>
                <p>Delivery Charge: PKR {{ number_format($order->delivery_charge) }}</p>
            </div>
            @endif

            @if($order->payment_type === 'installment')
            <div class="installment-schedule">
                <h4>Installment Schedule</h4>
                @php
                    $totalAmount = $order->car->price + ($order->delivery_charge ?? 0);
                    $monthlyAmount = $totalAmount / $order->installment_months;
                    $startDate = $order->created_at;
                @endphp

                @for($i = 1; $i <= $order->installment_months; $i++)
                    <p>
                        <strong>Installment {{ $i }}:</strong><br>
                        Amount: PKR {{ number_format($monthlyAmount, 2) }}<br>
                        Due Date: {{ $startDate->copy()->addMonths($i)->format('d/m/Y') }}
                    </p>
                @endfor
            </div>
            @endif

            <div class="mt-4">
                <p><strong>Total Amount:</strong> PKR {{ number_format($order->car->price + ($order->delivery_charge ?? 0)) }}</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <p>Thank you for choosing AutoEase!</p>
            <p>For any queries, please contact our customer support.</p>
        </div>
    </div>
</body>
</html>