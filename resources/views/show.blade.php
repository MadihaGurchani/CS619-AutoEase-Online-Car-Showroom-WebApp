@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>{{ $car->brand }} {{ $car->model }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid" alt="{{ $car->brand }} {{ $car->model }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4>Price: ${{ number_format($car->price, 2) }}</h4>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                        <p><strong>Description:</strong> {{ $car->description }}</p>

                        @if($car->availability)
                            <form action="{{ route('orders.store', $car) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="debit_card">Debit Card</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Purchase Car</button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                This car is currently not available for purchase.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
