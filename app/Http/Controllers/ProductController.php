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

        if (!$product) {
            return redirect()->route('product.index')
                ->with('error', 'Product creation failed. Please try again.');
        }

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
            $attribute = $product->productAttributes()->create([
                'Attribute_type' => $attributeName,
                'Attribute_value' => $attributeValue,
                // Set the 'product_id' if needed
            ]);

            if (!$attribute) {
                return redirect()->route('product.index')
                    ->with('error', 'Product creation failed. Please try again.');
            }
        }
        return redirect(route('product.index'))->with('success', 'Product successfully created.');
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
        $this->authorize('update', $product);

        $productUpdate = $product->updateOrFail([
            'Name' => $request->Name,
            'Price' => $request->Price,
            'Quantity' => $request->Quantity,
            'Category' => $request->Category,
        ]);

        if (!$productUpdate) {
            return redirect()->route('product.index')
                ->with('error', 'Product update failed. Please try again.');
        }

        $ids = $product->productAttributes->pluck('id')->all();

        $updateIds = array_keys($request['attributes']['Attribute_type']);

        $removedIds = [];

        // dd($ids, $updateIds, $removedIds);

        foreach ($ids as $id) {
            if (!in_array($id, $updateIds)) {
                $removedIds[] = $id;
            }
        }

        foreach ($updateIds as $updateId) {
            $newAttributeType = $request['attributes']['Attribute_type'][$updateId];
            $newAttributeValue = $request['attributes']['Attribute_value'][$updateId];

            // Check if the values have changed
            $existingAttribute = ProductAttribute::find($updateId);

            if ($existingAttribute) {
                if ($existingAttribute->product_id === $product->id && ($existingAttribute->Attribute_type !== $newAttributeType || $existingAttribute->Attribute_value !== $newAttributeValue)) {
                    // Values have changed, update the existing attribute
                    $existingAttributeUpdate = $existingAttribute->update([
                        'Attribute_type' => $newAttributeType,
                        'Attribute_value' => $newAttributeValue,
                    ]);
                    if (!$existingAttributeUpdate) {
                        return redirect()->route('product.index')
                            ->with('error', 'Product update failed. Please try again.');
                    }
                }
            } else {
                // Create a new attribute
                $newAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'Attribute_type' => $newAttributeType,
                    'Attribute_value' => $newAttributeValue,
                ]);
                if (!$newAttribute) {
                    return redirect()->route('product.index')
                        ->with('error', 'Product update failed. Please try again.');
                }
            }
        }

        foreach ($removedIds as $removedId) {
            $deleteAttribute = ProductAttribute::destroy($removedId);
            if (!($deleteAttribute > 0)) {
                return redirect()->route('product.index')
                    ->with('error', 'Product update failed. Please try again.');
            }
        }
        return redirect()->route('product.index')->with('success', 'Product successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        //
        $this->authorize('delete', $product);
        $deleteProduct = $product->delete();
        if (!($deleteProduct > 0)) {
            return redirect()->route('product.index')
                ->with('error', 'Product deletion failed. Please try again.');
        }
        return redirect(route('product.index'))->with('success', 'Product successfully deleted.');
    }
}
