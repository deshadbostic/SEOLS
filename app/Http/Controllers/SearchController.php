<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = $request->input('category', []);
        $num_items = $request->input('items', 5);

        
        // Persist selected categories in session
        Session::put('category', $categories);
        Session::put('num_items', $num_items);
        
        // dd($request);
        $products = Product::query();

        if (!empty($categories)) {
            $products->whereIn("category", $categories);
        }

        if (!empty($search)) {
            $products->where(function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%")
                    ->orWhere("quantity", "like", "%" . $search . "%")
                    ->orWhere("price", "like", "%" . $search . "%")
                    ->orWhereHas('productAttributes', function ($query) use ($search) {
                        $query->where("Attribute_type", "like", "%" . $search . "%")
                            ->orWhere("Attribute_value", "like", "%" . $search . "%");
                    });

                // Consider category filtering if search term provided but no category selected
                $categories = Session::get('category');
                if (empty($categories)) {
                    $query->orWhere("category", "like", "%" . $search . "%");
                }
            });
        }

        $products = $products->paginate(Session::get('num_items'));

        return view("product.index", compact('products', 'search', 'categories'));
    }
}
