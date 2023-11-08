<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductAttributeRequest;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $productattributes = ProductAttribute::all();
        return view('productattribute.index')->with('productattributes', $productattributes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $this->authorize('create', ProductAttribute::class);
        return view('productattribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductAttributeRequest $request): RedirectResponse
    {
        //
        $this->authorize('create', ProductAttribute::class);

        ProductAttribute::create([ 
            'Attribute_type' => $request->Attribute_type,
            'Attribute_value' => $request->Attribute_value,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productattribute): View
    {
        //
        $this->authorize('view', $productattribute);
        return view('productattribute.show', ['productattribute' => $productattribute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttribute $productattribute)
    {
        //
        $this->authorize('update', $productattribute);
        return view('productattribute.edit', ['productattribute' => $productattribute]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductAttributeRequest $request, ProductAttribute $productattribute): RedirectResponse
    {
        //
        $this->authorize('update', $productattribute);

        $productattribute->update([
            'Attribute_type' => $request->Attribute_type,
            'Attribute_value' => $request->Attribute_value,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttribute $productattribute): RedirectResponse
    {
        //
        $this->authorize('delete', $productattribute);
        $productattribute->delete();
        return redirect(route('products.index'));
    }
}
