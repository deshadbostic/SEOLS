<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Inverter;
use App\Models\Battery;
use App\Models\SolarPanel;

class InverterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
        $inverters = Inverter::all();
        $batteries = Battery::all();
        $solarPanels = SolarPanel::all();

        return view('inverter.index', ['inverters' => $inverters, 'batteries' => $batteries, 'solarPanels' => $solarPanels]);    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
