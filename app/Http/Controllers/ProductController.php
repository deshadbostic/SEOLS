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
        if ($request['attributes'] && $request['attributes']['Attribute_type'] && $request['attributes']['Attribute_type']) {
            // Create the associated Attributes records
            $attributes = $request->input('attributes');
            $attributeNames = $attributes['Attribute_type'];
            $attributeValues = $attributes['Attribute_value'];
            // Loop through the arrays to process each attribute-value pair
            for ($i = 0; $i < count($attributeNames); $i++) {
                $attributeName = $attributeNames[$i];
                $attributeValue = $attributeValues[$i];
                // Create and save the Attributes record for each attribute-value pair
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
            foreach ($product->productAttributes as $attribute) { $attribute->delete();}
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
            foreach ($updateIds as $updateId) {
                $newAttributeType = $request['attributes']['Attribute_type'][$updateId];
                $newAttributeValue = $request['attributes']['Attribute_value'][$updateId];
                // Check if the values have changed
                $existingAttribute = ProductAttribute::find($updateId);
                if ($existingAttribute && $existingAttribute->product_id === $product->id) {
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
