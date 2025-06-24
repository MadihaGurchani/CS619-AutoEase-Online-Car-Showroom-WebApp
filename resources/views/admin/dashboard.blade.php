<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Car Showroom</title>
    <!-- Use a single CDN link instead of multiple -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Remove Bootstrap if not needed -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
<div class="flex">

    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-4">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
        <ul>
            <li class="mb-2">
                <a href="{{ route('admin.cars.index') }}" class="block p-2 hover:bg-gray-700">Manage Cars</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.orders.manage') }}" class="block p-2 hover:bg-gray-700">Order Management</a>
            </li>
            <li class="mb-2">
            <a href="{{ route('admin.orders.index') }}" class="block p-2 hover:bg-gray-700">
              Customer Orders History
            </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.sales-report') }}" class="block p-2 hover:bg-gray-700">Sales Report</a>
            </li>
            <li class="mb-2">
                <a  href="{{ route('admin.reports.index') }}"class="block p-2 hover:bg-gray-700">Total Reports</a>
            </li>
        </ul>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1>WELCOME</h1>
        @yield('content')

        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit"
        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm transition duration-200">
        Logout
    </button>
</form>


    </main>
</div>

</body>
</html>
