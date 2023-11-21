<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\PVSystemProduct;
use App\Models\PVSystemTemplateProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;

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

    private function getPVSystemProducts($pv_system) {
/*         $products = DB::table('pv_systems')
        ->join('pv_system_products', 'pv_systems.id', 'pv_system_products.pv_system_id')
        ->select('pv_system_products.*')
        ->get(); */
        $products = PVSystemProduct::where('pv_system_id', $pv_system->id)->get();
        $pv_system_products = [];
        foreach($products as $product) {
            $pv_system_products[] = DB::table('pv_system_products')
            ->join('products', 'products.id', 'pv_system_products.product_id')
            //->groupBy('product_id')
            ->get();
        }
        return $pv_system_products;
    }


    public function getTplInfo($pv_system = null) {
        $user = Auth::user();
        $productInfo = $this->fetchProductInto();

        $pv_system ?
        $pv_system_products = $this->getPVSystemProducts($pv_system):
        $pv_system_products = null;

        $template_product_costs =  DB::table('pv_system_template_products')
        ->join('products', 'pv_system_template_products.product_id', 'products.id')
        ->select(DB::raw('template_number, products.id as product_id, price*product_count as cost'))
        ->orderBy('template_number');

        

        $template_prices = DB::table('pv_system_template_products')
        ->joinSub($template_product_costs, 'costs', function(JoinClause $join) {
            $join->on('pv_system_template_products.template_number', 'costs.template_number')
            ->on('pv_system_template_products.product_id', 'costs.product_id');
        })
        ->groupBy('costs.template_number')
        ->select(DB::raw('costs.template_number, SUM(cost) as price'))
        ->get();
        //
/*         for($i = 0; $i < count($template_prices); $i++) {
            if($i === 0) {
                $template_prices[$i] = -3;
            } elseif(!isset($template_prices[$i+1])) {
                $template_prices[] = $template_prices[$i];
            } else {
                $template_prices[$i] = $template_prices[$i-1];
            }
        } */
        

        // echo $template_product_costs;
        // return view('pv_system.create',['prices' => $template_product_costs]);

        //echo $template_prices;


        /*
        SELECT template_number, SUM(cost) FROM ( 
            SELECT template_number, product_count*price as cost FROM `pv_system_template_products`, `products` WHERE pv_system_template_products.product_id = products.id 
        ) AS mytable2 GROUP BY template_number;
        
         
        SELECT template_number, SUM(cost) FROM ( 
            SELECT template_number, product_count*price as cost FROM ( 
                SELECT product_count, price, template_number FROM `pv_system_template_products`, `products` WHERE pv_system_template_products.product_id = products.id 
            ) AS mytable 
        ) AS mytable2 GROUP BY template_number
        */

        
        $template_energies = DB::table('pv_system_template_products')
        ->join('products', 'pv_system_template_products.product_id', 'products.id')
        ->join('product_attributes', 'pv_system_template_products.product_id', 'product_attributes.product_id')
        ->where('products.Category', '=', 'Solar Panel')
        ->where('product_attributes.Attribute_type', '=', 'wattage')
        ->orderBy('template_number')
        ->get();

        
        

        $template_total_energies = [];

        foreach($template_energies as $key => $template) {
            /* if(isset($template_energies[$key+1]) && $template->template_number === $template_energies[$key+1]->template_number) {
                
            } */
            $energy_generated = $template->product_count*preg_split("/W/",$template->Attribute_value)[0]; 
            if(!isset($template_total_energies[$template->template_number]))
            {
                $template_total_energies[$template->template_number] = 0;
            }
            $template_total_energies[$template->template_number] += $energy_generated;
            // echo $template->template_number . " => " . $energy_generated . "<br>";
        }
        

        //echo $template_energies;
        //var_dump($template_total_energies);
        $energy_requirement = 3451;
        $budget_requirement = $user->budget;
    
        $valid_energy_templates = [];
        // $difference = $template_total_energies[1] - $energy_requirement;
        foreach($template_total_energies as $key => $template_total_energy) {
            $difference = $template_total_energy - $energy_requirement;
            if($difference >= 0)
            {
                $valid_energy_templates[$key] = $difference;
            }
        }
        
        $valid_price_templates = [];
        foreach($template_prices as $key => $template_total_price) {
            $difference = $user->budget - $template_total_price->price ;
            if($difference >= 0)
            {
                $valid_price_templates[$template_total_price->template_number] = $difference;
            }
        }
       
        $template = null;

/*         var_dump($valid_energy_templates);
        echo "<br><br>";
        var_dump($valid_price_templates);
        echo "<br><br>"; */


        if(!empty($valid_energy_templates) && !empty($valid_price_templates)) 
        {
            while(!empty($valid_energy_templates))
            {
                // get minimum difference
                $min_difference = min($valid_energy_templates);

                // get the template number of the min
                $min_energy_template = array_search($min_difference, $valid_energy_templates);
                
                // check if it is in the valid prices
                if(array_key_exists($min_energy_template, $valid_price_templates)) // if yes break and return the template
                {
                    // save the template
                    $template = $min_energy_template;
                    break;
                }
                else // if no remove the template from the array
                {
                    unset($valid_energy_templates[$min_energy_template]);
                }
            }
        }
        // check if there was valid template returned
        if(null !== $template) 
        {
            $template_products = DB::table('pv_system_template_products')
            ->join('products', 'pv_system_template_products.product_id', 'products.id')
            ->where('template_number', '=', $template)
            ->get();

            $information =
            [
                'user' => $user,
                'template_products' => $template_products,
                'pv_system' => $pv_system,
                'pv_system_products' => $pv_system_products,
                'template_energy' => $template_total_energies[$template],
                'template_price' => $template_prices[$template-1]->price,
                'products' => $productInfo['products'],
                'categories' => $productInfo['categories']
            ];
        } 
        else 
        {
            $information =
            [
                'user' => $user,
                'pv_system' => $pv_system,
                'pv_system_products' => $pv_system_products,
                'template_products' => null,
                'template_energy' => null,
                'template_price' => null,
                'products' => $productInfo['products'],
                'categories' => $productInfo['categories']
            ];
        }

        return $information;
    }//end getTplInfo
}