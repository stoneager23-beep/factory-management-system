<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function index()
    {
        $accessories = Accessory::all();
        return view('accessories.index', compact('accessories'));
    }

    public function create()
    {
        return view('accessories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'nullable|string|max:100',
            'color'      => 'nullable|string|max:100',
            'quantity'   => 'required|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
        ]);

        Accessory::create($validated);
        return redirect()->route('accessories.index')->with('success', 'Accessory created successfully.');
    }

    public function edit(Accessory $accessory)
    {
        return view('accessories.edit', compact('accessory'));
    }

    public function update(Request $request, Accessory $accessory)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'nullable|string|max:100',
            'color'      => 'nullable|string|max:100',
            'quantity'   => 'required|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
        ]);

        $accessory->update($validated);
        return redirect()->route('accessories.index')->with('success', 'Accessory updated successfully.');
    }

    public function destroy(Accessory $accessory)
    {
        $accessory->delete();
        return redirect()->route('accessories.index')->with('success', 'Accessory deleted successfully.');
    }
        public function search(Request $request) {
        $q = $request->q;
        $accessories = Accessory::where('name','like',"%$q%")->get();
        return view('accessories.partials.table', compact('accessories'));
    }

}


