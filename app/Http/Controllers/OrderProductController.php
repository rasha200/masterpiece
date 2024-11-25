<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_detail;
use App\Models\store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('userSide.checkout.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Retrieve the cart items from the cookie
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate the total price of items in the cart
        $orderTotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $orderStatus = 'Pending';
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }

        // Create the order
        $order = Order::create([
            'order_total_price' => $orderTotal,
            'order_status' => $orderStatus,
            'user_id' => $user->id,
        ]);

        // Insert each cart item as an order detail
        foreach ($cart as $item) {
            order_detail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'], // Ensure product_id is included in cart data
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
                'payment_method'=>'Cash on Delivery'
            ]);
        }

        // Clear the cart cookie
        Cookie::queue(Cookie::forget('cart'));

        return redirect()->route('checkoutView')->with('success', 'Order placed successfully!');
    }


/**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the order with the related store, user, and address
        $order = Order::with('store', 'user', 'address')->find($id);

        // Check if the order exists
        if (!$order) {
            abort(404, 'Order not found');
        }
        $order_details = order_detail::with('product')->where('order_id', $id)->get();

        return view('dashboard.order.show', compact('order' ,'order_details'));
    }



    public function edit(string $id)
    {
        // Fetch the order without relying on relationships
        $order = Order::with(['user', 'store', 'address'])->findOrFail($id);

        // Fetch order details separately
        $orderDetails = order_detail::where('order_id', $id)->with('product')->get();

        // Fetch users and stores for the dropdowns
        $users = User::all(); // Assuming you have a User model
        $stores = Store::all(); // Assuming you have a Store model

        return view('dashboard.order.edit', compact('order', 'orderDetails', 'users', 'stores'));
    }



    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update main order details
        $order->update([
            'user_id' => $request->user_id,
            'store_id' => $request->store_id,
            'order_status' => $request->status,
            'address' => $request->address,
        ]);

        // Update order items
        foreach ($request->items as $itemId => $data) {
            $orderDetail = order_detail::findOrFail($itemId);
            $orderDetail->update(['quantity' => $data['quantity']]);
        }

        return redirect()->route('order.index')->with('success', 'Order updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = order::findOrFail($id);
        $order->delete();
        return redirect()->route('dashboard.order.index')->with('success', 'Order deleted successfully.');
    }
    public function indexDashboard()
    {
        // Get the store ID for the authenticated user, if they have an associated store
        $userStoreId = Auth::user()->store ? Auth::user()->store->id : null;

        // Fetch orders with eager loading based on user role
        if (Auth::user()->role == 'admin') {
            $orders = Order::with('user', 'store', 'address')->get();
        } else {
            $orders = Order::where('store_id', $userStoreId)
                ->with('user', 'store', 'address')
                ->get();
        }
        // Calculate order statistics
        $orderStats = [
            'pendingPayment' => Order::where('payment_status', 'pending')->count(),
            'completed' => Order::where('payment_status', 'paid')->count(),
            'refunded' => Order::where('payment_status', 'cancelled')->count(),
            'failed' => Order::where('payment_status', 'failed')->count(),
        ];

        return view('dashboard.order.index', compact('orders' ,'orderStats'));
    }

}