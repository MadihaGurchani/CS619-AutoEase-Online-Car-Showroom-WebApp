<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $brands = Brand::all();
        $cars = Car::with('brand')
                   ->orderBy('created_at', 'desc')
                   ->paginate(12);  // Show 12 cars per page
        $orders = Order::where('user_id', $user->id)
                      ->with(['car.brand'])
                      ->latest()
                      ->get();

        return view('customer.dashboard', compact('brands', 'cars', 'orders'));
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $brands = Brand::all();
        $query = Car::query()->with('brand');

        if ($request->filled('cat_id')) {
            $query->where('cat_id', $request->cat_id);
        }

        if ($request->filled('model')) {
            $query->where('model', 'LIKE', '%' . $request->model . '%');
        }

        $cars = $query->get();
        $orders = Order::where('user_id', $user->id)
                      ->with(['car.brand'])
                      ->latest()
                      ->get();

        return view('customer.dashboard', compact('brands', 'cars', 'orders'));
    }

    public function show(Car $car)
    {
        return view('customer.cars.show', compact('car'));
    }
}