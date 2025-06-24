<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use DateTime;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'delivery_city' => 'required|string',
            'delivery_type' => 'required|in:pickup,doorstep',
            'payment_type' => 'required|in:full,installment',
            'installment_months' => 'required_if:payment_type,installment'
        ]);
    
        // Get the car with its brand relationship
        $car = Car::with('brand')->findOrFail($validated['car_id']);
        
        // Debug information
        \Log::info('Car Details:', [
            'car_id' => $car->id,
            'brand_id' => $car->brand_id,
            'brand' => $car->brand
        ]);
        
        // Create the order with all necessary details
        $order = new Order([
            'user_id' => auth()->id(),
            'car_id' => $validated['car_id'],
            'category_id' => $car->brand->id,
            'order_number' => 'ORD-' . time(),
            'order_date' => now(),
            'delivery_address' => auth()->user()->address ?? 'Default Address',
            'delivery_city' => $validated['delivery_city'],
            'delivery_type' => $validated['delivery_type'],
            'payment_type' => $validated['payment_type'],
            'installment_months' => $validated['installment_months'] ?? null,
            'delivery_charge' => $validated['delivery_type'] === 'doorstep' ? 5000 : 0,
            'total_amount' => $car->price + ($validated['delivery_type'] === 'doorstep' ? 5000 : 0),
            'status' => 'pending',
            'delivery_status' => 'processing',
            'estimated_delivery_date' => now()->addDays(7)
        ]);
    
        // Calculate installment details if payment type is installment
        if ($validated['payment_type'] === 'installment') {
            $order->installment_details = $order->calculateInstallments();
            $order->next_payment_date = now()->addMonth();
        }
    
        // Save the order
        $order->save();
    
        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
    
        return view('customer.orders.show', compact('order'));
    }

    
    public function adminIndex()
    {
        $orders = Order::with(['user', 'car.brand'])
            ->latest()
            ->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow(Order $order)
    {
        $order->load(['user', 'car.brand']);
        return view('admin.orders.show', compact('order'));
    }

    public function salesReport()
    {
        $orders = Order::with(['user', 'car'])
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->get();
    
        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        
        // Get payment method statistics
        $paymentStats = Order::select('payment_type', DB::raw('count(*) as count'))
            ->groupBy('payment_type')
            ->get();
    
        return view('admin.sales-report', compact('orders', 'totalSales', 'totalOrders', 'paymentStats'));
    }

    public function manageOrders()
    {
        $orders = Order::with(['user', 'car'])
            ->latest()
            ->paginate(10);
        
        $deliveryCharge = 5000; // Default value, you can adjust this
        
        return view('admin.orders.manage', compact('orders', 'deliveryCharge'));
    }

    public function updateDeliveryCharge(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'delivery_charge'],
            ['value' => $request->delivery_charge]
        );
        
        return back()->with('success', 'Delivery charge updated successfully.');
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:' . implode(',', Order::STATUSES)
        ]);
    
        $order->status = $validatedData['status'];
        $order->save();
    
        return redirect()->route('admin.orders.status-updated')
                        ->with('success', 'Order status updated successfully');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,partially_paid,paid'
        ]);
    
        $order->update([
            'payment_status' => $request->payment_status,
            'last_payment_date' => now()
        ]);
    
        return back()->with('success', 'Payment status updated successfully.');
    }

    public function trackDelivery(Order $order)
    {
        $deliveryStatuses = [
            'pending' => 'Order Received',
            'processing' => 'Processing at Showroom',
            'shipped' => 'In Transit',
            'completed' => 'Delivered'
        ];
    
        return view('admin.orders.track-delivery', compact('order', 'deliveryStatuses'));
    }

    /* Commenting out installment-related methods for now
    public function checkInstallments()
    {
        try {
            $dueInstallments = Order::with(['user', 'installmentPayments'])
                ->where('payment_type', 'installment')
                ->where('status', '!=', 'cancelled')
                ->where(function($query) {
                    $query->whereNull('payment_status')
                        ->orWhere('payment_status', '!=', 'paid');
                })
                ->get();
    
            return view('admin.orders.installment-reminders', compact('dueInstallments'));
        } catch (\Exception $e) {
            \Log::error('Error in checkInstallments: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading installment reminders.');
        }
    }

    public function manageInstallments(Order $order)
    {
        $installmentPayments = $order->installmentPayments()
            ->orderBy('payment_date', 'desc')
            ->get();
        
        return view('admin.orders.installments', compact('order', 'installmentPayments'));
    }

    public function updateInstallment(Request $request, Order $order)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date'
        ]);
    
        $order->installmentPayments()->create([
            'amount' => $request->amount_paid,
            'payment_date' => $request->payment_date
        ]);
    
        return back()->with('success', 'Installment payment recorded successfully.');
    }
    */
    public function cancel(Order $order)
    {
        // Check if user owns this order
        if (auth()->id() !== $order->user_id) {
            return back()->with('error', 'Unauthorized action.');
        }
    
        // Check if order is within 24 hours
        $orderTime = new DateTime($order->created_at);
        $now = new DateTime();
        $diff = $now->diff($orderTime);
        $hoursElapsed = $diff->h + ($diff->days * 24);
    
        if ($hoursElapsed > 24) {
            return back()->with('error', 'Orders can only be cancelled within 24 hours of placement.');
        }
    
        $order->status = 'cancelled';
        $order->save();
    
        return back()->with('success', 'Order cancelled successfully.');
    }
    public function updateStatus(Order $order, Request $request)
    {
        $order->updateDeliveryStatus($request->status);
        return redirect()->route('dashboard')->with('success', 'Status changed successfully');
    }
}

