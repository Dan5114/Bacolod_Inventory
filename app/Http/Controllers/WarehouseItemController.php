<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseItemController extends Controller
{
    public function index(Request $request)
    {
        $query = WarehouseItem::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', $search . '%')
                  ->orWhere('id', 'like', $search . '%');
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(8);

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
        ]);

        $item = WarehouseItem::create($r->only('name', 'description', 'quantity', 'price'));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Created Item',
            'details' => $item->name,
        ]);

        return redirect()->route('inventory')->with('success', 'Item added');
    }

    public function edit(WarehouseItem $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $r, WarehouseItem $item)
    {
        $r->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
        ]);

        $item->update($r->only('name', 'description', 'quantity', 'price'));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Updated Item',
            'details' => $item->name,
        ]);

        return redirect()->route('inventory')->with('success', 'Item updated');
    }

    public function destroy(WarehouseItem $item)
    {
        $itemName = $item->name;
        $item->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Deleted Item',
            'details' => $itemName,
        ]);

        return redirect()->route('inventory')->with('success', 'Item deleted');
    }

    public function checkout(Request $r, WarehouseItem $item)
    {
        $r->validate([
            'quantity' => 'required|integer|min:1|max:' . $item->quantity,
        ]);

        DB::transaction(fn() => $item->decrement('quantity', $r->quantity));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Checked Out Item',
            'details' => $r->quantity . ' x ' . $item->name,
        ]);

        return redirect()->route('inventory')->with('success', 'Checked out ' . $r->quantity . ' units.');
    }

    public function cart()
    {
        $cart = session('cart', []);
        $items = WarehouseItem::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('items', 'cart'));
    }
}
