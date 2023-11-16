<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $numItems = $request->input('items');

        Session::put('search', preg_replace('/[^A-Za-z0-9 ]/', '', $search));
        if ($category) {
            Session::put('category', $category);
        }
        if ($numItems) {
            Session::put('num_items', $numItems);
        }

        return redirect(route('product.index'));
    }
}
