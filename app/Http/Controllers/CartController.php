<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cartItems = $cart->items()->with('product')->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->qty * $item->product->price;
        });

        return view('member.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $qty = $request->input('qty', 1);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->qty += $qty;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->price
            ]);
        }

        return redirect()->route('member.cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $qty = (int) $request->input('qty', 1);

        if ($qty < 1) {
            return redirect()->back()->with('error', 'Qty tidak boleh kurang dari 1');
        }

        $cartItem->qty = $qty;
        $cartItem->save();

        return redirect()->route('member.cart.index')
            ->with('success', 'Keranjang berhasil diupdate');
    }

    public function delete($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('member.cart.index')
            ->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
