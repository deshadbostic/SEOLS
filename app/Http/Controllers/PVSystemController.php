<?php

namespace App\Http\Controllers;

use App\Models\PVSystem;
use App\Models\PVSystemProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PVSystemTemplateProduct;
use App\Traits\PVSystemHelper;
use Illuminate\Database\Query\JoinClause;

class PVSystemController extends Controller
{
    use PVSystemHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::user()->role == 'Customer' ?
        $pv_systems = PVSystem::where('user_id', Auth::id())->get() :
        $pv_systems = PVSystem::all();
        return view('pv_system.index')->with('pv_systems', $pv_systems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $productInfo = $this->fetchProductInto(); 

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
        $energy_requirement = 2000;
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
                $valid_price_templates[$key] = $difference;
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

            $template_return =
            [
                'user' => $user,
                'template_products' => $template_products,
                'template_energy' => $template_total_energies[$template],
                'template_price' => $template_prices[$template]->price,
                'products' => $productInfo['products'],
                'categories' => $productInfo['categories']
            ];
        } else 
        {
            $template_return =
            [
                'user' => $user,
                'template_products' => null,
                'template_energy' => null,
                'template_price' => null,
                'products' => $productInfo['products'],
                'categories' => $productInfo['categories']
            ];
        }
        // var_dump($template_return['template_products']);
        return view('pv_system.create', $template_return);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //echo $request->energy_generated;
        $user = Auth::user();
        if(!$this->checkRequiredCategories($request)) {
            return;
        }
        
        //echo $this->checkRequiredCategories($request);
        $products = $request->products;
        $product_counts = $request->product_counts;

        // PVSystem::create([
        //     'user_id' => $user->id,
        //     //'building_id' => '1',
        //     'energy_generated' => $request->energy_generated,
        //     'equipment_cost' => $request->price,
        // ]);

        $newPVSystem = new PVSystem;
        $newPVSystem->user_id = $user->id;
        $newPVSystem->energy_generated = $request->energy_generated;
        $newPVSystem->equipment_cost = $request->price;

        $newPVSystem->save();

        foreach($products as $key => $product) {
            PVSystemProduct::create([
                'pv_system_id' => $newPVSystem->id,
                'product_id' => $product,
                'product_count' => $product_counts[$key],
            ]);
        }
        $pv_systems = PVSystem::where('user_id', Auth::id())->get();
        return redirect(route('pv_system.index',))->with('pv_systems', $pv_systems);
    }//end store()

    /**
     * Display the specified resource.
     */
    public function show(PVSystem $pv_system)
    {
        $productInfo = DB::table('pv_system_products')
            ->join('products', 'pv_system_products.product_id', 'products.id')
            ->where('pv_system_id', '=', $pv_system->id)
            ->orderBy('products.category')
            ->get();
            
        // $products = PVSystemProduct::where('pv_system_id', $pv_system->id)->get();
        // $productsInfo
        // $solar_panel = Product::where('id', $configuration->solar_panel_id)->first();
        // $inverter = Product::where('id', $configuration->inverter_id)->first();
        // $wire = Product::where('id', $configuration->wire_id)->first();
        // if($configuration->battery_id !== NULL) {
        //     $battery = Product::where('id', $configuration->battery_id)->first();
        // } else {
        //     $battery = '';
        // }
        
        // return view(
        //     'configuration.show',
        //     [
        //         'configuration' => $configuration,
        //         'solar_panel' => $solar_panel,
        //         'inverter' => $inverter,
        //         'battery' => $battery,
        //         'wire' => $wire,
                
        //     ],
        // );
        $information = [
            'products' => $productInfo,
            'energy_generated' => $pv_system->energy_generated,
            'equipment_cost' => $pv_system->energy_generated,
            'labour_cost' => ($pv_system->energy_generated * 0.1)
        ];

        return view('pv_system.show', $information);
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
    public function destroy(PVSystem $pv_system) /* : RedirectResponse */
    {
        //
        $pv_system->delete();
        return redirect(route('pv_system.index'));
    }
}
