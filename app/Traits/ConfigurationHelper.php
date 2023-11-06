<?php

namespace App\Traits;

use App\Http\Requests\ConfigurationRequest;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

trait ConfigurationHelper {
    public function generateConfigInfo(ConfigurationRequest $request) {

        $cost_info = $this->getCostInfo($request);
        $energy_info = $this->getEnergyInfo($request);

        return [
            'equipment_cost' => $cost_info[0],
            'labour_cost' => $cost_info[1],
            'config_cost' => $cost_info[2],
            'solar_panel_energy' => $energy_info[0],
            'inverter_energy' => $energy_info[1],
            'battery_capacity' => $energy_info[2],
        ];
    }//end generateConfigInfo

    private function getCostInfo(ConfigurationRequest $request) {
        $inverter_id = $request->get('inverter_id');
        $inverter = Product::where('id',$inverter_id)->first();
        $inverter_cost = $inverter->Price * $request->inverter_count;
        
        $solar_panel_id = $request->get('solar_panel_id');
        $solar_panel = Product::where('id',$solar_panel_id)->first();
        $solar_panel_cost = $solar_panel->Price * $request->solar_panel_count;

        if(!empty($request->get('battery_id'))) {
            $battery_id = $request->get('battery_id');
            $battery = Product::where('id',$battery_id)->first();
            $battery_cost = $battery->Price * $request->battery_count;
        } else $battery_cost = 0;

        $wire_id = $request->get('wire_id');
        $wire = Product::where('id',$wire_id)->first();
        $wire_cost = $wire->Price * $request->wire_count;

        $equipment_cost = $inverter_cost + $solar_panel_cost + $battery_cost + $wire_cost;
        $labour_cost = $equipment_cost*0.15;
        $config_cost = ($equipment_cost + $labour_cost)*0.8;

        return [$equipment_cost, $labour_cost, $config_cost];
    }

    private function getEnergyInfo(ConfigurationRequest $request) {
        $solar_panel_id = $request->get('solar_panel_id');
        $solar_panel_energy = DB::table('product_attributes')
        ->select('product_attributes.Attribute_value')
        ->where('product_attributes.product_id', '=', $solar_panel_id)
        ->where('product_attributes.Attribute_type', '=', 'wattage')
        ->get();
        $solar_panel_energy = preg_split("/W/",$solar_panel_energy[0]->Attribute_value)[0];
        $solar_panel_energy *= 5;
        $solar_panel_energy *= $request->solar_panel_count;

        $inverter_id = $request->get('inverter_id');
        $inverter_capacity = DB::table('product_attributes')
            ->select('product_attributes.Attribute_value')
            ->where('product_attributes.product_id', '=', $inverter_id)
            ->where('product_attributes.Attribute_type', '=', 'capacity')
            ->get();
        $inverter_capacity = preg_split("/\skW/",$inverter_capacity[0]->Attribute_value)[0];
        $inverter_capacity *= $request->inverter_count;

        $inverter_efficiency = DB::table('product_attributes')
            ->select('product_attributes.Attribute_value')
            ->where('product_attributes.product_id', '=', $inverter_id)
            ->where('product_attributes.Attribute_type', '=', 'efficiency')
            ->get();
        $inverter_efficiency = preg_split("/%/",$inverter_efficiency[0]->Attribute_value)[0]; 
        $inverter_energy = ($inverter_capacity*($inverter_efficiency/100))*$request->inverter_count;

        if(!empty($request->get('battery_id'))) {
            $battery_id = $request->get('battery_id');
            $battery_capacity = DB::table('product_attributes')
            ->select('product_attributes.Attribute_value')
            ->where('product_attributes.product_id', '=', $battery_id)
            ->where('product_attributes.Attribute_type', '=', 'capacity')
            ->get();
            $battery_capacity = preg_split("/mha/",$battery_capacity[0]->Attribute_value)[0];
            $battery_capacity*= $request->battery_count;
        } else $battery_capacity = 0;

        return [$solar_panel_energy, $inverter_energy, $battery_capacity];
    }

    public function fetchProducts() {
        $solar_panels = DB::table('products')
        ->join('product_attributes', 'products.id', 'product_attributes.product_id')
        ->select('products.id', 'products.Name', 'products.Price', 'product_attributes.Attribute_type','product_attributes.Attribute_value')
        ->where('products.Category', '=', 'solar_panel',)
        ->where('product_attributes.Attribute_type', '=', 'wattage')
        ->get(); 

        $batteries = DB::table('products')
            ->join('product_attributes', 'products.id', 'product_attributes.product_id')
            ->select('products.id', 'products.Name', 'products.Price', 'product_attributes.Attribute_type','product_attributes.Attribute_value')
            ->where('products.Category', '=', 'battery')
            ->where('product_attributes.Attribute_type', '=', 'capacity')
            ->get();
        
        $wires = DB::table('products')
            ->join('product_attributes', 'products.id', 'product_attributes.product_id')
            ->select('products.id', 'products.Name', 'products.Price', 'product_attributes.Attribute_type','product_attributes.Attribute_value')
            ->where('products.Category', '=', 'wire')
            ->where('product_attributes.Attribute_type', '=', 'length')
            ->get(); 
        
        $inverters = DB::table('products')
            ->join('product_attributes', 'products.id', 'product_attributes.product_id')
            ->select('products.id', 'products.Name', 'products.Price', 'product_attributes.Attribute_type','product_attributes.Attribute_value')
            ->where('products.Category', '=', 'inverter')
            ->where('product_attributes.Attribute_type', '=', 'efficiency')
            ->get();

        return [
            'solar_panels' => $solar_panels,
            'batteries' => $batteries,
            'wires' => $wires,
            'inverters' => $inverters,
        ];
    }
}

?>