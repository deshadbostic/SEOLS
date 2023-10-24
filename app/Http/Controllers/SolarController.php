<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\SolarPanel;


class SolarController extends Controller
{
    public function index(): View
    {
        $solarPanels = SolarPanel::all();

        return view('inverter.index', ['solarPanels' => $solarPanels]);  
    }


    // Show the form to create a new battery
    public function create()
    {
        return view('solarpanel.create');
    }

    // Store a newly created battery in the database 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Warranty' => 'required|string',
            'Durability' => 'required|string',
            'Model' => 'required|string',
            'Cost' => 'required|numeric',
            'EnergyOutputWatts' => 'required|numeric',
            'DimensionsInches' => 'required|string',
        ]);

        SolarPanel::create($validatedData);

        return redirect('/solarpanel')->with('success', 'Panel created successfully.');
    }
}