@extends('admin.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ isset($car) ? 'Edit Car' : 'Add New Car' }}</h1>
        <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="cat_id">Brand:</label>
            <select name="cat_id">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $car->cat_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>

            <label for="model">Model:</label>
            <input type="text" name="model" value="{{ old('model', $car->model) }}" required>

            <label for="year">Year:</label>
            <input type="number" name="year" value="{{ old('year', $car->year) }}" required>

            <label for="description">Description:</label>
            <textarea name="description" required>{{ old('description', $car->description) }}</textarea>

            <label for="price">Price:</label>
            <input type="text" name="price" value="{{ old('price', $car->price) }}" required>

            <label for="image">Image:</label>
            <input type="file" name="image">

            <button type="submit">Update Car</button>
        </form>
    </div>
@endsection
