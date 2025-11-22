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
            return $item->qty * $item->price;
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
            $newQty = $cartItem->qty + $qty;

            // Check if stock is sufficient
            if ($newQty > $product->stock) {
                return redirect()->back()
                    ->with('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
            }

            $cartItem->qty = $newQty;
            $cartItem->save();
        } else {
            // Check if stock is sufficient for new cart item
            if ($qty > $product->stock) {
                return redirect()->back()
                    ->with('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
            }

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

        // Verify the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $newQty = $request->input('quantity', $request->input('qty', 1));

        // Check if stock is sufficient
        if ($newQty > $cartItem->product->stock) {
            return redirect()->back()
                ->with('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $cartItem->product->stock);
        }

        $cartItem->qty = $newQty;
        $cartItem->save();

        return redirect()->route('member.cart.index')
            ->with('success', 'Keranjang berhasil diupdate');
    }

    public function delete($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Verify the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->route('member.cart.index')
            ->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
