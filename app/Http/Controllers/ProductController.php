<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute; // include the Attributes model
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $products = Product::with('productAttributes')->get();
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $this->authorize('create', Product::class);
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        //
        $this->authorize('create', Product::class);

        $product = Product::create([
            'Name' => $request->Name,
            'Price' => $request->Price,
            'Quantity' => $request->Quantity,
            'Category' => $request->Category,
        ]);

        // Create the associated Attributes records
        $attributes = $request->input('attributes');
        $attributeNames = $attributes['Attribute_type'];
        $attributeValues = $attributes['Attribute_value'];

        // Loop through the arrays to process each attribute-value pair
        for ($i = 0; $i < count($attributeNames); $i++) {
            $attributeName = $attributeNames[$i];
            $attributeValue = $attributeValues[$i];

            // Create and save the Attributes record for each attribute-value pair
            // Example:
            $product->productAttributes()->create([
                'Attribute_type' => $attributeName,
                'Attribute_value' => $attributeValue,
                // Set the 'product_id' if needed
            ]);
        }
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        //
        $this->authorize('view', $product);
        $attributes = $product->productAttributes;
        return view('product.show', ['product' => $product, 'attributes' => $attributes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $this->authorize('update', $product);
        $attributes = $product->productAttributes;
        // dd($attributes);
        return view('product.edit', ['product' => $product, 'attributes' => $attributes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        //
        //        dd($request);
        $this->authorize('update', $product);

        $product->update([
            'Name' => $request->Name,
            'Price' => $request->Price,
            'Quantity' => $request->Quantity,
            'Category' => $request->Category,
        ]);

        //        dd($request);


        $ids = $product->productAttributes->pluck('id')->all();

        $updateIds = array_keys($request['attributes']['Attribute_type']);
        // dd($updateIds);

        $removedIds = [];

        foreach ($ids as $id) {
            if (!in_array($id, $updateIds)) {
                $removedIds[] = $id;
            }
        }

        //         dd($request, $ids, $removedIds, $updateIds);

        foreach ($updateIds as $updateId) {
            //        dd($request, $ids, $removedIds, $updateIds);
            $attribute = ProductAttribute::find($updateId)?->where('product_id', $product->id);
            //            dd($attribute);
            if ($attribute) {
                $attribute->update([
                    'Attribute_type' => $request['attributes']['Attribute_type'][$updateId],
                    'Attribute_value' => $request['attributes']['Attribute_value'][$updateId],
                ]);
            } else {
                // Create a new attribute
                //                $this->authorize('create', ProductAttribute::class);

                ProductAttribute::create([
                    'product_id' => $product->id,
                    'Attribute_type' => $request['attributes']['Attribute_type'][$updateId],
                    'Attribute_value' => $request['attributes']['Attribute_value'][$updateId],
                ]);
            }
        }

        foreach ($removedIds as $removedId) {
            ProductAttribute::destroy($removedId);
        }
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        //
        $this->authorize('delete', $product);
        $product->delete();
        return redirect(route('product.index'));
    }
}
