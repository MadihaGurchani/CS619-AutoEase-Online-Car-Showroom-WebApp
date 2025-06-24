@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Search Available Cars</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('customer.search-cars') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="brand_id" class="form-label">Search by Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value="">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="model" class="form-label">Search by Model</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Enter car model" value="{{ request('model') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @if(isset($cars) && $cars->count() > 0)
            @foreach($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($car->image)
                            <img src="{{ asset('/' . $car->image) }}" class="card-img-top" alt="{{ $car->model }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand->brand }} {{ $car->model }}</h5>
                            <p class="card-text">{{ $car->description }}</p>
                            <p class="card-text"><strong>Price:</strong> Rs {{ number_format($car->price, 2) }}</p>
                            <p class="card-text"><strong>Year:</strong> {{ $car->year }}</p>
                            @if($car->availability)
                                <a href="{{ route('cars.details', $car->id) }}" class="btn btn-primary">View Details</a>
                            @else
                                <button class="btn btn-secondary" disabled>Not Available</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="text-center">No cars found matching your criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection