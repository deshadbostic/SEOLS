<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Battery;


class BatteryController extends Controller
{
    public function index(): View
    {
        $batteries = Battery::all();

        return view('inverter.index', [ 'batteries' => $batteries]);   
    }


    // Show the form to create a new battery
    public function create()
    {
        return view('batteries.create');
    }

    // Store a newly created battery in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model' => 'required|string',
            'capacityAh' => 'required|numeric',
            'voltageV' => 'required|string',
            'ratingWh' => 'required|numeric',
            'weightLbs' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);

        Battery::create($validatedData);

        return redirect('/batteries')->with('success', 'Battery created successfully.');
    }
}
