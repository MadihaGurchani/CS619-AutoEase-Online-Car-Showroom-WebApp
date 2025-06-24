@extends('admin.dashboard')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Add New Car</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="cat_id">Brand</label>
                    <select name="cat_id" id="cat_id" required>
                       @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                        @endforeach
                 </select>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model:</label>
                        <input type="text" name="model" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year:</label>
                        <input type="number" name="year" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability:</label>
                        <select name="availability" id="availability" class="form-control" required>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Car</button>
                </form>
            </div>
        </div>
    </div>
@endsection
