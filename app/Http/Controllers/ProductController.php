<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute; // include the Attributes model
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $search = Session::get('search');
        $category = Session::get('category');
        $numItems = Session::get('num_items');

        $productsQuery = Product::query();

        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('Name', 'like', '%' . $search . '%')
                    ->orWhere('Price', 'like', '%' . $search . '%')
                    ->orWhere('Quantity', 'like', '%' . $search . '%')
                    ->orWhereHas('productAttributes', function ($query) use ($search) {
                        $query->where("Attribute_type", "like", "%" . $search . "%")
                            ->orWhere("Attribute_value", "like", "%" . $search . "%");
                    });
            });
        }

        if ($category) {
            $productsQuery->whereIn('Category', $category);
        }
        $products = $productsQuery->paginate($numItems ?? 5);

        $categories = Product::groupBy('Category')->pluck('Category');

        return view('product.index', compact('categories', 'products', 'category', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Product::class);
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
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

        if ($request['attributes'] && $request['attributes']['Attribute_type'] && $request['attributes']['Attribute_value']) {
            $attributes = $request->input('attributes');
            $attributeNames = $attributes['Attribute_type'];
            $attributeValues = $attributes['Attribute_value'];

            // Create an array to keep track of attribute types for validation
            $existingAttributeTypes = [];

            for ($i = 0; $i < count($attributeNames); $i++) {
                $attributeName = $attributeNames[$i];
                $attributeValue = $attributeValues[$i];

                // Check if the attribute type already exists for the current product
                if (in_array(strtolower($attributeName), $existingAttributeTypes)) {
                    return redirect()->route('product.index')
                        ->with('error', 'Duplicate product attribute ' . strtolower($attributeName) . ' for this product. Attribute was not created. Please try again.');
                }

                // Add the current attribute type to the array for validation
                $existingAttributeTypes[] = strtolower($attributeName);

                // Create and save the Attributes record for each attribute-value pair
                $attribute = $product->productAttributes()->create([
                    'Attribute_type' => strtolower($attributeName),
                    'Attribute_value' => strtolower($attributeValue),
                    // Set the 'product_id' if needed
                ]);

                if (!$attribute) {
                    return redirect()->route('product.index')
                        ->with('error', 'Attribute ' . strtolower($attributeName) . ' creation failed. Please try again.');
                }
            }
        }

        return redirect(route('product.index'))->with('success', 'Product successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $this->authorize('view', $product);
        $attributes = $product->productAttributes;
        return view('product.show', ['product' => $product, 'attributes' => $attributes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $attributes = $product->productAttributes;
        return view('product.edit', ['product' => $product, 'attributes' => $attributes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);
        $productUpdate = $product->update([
            'Name' => $request->Name,
            'Price' => $request->Price,
            'Quantity' => $request->Quantity,
            'Category' => $request->Category,
        ]);
        if (!$productUpdate) {
            return redirect()->route('product.index')
                ->with('error', 'Product update failed. Please try again.');
        }
        if (!$request->has('attributes') || empty($request->attributes)) {
            foreach ($product->productAttributes as $attribute) {
                $attribute->delete();
            }
        }
        if ($request['attributes'] && $request['attributes']['Attribute_type'] && $request['attributes']['Attribute_type']) {
            $updateIds = array_keys($request['attributes']['Attribute_type']);
            $ids = $product->productAttributes->pluck('id')->all();
            $removedIds = [];
            foreach ($ids as $id) {
                if (!in_array($id, $updateIds)) {
                    $removedIds[] = $id;
                }
            }

            $existingAttributeTypes = []; // Array to keep track of existing attribute types

            foreach ($updateIds as $updateId) {
                $newAttributeType = $request['attributes']['Attribute_type'][$updateId];
                $newAttributeValue = $request['attributes']['Attribute_value'][$updateId];

                // Check if the attribute type already exists for the current product
                if (in_array(strtolower($newAttributeType), $existingAttributeTypes)) {
                    return redirect()->route('product.index')
                        ->with('error', 'Duplicate attribute ' . strtolower($newAttributeType) . ' for this product. This attribute was not created. Please try again.');
                }

                // Add the current attribute type to the array for validation
                $existingAttributeTypes[] = strtolower($newAttributeType);

                // Check if the values have changed
                $existingAttribute = ProductAttribute::find($updateId);
                if ($existingAttribute && $existingAttribute->product_id === $product->id) {
                    if ($existingAttribute->product_id === $product->id && (strtolower($existingAttribute->Attribute_type) !== strtolower($newAttributeType) || strtolower($existingAttribute->Attribute_value) !== strtolower($newAttributeValue))) {
                        // Values have changed, update the existing attribute
                        $existingAttributeUpdate = $existingAttribute->update([
                            'Attribute_type' => strtolower($newAttributeType),
                            'Attribute_value' => strtolower($newAttributeValue),
                        ]);
                        if (!$existingAttributeUpdate) {
                            return redirect()->route('product.index')
                                ->with('error', 'Product update failed. Could not update attribute ' . strtolower($existingAttribute->Attribute_type) . '. Please try again.');
                        }
                    }
                } else {
                    // Create a new attribute
                    $newAttribute = ProductAttribute::create([
                        'product_id' => $product->id,
                        'Attribute_type' => strtolower($newAttributeType),
                        'Attribute_value' => strtolower($newAttributeValue),
                    ]);
                    if (!$newAttribute) {
                        return redirect()->route('product.index')
                            ->with('error', 'Product update failed. Could not create attribute ' . strtolower($newAttributeType) . '. Please try again.');
                    }
                }
            }
            foreach ($removedIds as $removedId) {
                $attributeToBeRemoved = ProductAttribute::find($removedId);
                $deleteAttribute = ProductAttribute::destroy($removedId);
                if (!($deleteAttribute > 0)) {
                    return redirect()->route('product.index')
                        ->with('error', 'Product update failed.  Could not remove attribute ' . strtolower($attributeToBeRemoved->Attribute_type) . '.Please try again.');
                }
            }
        }
        return redirect()->route('product.index')->with('success', 'Product successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        $deleteProduct = $product->delete();
        if (!($deleteProduct > 0)) {
            return redirect()->route('product.index')
                ->with('error', 'Product deletion failed. Please try again.');
        }
        return redirect(route('product.index'))->with('success', 'Product successfully deleted.');
    }
}
