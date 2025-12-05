<?php

namespace App\Http\Controllers;

use App\Models\GasItem;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class GasItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Items = GasItem::paginate(10);
        return view('gas.index', compact('Items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'code_barang' => 'required|string|max:255|unique:gas_items',
            'harga' => 'required|integer|min:0',
            'qty' => 'required|integer|min:0',
            'jenis' => 'required|string|max:255',
        ]);

        GasItem::create($validated);

        return redirect()->route('gas.index')->with('success', 'Data Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GasItem $gas)
    {
        return view('gas.edit', compact('gas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GasItem $gas)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'code_barang' => 'required|string|max:255|unique:gas_items,code_barang,'. $gas->id,
            'harga' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'jenis' => 'required|string|max:255',
        ]);

        $gas->update($validated);

        return redirect()->route('gas.index')->with('success', 'Data Berhasil diPerbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GasItem $gas)
    {
        $gas->delete();

        return redirect()->route('gas.index')->with('success', 'Data Berhasil di hapus');
    }
}
