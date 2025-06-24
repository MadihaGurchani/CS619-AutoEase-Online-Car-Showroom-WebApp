<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - AutoEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/styles.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Search Results</h2>
        
        <div class="search-bar mb-4">
            <form action="{{ url('/search') }}" method="GET" class="search-bar">
                @csrf
                <select name="cat_id" class="form-control">
                    <option value="">Search by Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('cat_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->brand }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="model" placeholder="Search by Model" value="{{ request('model') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
            </form>
        </div>

        <div class="row">
            @if($cars->count() > 0)
                @foreach($cars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($car->image)
                                <img src="{{ asset('images/' . $car->image) }}" class="card-img-top" alt="{{ $car->model }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $car->model }}</h5>
                                <p class="card-text">Brand: {{ $car->brand->brand }}</p>
                                <p class="card-text">Year: {{ $car->year }}</p>
                                <p class="card-text">Price: PKR {{ number_format($car->price) }}</p>
                                <p class="card-text">{{ $car->description }}</p>
                                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No cars found matching your search criteria.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
