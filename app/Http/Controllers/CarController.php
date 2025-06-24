<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome', 'search']);
        $this->middleware('web');
    }

    public function welcome()
    {
        $brands = Brand::all();
        $cars = Car::with('brand')->get();
        return view('welcome', compact('cars', 'brands'));
    }

    //Display all cars by retrieving all cars from the database along with their associated brand and then passing the data to a view
    public function index()
    {

        //Retrieves all records from the cars table using the Car model
        //The with('brand') method is used for Eager Loading, meaning it fetches related brand data in a single query to avoid the "N+1 query problem."
        //get() executes the query and retrieves all car records as a collection
        $cars = Car::with('brand')->get();  // Fetch cars with their brands

        $brands = Brand::all();  // Fetch all brands separately

//This returns a view named admin.cars.index
        //The compact('cars') function passes the $cars variable to the view making it accessible in the Blade file
        return view('admin.cars.index', compact('cars', 'brands'));
    }

    //Show the form to add a new car
    public function create()
    {
        $brands = Brand::all(); // Fetch all brands
        return view('admin.cars.create', compact('brands'));
    }
//Display the specified resource

//    //Store a new car
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cat_id' => 'required|exists:brands,id',
            'model' => 'nullable|string',
            'year' => 'nullable|integer',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'availability' => 'required|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;

            // Debug information
            \Log::info('Image uploaded: ' . $imagePath);
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully!');
    }
    //Shows Cars to Customer in Dashboard
    public function viewCarDetails(Car $car)
    {
    return view('cars.details', compact('car'));
}
    //Show the form to edit a car
    public function show(Car $car)
    {
        $brands = \App\Models\Brand::all();
        return view('admin.cars.edit', compact('car', 'brands'));
    }
//This edits the car
    public function edit($id)
    {
        $car = Car::findOrFail($id); // Fetch the car by ID
        $brands = Brand::all(); // Fetch all brands for dropdown
        return view('admin.cars.edit', compact('car', 'brands'));
    }

    //Update a car or Adds a new car
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        // Validate request data
        $request->validate([
            'cat_id' => 'required|exists:brands,id',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update car details
        $car->cat_id = $request->cat_id;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->description = $request->description;
        $car->price = $request->price;


        // Handle image upload (if a new image is provided)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $car->image = $imagePath;
        }

        $car->save(); // Save the updated car details

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
    }


    //Delete a car
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }

    public function toggleAvailability(Car $car)
    {
        $car->availability = !$car->availability;
        $car->save();
        return redirect()->back()->with('success', 'Car availability updated!');
    }

    public function salesReport()
    {
        $orders = \App\Models\Order::with('car', 'user')->get();
        $totalSales = $orders->sum('total_amount');
        return view('admin.reports.sales', compact('orders', 'totalSales'));
    }
    //NEW SEARCH FUNCTION
    public function search(Request $request)
    {
        $brands = Brand::all();
        $query = Car::query();
    
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
    
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }
    
        $cars = $query->with('brand')->where('availability', true)->get();
    
        return view('customer.search-cars', compact('cars', 'brands'));
    }
}
