<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Inverter;
use App\Models\SolarPanel;
use Illuminate\Http\Request;
use App\Models\Item; // include the Item model
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        // Get a list of all the items in the Item
        // and display them.
        $inverters = Inverter::all();
        $batteries = Battery::all();
        $solar_panels = SolarPanel::all();

        return view('item.index', ['inverters' => $inverters, 'batteries' => $batteries, 'solar_panels' => $solar_panels]);
    }

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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): View
    {
        return view('item.show', ['item' => $item]);
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
