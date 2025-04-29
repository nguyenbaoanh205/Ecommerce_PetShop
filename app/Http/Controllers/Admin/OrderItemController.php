<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->latest()->get();
        return view('admin.order-items.index', compact('orderItems'));
    }

    public function show(OrderItem $orderItem)
    {
        $orderItem->load(['order', 'product']);
        return view('admin.order-items.show', compact('orderItem'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $orderItem->update([
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        return redirect()->route('admin.order-items.index')
            ->with('success', 'Order item updated successfully.');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('admin.order-items.index')
            ->with('success', 'Order item deleted successfully.');
    }
} 