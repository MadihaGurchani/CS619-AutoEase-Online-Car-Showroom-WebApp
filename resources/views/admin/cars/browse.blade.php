<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Cars - {{ $brand->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Browse {{ $brand->name }} Cars</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($cars as $car)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->model }}" class="w-full h-48 object-cover" loading="lazy">
                <div class="p-4">
                    <h2 class="text-xl font-bold">{{ $car->model }}</h2>
                    <p class="text-gray-700">{{ $car->description }}</p>
                    <p class="text-gray-900 font-bold mt-2">Rs {{ number_format($car->price, 2) }}</p>
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4 inline-block">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
// ... existing code ...
