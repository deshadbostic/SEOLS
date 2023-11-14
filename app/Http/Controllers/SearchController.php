<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has("items")) {
            Session::put('num_items', $request->get('items'));
        }
        if ($request->has("category")) {
            Session::put('category', array_values($request->get('category')));
        }
        // dd($request);
        $category = Session::get('category');
        $search = $request->search;
        $products = Product::query();

        if ($category) {
            $products->whereIn("category", $category)->get();
        }
        if ($search) {
            $products->where(function ($query) use ($search, $category) {
                $query->where("name", "like", "%" . $search . "%")
                    ->orWhere("quantity", "like", "%" . $search . "%")
                    ->orWhere("price", "like", "%" . $search . "%")
                    ->orWhereHas('productAttributes', function ($query) use ($search) {
                        $query->where("Attribute_type", "like", "%" . $search . "%")
                            ->orWhere("Attribute_value", "like", "%" . $search . "%");
                    });

                // Consider category filtering if search term provided but no category selected
                if (!$category) {
                    $query->orWhere("category", "like", "%" . $search . "%");
                }
            });
        }

        $products = $products->paginate($category = Session::get('num_items'));

        return view("product.index", compact('products', 'search', 'category'));
    }
}
