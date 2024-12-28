<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return CartItem::with(['user', 'product'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::create($validated);

        return response()->json($cartItem, 201);
    }

    public function show(CartItem $cartItem)
    {
        return $cartItem->load(['user', 'product']);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $cartItem->update($validated);

        return $cartItem;
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json(null, 204);
    }
}

