@extends('admin.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Manage Cars</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Car</a>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto text-left">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Brand</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Model</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Year</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Price</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Availability</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Edit</th>
            <th class="px-6 py-3 text-sm font-medium text-gray-700">Delete</th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-800">
        @foreach ($cars as $car)
            <tr class="border-b">
                <td class="px-6 py-4">{{ $car->brand ? $car->brand->brand : 'No Brand' }}</td>
                <td class="px-6 py-4">{{ $car->model }}</td>
                <td class="px-6 py-4">{{ $car->year }}</td>
                <td class="px-6 py-4">Rs {{ number_format($car->price, 2) }}</td>

                <td class="px-6 py-4">
                    <span class="{{ $car->availability ? 'text-green-500' : 'text-red-500' }}">
                        {{ $car->availability ? 'Available' : 'Unavailable' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="text-blue-500 hover:underline">Edit</a>
                </td>
                <td class="px-5 py-4">
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
@endsection
