<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PVSystemTemplateProduct;
use Illuminate\Database\Query\JoinClause;

class PVSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pv_system.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        //Get the templates
        $templates = PVSystemTemplateProduct::all();

/*         $solar_panels = DB::table('products')
        ->join('product_attributes', 'products.id', 'product_attributes.product_id')
        ->select('products.id', 'products.Name', 'products.Price', 'product_attributes.Attribute_type','product_attributes.Attribute_value')
        ->where('products.Category', '=', 'Solar Panel')
        ->where('product_attributes.Attribute_type', '=', 'wattage')
        ->get(); */ 

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
        ->select(DB::raw('costs.template_number, SUM(cost)'))
        ->get();
        
        // echo $template_product_costs;
        // return view('pv_system.create',['prices' => $template_product_costs]);

        //echo $template_prices;


        /*
        SELECT template_number, SUM(cost) FROM ( 
            SELECT template_number, product_count*price as cost FROM `pv_system_template_products`, `products` WHERE pv_system_template_products.product_id = products.id 
        ) AS mytable2 GROUP BY template_number;
        */
        /* 
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
        
        
        echo $template_energies;
        return view(
            'pv_system.create',
            [
                
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
