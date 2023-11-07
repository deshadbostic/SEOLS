<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuration;
use App\Models\User;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ConfigurationHelper;
use Illuminate\Http\RedirectResponse;

class ConfigurationController extends Controller
{
    use ConfigurationHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configurations = Configuration::where('user_id', Auth::id())->get();
        return view('configuration.index')->with('configurations', $configurations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $products = $this->fetchProducts();
        return view(
            'configuration.create', 
            [
                'user' => $user,
                'solar_panels' => $products['solar_panels'],
                'batteries' => $products['batteries'], 
                'wires' => $products['wires'],
                'inverters' => $products['inverters'],
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConfigurationRequest $request) : RedirectResponse
    {
        $config_info = $this->generateConfigInfo($request);
        Configuration::create([
        'user_id' => Auth::id(),
        'solar_panel_id' => $request->get('solar_panel_id'),
        'solar_panel_count' => $request->solar_panel_count,
        'battery_id' => empty($request->get('battery_id')) ? NULL : $request->get('battery_id'),
        'battery_count' => empty($request->get('battery_id')) ? 0 : $request->get('battery_count'),
        'inverter_id' => $request->get('inverter_id'), 
        'inverter_count' => $request->inverter_count,
        'wire_id' => $request->get('wire_id'),
        'wire_count' => $request->wire_count,
        'energy_generated' => $config_info['solar_panel_energy'],
        'equipment_cost' => $config_info['equipment_cost'],
        'installation_cost' => $config_info['labour_cost'],    
        ]);
        
        $configurations = Configuration::where('user_id', Auth::id())->get();
        return redirect(route('configuration.index',))->with('configurations', $configurations);
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration)
    {
        $solar_panel = Product::where('id', $configuration->solar_panel_id)->first();
        $inverter = Product::where('id', $configuration->inverter_id)->first();
        $wire = Product::where('id', $configuration->wire_id)->first();
        if($configuration->battery_id !== NULL) {
            $battery = Product::where('id', $configuration->battery_id)->first();
        } else {
            $battery = '';
        }
        
        return view(
            'configuration.show',
            [
                'configuration' => $configuration,
                'solar_panel' => $solar_panel,
                'inverter' => $inverter,
                'battery' => $battery,
                'wire' => $wire,
                
            ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        $products = $this->fetchProducts();
        $user = Auth::user();
        return view(
            'configuration.edit',
            [
                'configuration' => $configuration,
                'solar_panels' => $products['solar_panels'],
                'batteries' => $products['batteries'], 
                'wires' => $products['wires'],
                'inverters' => $products['inverters'],
                'user' => $user,
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConfigurationRequest $request, Configuration $configuration)
    {
        //
        $config_info = $this->generateConfigInfo($request);
        $configuration->update([
            'solar_panel_id' => $request->get('solar_panel_id'),
            'solar_panel_count' => $request->solar_panel_count,
            'battery_id' => empty($request->get('battery_id')) ? NULL : $request->get('battery_id'),
            'battery_count' => empty($request->get('battery_id')) ? 0 : $request->get('battery_count'),
            'inverter_id' => $request->get('inverter_id'), 
            'inverter_count' => $request->inverter_count,
            'wire_id' => $request->get('wire_id'),
            'wire_count' => $request->wire_count,
            'energy_generated' => $config_info['solar_panel_energy'],
            'equipment_cost' => $config_info['equipment_cost'],
            'installation_cost' => $config_info['labour_cost'],
        ]);
        return redirect(route('configuration.show',[$configuration]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration) /* : RedirectResponse */
    {
        //
        $configuration->delete();
        return redirect(route('configuration.index'));
    }
}
