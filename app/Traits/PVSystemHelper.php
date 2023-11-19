<?php

namespace App\Traits;

use App\Models\PVSystemTemplateProduct;
use Illuminate\Support\Facades\DB;

trait PVSystemHelper { 
    public function fetchProductInto() {
        $categories = DB::table('products')
        ->distinct()
        ->select('Category')
        ->get();

        $products = [];
        $product_attributes = [
            'Solar Panel' => 'wattage',
            'Battery' => 'capacity',
            'Wire' => 'length',
            'Inverter' => 'efficiency',
        ];
        foreach($categories as $category) {
            // if($category->Category === 'Solar Panel') $category->Category = 'solar_panel';
            $products[$category->Category] = DB::table('products')
            ->join('product_attributes', 'products.id', 'product_attributes.product_id')
            ->where('Category', '=', $category->Category)
            ->where('Attribute_type', '=', $product_attributes[$category->Category])
            ->select('product_id','Name', 'Price', 'Category', 'Attribute_type', 'Attribute_Value')
            ->get();
        }
        
        return [
            'categories' => $categories,
            'products' => $products
        ];

/*         extract($products);
        foreach($categories as $category) {
        if($category->Category === 'Solar Panel') $category->Category = 'solar_panel'; 
            print_r(${$category->Category});
            echo '<br>';
        } 
        echo '<br>'.($products['Solar Panel']).'<br>';
        echo '<br>' . $categories . '<br>'; */
    }//end fetchProductInfo

    public function checkRequiredCategories($request) : bool {
        $categories = $request->categories;
        $required_categories = [
            'Solar Panel' => false,
            'Inverter' => false,
            'Wire' => false,
        ];
        foreach($categories as $category) {
            foreach($required_categories as $key => $required_category) {
                if($category === $key) {
                    $required_categories[$key] = true;
                }
            }
        }//end foreach
        foreach($required_categories as $required_category) {
            if($required_category === false) {
                return false;
            }
        }
        return true;
    }//end checkRequiredCategories
}