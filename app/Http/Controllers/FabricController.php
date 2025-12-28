<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use Illuminate\Http\Request;

class FabricController extends Controller
{
    public function index() {
        $fabrics = Fabric::all();
        return view('fabrics.index', compact('fabrics'));
    }

    public function create() {
        return view('fabrics.create');
    }

//    public function store(Request $request) {
//        $data = $request->validate([
//            'name' => 'required|string',
//            'color' => 'nullable|string',
//            'quantity' => 'required|numeric|min:0',
//            'unit' => 'required|in:meters,yards,kgs',
//            'supplier' => 'nullable|string',
//        ]);
//
//        Fabric::create($data);
//        return redirect()->route('fabrics.index');
//
//    }

    public function edit(Fabric $fabric) {
        return view('fabrics.edit', compact('fabric'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'color'      => 'nullable|string|max:100',
            'quantity'   => 'required|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
        ]);

        Fabric::create($validated);

        return redirect()->route('fabrics.index')->with('success', 'Fabric created successfully.');
    }

    public function update(Request $request, Fabric $fabric)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'color'      => 'nullable|string|max:100',
            'quantity'   => 'required|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'supplier'   => 'nullable|string|max:255',
        ]);

        $fabric->update($validated);

        return redirect()->route('fabrics.index')->with('success', 'Fabric updated successfully.');
    }


    public function destroy(Fabric $fabric) {
        $fabric->delete();
        return redirect()->route('fabrics.index');
    }

    public function search(Request $request) {
        $q = $request->q;
        $fabrics = Fabric::where('name','like',"%$q%")
            ->orWhere('color','like',"%$q%")
            ->get();
        return view('fabrics.partials.table', compact('fabrics'));
    }

}
