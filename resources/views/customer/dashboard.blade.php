<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - AutoEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">AutoEase</a>
            <div class="navbar-nav ms-auto">
                <a href="#orders-section" class="nav-link text-white">My Orders</a>
                <a href="#payment-history-card" class="nav-link text-white">Payment History</a>
                <a href="#order-tracking-section" class="nav-link text-white">Order Tracking</a>
                <a href="#payment-reminders-section" class="nav-link text-white">Payment Reminders</a>
                <a href="#vouchers-section" class="nav-link text-white">My Vouchers</a>
                <a href="{{ route('customer.search-cars') }}" class="nav-link text-white">Search Available Cars</a>
                <span class="nav-item nav-link text-white">Welcome, {{ auth()->user()->name }}</span>
                <a href="{{ route('customer.logout') }}" class="nav-link">Logout</a>
            </div>
        </div>
    </nav>


        <!-- Orders and Payments Section -->
        <div class="row mb-4" id="orders-section">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">My Orders</h5>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->orders && auth()->user()->orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Car</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(auth()->user()->orders as $order)
                                            <tr>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->car->brand->brand }} {{ $order->car->model }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center mb-0">No orders found.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" id="payment-history-card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Payment History</h5>
                    </div>
                    <div class="card-body">
                        @if($orders && $orders->whereNotNull('last_payment_date')->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(auth()->user()->orders->where('status', 'completed') as $order)
                                            <tr>
                                                <td>{{ $order->order_number }}</td>
                                                <td>Rs {{ number_format($order->car->price, 2) }}</td>
                                                <td>
                                                    <span class="badge bg-success">Completed</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center mb-0">No payment history found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Tracking Section -->
        <div class="row mb-4" id="order-tracking-section">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Order Tracking</h5>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->orders && auth()->user()->orders->where('status', '!=', 'cancelled')->where('status', '!=', 'completed')->count() > 0)
                            @foreach(auth()->user()->orders->where('status', '!=', 'cancelled')->where('status', '!=', 'completed') as $order)
                                <div class="mb-4">
                                    <h6>Order #{{ $order->order_number }} - {{ $order->car->brand->brand }} {{ $order->car->model }}</h6>
                                    <div class="progress mb-2" style="height: 25px;">
                                        @php
                                            $progressPercentage = 0;
                                            $statusText = '';
                                            
                                            switch($order->status) {
                                                case 'pending':
                                                    $progressPercentage = 25;
                                                    $statusText = 'Order Confirmed';
                                                    break;
                                                case 'processing':
                                                    $progressPercentage = 50;
                                                    $statusText = 'Processing';
                                                    break;
                                                case 'shipped':
                                                    $progressPercentage = 75;
                                                    $statusText = 'Shipped';
                                                    break;
                                                case 'delivered':
                                                    $progressPercentage = 100;
                                                    $statusText = 'Delivered';
                                                    break;
                                            }
                                        @endphp
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                             role="progressbar" 
                                             style="width: {{ $progressPercentage }}%;" 
                                             aria-valuenow="{{ $progressPercentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                            {{ $statusText }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between small text-muted">
                                        <span>Order Confirmed</span>
                                        <span>Processing</span>
                                        <span>Shipped</span>
                                        <span>Delivered</span>
                                    </div>
                                    <div class="mt-2">
                                        <p><strong>Current Status:</strong> {{ ucfirst($order->status) }}</p>
                                        <p><strong>Estimated Delivery:</strong> 
                                            @if($order->delivery_date)
                                                {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M, Y') }}
                                            @else
                                                To be determined
                                            @endif
                                        </p>
                                        <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center mb-0">No active orders to track.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Reminder Section -->
        <div class="row mb-4" id="payment-reminders-section">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Payment Reminders</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $installmentOrders = auth()->user()->orders->where('payment_type', 'installment')
                                                                      ->where('status', '!=', 'cancelled')
                                                                      ->where('status', '!=', 'completed');
                        @endphp
                        
                        @if($installmentOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Car</th>
                                            <th>Next Payment</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($installmentOrders as $order)
                                            @php
                                                // Calculate next payment date based on last payment
                                                $lastPaymentDate = $order->last_payment_date ? \Carbon\Carbon::parse($order->last_payment_date) : \Carbon\Carbon::parse($order->created_at);
                                                $nextPaymentDate = $lastPaymentDate->addMonth();
                                                $daysRemaining = now()->diffInDays($nextPaymentDate, false);
                                                
                                                // Calculate installment amount
                                                $totalPrice = $order->car->price;
                                                if ($order->delivery_type == 'doorstep') {
                                                    $deliveryCharges = [
                                                        'Karachi' => 5000,
                                                        'Lahore' => 10000,
                                                        'Islamabad' => 15000,
                                                        'Peshawar' => 20000,
                                                        'Quetta' => 25000
                                                    ];
                                                    $totalPrice += $deliveryCharges[$order->delivery_city] ?? 0;
                                                }
                                                
                                                $installmentAmount = $totalPrice / $order->installment_months;
                                            @endphp
                                            <tr class="{{ $daysRemaining <= 5 ? 'table-danger' : ($daysRemaining <= 10 ? 'table-warning' : '') }}">
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->car->brand->brand }} {{ $order->car->model }}</td>
                                                <td>
                                                    {{ $nextPaymentDate->format('d M, Y') }}
                                                    @if($daysRemaining <= 5)
                                                        <span class="badge bg-danger">Due Soon!</span>
                                                    @elseif($daysRemaining <= 10)
                                                        <span class="badge bg-warning text-dark">Upcoming</span>
                                                    @endif
                                                </td>
                                                <td>Rs {{ number_format($installmentAmount, 2) }}</td>
                                                <td>
                                                    @if($daysRemaining < 0)
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @else
                                                        <span class="badge bg-info">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Pay Now</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center mb-0">No installment payments due.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
              
                <!-- Buy Now Modals -->
                @foreach($cars as $car)
                    <div class="modal fade" id="buyModal{{ $car->id }}" tabindex="-1" aria-labelledby="buyModalLabel{{ $car->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buyModalLabel{{ $car->id }}">Place Order - {{ $car->brand->brand }} {{ $car->model }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('customer.orders.store') }}" method="POST" id="orderForm{{ $car->id }}">
                                    @csrf
                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid rounded" alt="{{ $car->model }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h4>Car Details</h4>
                                                <p><strong>Brand:</strong> {{ $car->brand->brand }}</p>
                                                <p><strong>Model:</strong> {{ $car->model }}</p>
                                                <p><strong>Base Price:</strong> PKR {{ number_format($car->price, 2) }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Payment Type</label>
                                            <select name="payment_type" class="form-select" id="paymentType{{ $car->id }}" onchange="toggleInstallmentPlan({{ $car->id }})">
                                                <option value="full">Full Payment</option>
                                                <option value="installment">Installment Plan</option>
                                            </select>
                                        </div>

                                        <div id="installmentPlan{{ $car->id }}" style="display: none;" class="mb-3">
                                            <label class="form-label">Installment Duration</label>
                                            <select name="installment_months" class="form-select" onchange="calculateInstallments({{ $car->id }})">
                                                <option value="3">3 Months</option>
                                                <option value="6">6 Months</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Delivery Type</label>
                                            <select name="delivery_type" class="form-select" id="deliveryType{{ $car->id }}" onchange="toggleDeliveryAddress({{ $car->id }})">
                                                <option value="pickup">Pick up from showroom</option>
                                                <option value="doorstep">Doorstep Delivery</option>
                                            </select>
                                        </div>

                                        <div id="deliveryDetails{{ $car->id }}" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Delivery City</label>
                                                <select name="delivery_city" class="form-select" onchange="updateDeliveryCharge({{ $car->id }})">
                                                    <option value="Karachi">Karachi (PKR 5,000)</option>
                                                    <option value="Lahore">Lahore (PKR 10,000)</option>
                                                    <option value="Islamabad">Islamabad (PKR 15,000)</option>
                                                    <option value="Peshawar">Peshawar (PKR 20,000)</option>
                                                    <option value="Quetta">Quetta (PKR 25,000)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Delivery Address</label>
                                                <textarea name="delivery_address" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h6>Order Summary</h6>
                                            <p>Car Price: PKR {{ number_format($car->price) }}</p>
                                            <p id="deliveryCharge{{ $car->id }}">Delivery Charge: PKR 0</p>
                                            <p id="installmentInfo{{ $car->id }}" style="display: none;">Monthly Installment: PKR 0</p>
                                            <p id="totalAmount{{ $car->id }}" class="fw-bold">Total Amount: PKR {{ number_format($car->price) }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Place Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Order Confirmation Modal -->
                    <div class="modal fade" id="orderConfirmationModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Order Placed Successfully! Now Click on My Vouchers on the top on My Dashboardto PRINT your voucher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-success">
                                        <h6>Thank you for your order!</h6>
                                        <p>Your order has been placed successfully. You can view the order details in your dashboard.</p>
                                        <p><strong>Note:</strong> You have the option to cancel this order within 24 hours of booking.</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            
       
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<script>
function toggleInstallmentPlan(carId) {
    const paymentType = document.getElementById(`paymentType${carId}`).value;
    const installmentPlan = document.getElementById(`installmentPlan${carId}`);
    const installmentInfo = document.getElementById(`installmentInfo${carId}`);
    
    installmentPlan.style.display = paymentType === 'installment' ? 'block' : 'none';
    installmentInfo.style.display = paymentType === 'installment' ? 'block' : 'none';
    calculateInstallments(carId);
}

function toggleDeliveryAddress(carId) {
    const deliveryType = document.getElementById(`deliveryType${carId}`).value;
    const deliveryDetails = document.getElementById(`deliveryDetails${carId}`);
    deliveryDetails.style.display = deliveryType === 'doorstep' ? 'block' : 'none';
    updateDeliveryCharge(carId);
}

function updateDeliveryCharge(carId) {
    const deliveryType = document.getElementById(`deliveryType${carId}`).value;
    let deliveryCharge = 0;
    let totalAmount = parseFloat({{ $car->price }});

    if (deliveryType === 'doorstep') {
        const deliveryCity = document.querySelector(`#deliveryDetails${carId} select[name="delivery_city"]`).value;
        const charges = {
            'Karachi': 5000,
            'Lahore': 10000,
            'Islamabad': 15000,
            'Peshawar': 20000,
            'Quetta': 25000
        };
        deliveryCharge = charges[deliveryCity] || 0;
        totalAmount += deliveryCharge;
    }

    document.getElementById(`deliveryCharge${carId}`).textContent = `Delivery Charge: PKR ${deliveryCharge.toLocaleString()}`;
    document.getElementById(`totalAmount${carId}`).textContent = `Total Amount: PKR ${totalAmount.toLocaleString()}`;

    const paymentType = document.getElementById(`paymentType${carId}`).value;
    if (paymentType === 'installment') {
        calculateInstallments(carId);
    }
}
</script>


        <!-- Update the Vouchers Section to include cancel option -->
        <div class="mb-3" id="vouchers-section">
            <h6>My Orders</h6>
            @if($orders && $orders->where('status', '!=', 'cancelled')->count() > 0)
                <div class="list-group">
                    @foreach($orders->where('status', '!=', 'cancelled') as $order)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6>{{ $order->car->brand->brand }} {{ $order->car->model }}</h6>
                                    <small>Order Date: {{ $order->created_at->format('d/m/Y') }}</small>
                                    @php
                                        $orderTime = new DateTime($order->created_at);
                                        $now = new DateTime();
                                        $diff = $now->diff($orderTime);
                                        $hoursElapsed = $diff->h + ($diff->days * 24);
                                    @endphp
                                </div>
                                <div>
                                    @if($hoursElapsed <= 24)
                                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?')">
                                            Cancel Order
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ route('generate.voucher', $order->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                        View Voucher
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No orders available.</p>
            @endif
        </div>
</body>
</html>

