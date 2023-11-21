<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PVSystem;
use App\Models\PVSystemProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PVSystemTemplateProduct;
use App\Http\Requests\PVSystemRequest;
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
        return view('pv_system.create', $this->getTplInfo());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PVSystemRequest $request)
    {
        //echo $request->energy_generated;
        $user = Auth::user();
/*         if(!$this->checkRequiredCategories($request)) {
            return;
        } */
        
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
    
        $products = [];
        foreach($productInfo as $key => $product)
        {
            $products[$key] = Product::where('id', $product->id)->first();
        }
            
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
            'productInfo' => $productInfo,
            'products' => $products,
            'pv_system' => $pv_system,
            'energy_generated' => $pv_system->energy_generated,
            'equipment_cost' => $pv_system->energy_generated,
            'labour_cost' => ($pv_system->energy_generated * 0.1)
        ];

        return view('pv_system.show', $information);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PVSystem $pv_system)
    {
        return view('pv_system.edit', $this->getTplInfo($pv_system));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PVSystemRequest $request, PVSystem $pv_system)
    {
        $user = Auth::user();
        $pv_system->update([
            'user_id' => $user->id,
            'energy_generated' => $request->energy_generated,
            'equipment_cost' => $request->price,
        ]);

        $products = $request->products;
        $product_counts = $request->product_counts;

        $old_pv_system_products = PVSystemProduct::where('pv_system_id', $pv_system->id)->get();
        foreach($old_pv_system_products as $old_pv_system_product) {
            $old_pv_system_product->delete();
        }

        foreach($products as $key => $product) {
            PVSystemProduct::create([
                'pv_system_id' => $pv_system->id,
                'product_id' => $product,
                'product_count' => $product_counts[$key],
            ]);
        }//end foreach
        
        return redirect(route('pv_system.show', $pv_system));
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
