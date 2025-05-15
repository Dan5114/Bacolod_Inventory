<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $r)
    {
        $cart = $r->session()->get('cart', []);
        $items = WarehouseItem::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('items','cart'));
    }

    public function add(Request $r, WarehouseItem $item)
    {
        $cart = $r->session()->get('cart', []);
        $cart[$item->id] = ($cart[$item->id] ?? 0) + 1;
        $r->session()->put('cart', $cart);
        return back()->with('success','Added to cart');
    }

    public function update(Request $r, WarehouseItem $item)
    {
        $qty = (int)$r->quantity;
        if ($qty < 1) {
            return back()->withErrors('Quantity must be at least 1');
        }
        $cart = $r->session()->get('cart', []);
        if (isset($cart[$item->id])) {
            $cart[$item->id] = min($qty, $item->quantity);
            $r->session()->put('cart', $cart);
        }
        return back()->with('success','Cart updated');
    }

    public function remove(Request $r, WarehouseItem $item)
    {
        $cart = $r->session()->get('cart', []);
        unset($cart[$item->id]);
        $r->session()->put('cart', $cart);
        return back()->with('success','Removed from cart');
    }

    public function checkout(Request $r)
    {
        $cart = $r->session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors('Your cart is empty');
        }

        DB::transaction(function() use($cart) {
            foreach ($cart as $id => $qty) {
                $item = WarehouseItem::find($id);
                if ($item && $qty <= $item->quantity) {
                    $item->decrement('quantity', $qty);
                }
            }
        });
        $r->session()->forget('cart');
        return redirect()->route('inventory')->with('success','Checked out cart items');
    }
}
