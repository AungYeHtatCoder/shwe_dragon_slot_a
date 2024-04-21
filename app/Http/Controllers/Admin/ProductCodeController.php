<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCode;
use Illuminate\Http\Request;

class ProductCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_code = ProductCode::latest()->get();
        return view('admin.product_code.index', compact('product_code'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_code = new ProductCode();
        $product_code['product'] = $request->product;
        $product_code['product_code'] = $request->product_code;
        $product_code['game_type'] = $request->game_type;
        $product_code['currency_code'] = $request->currency_code;
        $product_code['conversion_rate'] = $request->conversion_rate;

        $product_code->save();

        return redirect()->route('admin.product_code.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $value = ProductCode::find($id);
        return view('admin.product_code.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product_code = ProductCode::find($id);
        $product_code['product'] = $request->product;
        $product_code['product_code'] = $request->product_code;
        $product_code['game_type'] = $request->game_type;
        $product_code['currency_code'] = $request->currency_code;
        $product_code['conversion_rate'] = $request->conversion_rate;

        $product_code->save();

        return redirect()->route('admin.product_code.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_code = ProductCode::find($id);
        $product_code->delete();

        return redirect()->route('admin.product_code.index');
    }
}
