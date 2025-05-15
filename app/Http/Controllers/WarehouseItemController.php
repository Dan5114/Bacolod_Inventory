<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseItemController extends Controller
{
    public function index(Request $r)
    {
        $allowed = ['id','name','quantity','price','created_at'];
        $sort  = in_array($r->sort, $allowed) ? $r->sort : 'id';
        $order = strtoupper($r->order) === 'DESC' ? 'DESC' : 'ASC';

        $q = WarehouseItem::query();
        if ($r->filled('search')) {
            $term = $r->search.'%';
            $q->where('name','like',$term)->orWhere('id','like',$term);
        }
        $items = $q->orderBy($sort,$order)
                   ->paginate(10)
                   ->withQueryString();

        return view('items.index', compact('items','sort','order'));
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
        WarehouseItem::create($r->only('name','description','quantity','price'));
        return redirect()->route('inventory')->with('success','Item added');
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
        $item->update($r->only('name','description','quantity','price'));
        return redirect()->route('inventory')->with('success','Item updated');
    }

    public function destroy(WarehouseItem $item)
    {
        $item->delete();
        return redirect()->route('inventory')->with('success','Item deleted');
    }

    public function checkout(Request $r, WarehouseItem $item)
    {
        $r->validate([
            'quantity' => 'required|integer|min:1|max:'.$item->quantity,
        ]);

        DB::transaction(fn() => $item->decrement('quantity', $r->quantity));

        return redirect()->route('inventory')
                         ->with('success','Checked out '.$r->quantity.' units.');
    }
}
