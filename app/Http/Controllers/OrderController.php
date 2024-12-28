<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return $order->load('user');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'total_price' => 'sometimes|numeric',
        ]);

        $order->update($validated);

        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null, 204);
    }
}

