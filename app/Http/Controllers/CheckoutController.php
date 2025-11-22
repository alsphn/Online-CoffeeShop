<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function form()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('member.cart.index')->with('error', 'Keranjang Anda kosong');
        }

        $cartItems = $cart->items()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->qty * $item->price;
        });

        return view('member.checkout.form', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('member.cart.index')->with('error', 'Keranjang Anda kosong');
        }

        DB::beginTransaction();

        try {
            $cartItems = $cart->items()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->qty * $item->price;
            });

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'address' => $request->address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->qty,
                    'price' => $cartItem->price
                ]);

                // Update product stock
                $product = $cartItem->product;
                $product->stock -= $cartItem->qty;
                $product->save();
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('member.orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
