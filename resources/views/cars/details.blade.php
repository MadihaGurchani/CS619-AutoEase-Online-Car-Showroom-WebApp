@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid" alt="{{ $car->model }}">
                    @else
                        <div class="bg-secondary text-white p-5 text-center">No Image Available</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h2>{{ $car->brand->brand }} {{ $car->model }}</h2>
                    <p class="text-muted">Year: {{ $car->year }}</p>
                    <h4 class="text-primary">Rs {{ number_format($car->price, 2) }}</h4>
                    <p>{{ $car->description }}</p>
                    @if($car->availability)
                        <!-- Replace the existing Place Order button with this code -->
                        @if(Auth::check())
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyModal{{ $car->id }}">
                                Place Order
                            </button>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Register to Place Order
                            </a>
                        @endif
                    @else
                        <button class="btn btn-secondary" disabled>Not Available</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($car->availability)
    <!-- Buy Now Modal -->
    <div class="modal fade" id="buyModal{{ $car->id }}" tabindex="-1" aria-labelledby="buyModalLabel{{ $car->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel{{ $car->id }}">Place Order - {{ $car->brand->brand }} {{ $car->model }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customer.orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <div class="modal-body">
                        <!-- Delivery Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Delivery Information</h6>
                            <div class="mb-3">
                                <label for="delivery_city" class="form-label">Delivery City</label>
                                <select name="delivery_city" id="delivery_city" class="form-control" required>
                                    <option value="">Select City</option>
                                    <option value="Lahore">Lahore</option>
                                    <option value="Karachi">Karachi</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Rawalpindi">Rawalpindi</option>
                                    <option value="Faisalabad">Faisalabad</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="delivery_type" class="form-label">Delivery Type</label>
                                <select name="delivery_type" id="delivery_type" class="form-control" required>
                                    <option value="pickup">Pickup from Showroom (Free)</option>
                                    <option value="doorstep">Doorstep Delivery (Rs. 5,000)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="delivery_address" class="form-label">Delivery Address</label>
                                <textarea name="delivery_address" id="delivery_address" class="form-control" rows="3" required>{{ auth()->user()->address ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Payment Information</h6>
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control" required onchange="toggleInstallmentMonths()">
                                    <option value="full">Full Payment</option>
                                    <option value="installment">Installment Plan</option>
                                </select>
                            </div>
                            <div id="installment_months_div" class="mb-3" style="display: none;">
                                <label for="installment_months" class="form-label">Installment Period</label>
                                <select name="installment_months" id="installment_months" class="form-control">
                                    <option value="12">12 Months</option>
                                    <option value="24">24 Months</option>
                                    <option value="36">36 Months</option>
                                </select>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="border p-3 rounded">
                            <h6 class="mb-3">Order Summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Car Price:</span>
                                <span>Rs. {{ number_format($car->price, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" id="delivery_charge_row" style="display: none;">
                                <span>Delivery Charge:</span>
                                <span>Rs. 5,000.00</span>
                            </div>
                            <div class="d-flex justify-content-between font-weight-bold">
                                <strong>Total Amount:</strong>
                                <strong id="total_amount">Rs. {{ number_format($car->price, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript code at the bottom of your file -->
    <script>
    function toggleInstallmentMonths() {
        const paymentType = document.getElementById('payment_type').value;
        const installmentMonthsDiv = document.getElementById('installment_months_div');
        installmentMonthsDiv.style.display = paymentType === 'installment' ? 'block' : 'none';
    }

    document.getElementById('delivery_type').addEventListener('change', function() {
        const deliveryChargeRow = document.getElementById('delivery_charge_row');
        const totalAmountSpan = document.getElementById('total_amount');
        const basePrice = {{ $car->price }};
        
        if (this.value === 'doorstep') {
            deliveryChargeRow.style.display = 'flex';
            totalAmountSpan.textContent = 'Rs. ' + (basePrice + 5000).toLocaleString('en-US', {minimumFractionDigits: 2});
        } else {
            deliveryChargeRow.style.display = 'none';
            totalAmountSpan.textContent = 'Rs. ' + basePrice.toLocaleString('en-US', {minimumFractionDigits: 2});
        }
    });
    </script>
@endif
@endsection