<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\SolarPanel;


class SolarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $this->authorize('list', SolarPanel::class);
        $solarpanels = SolarPanel::all();
        return view('solarpanel.index')->with('solarpanels', $solarpanels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $this->authorize('create', SolarPanel::class);
        return view('solarpanel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolarRequest $request): RedirectResponse
    {
        //
        $this->authorize('create', SolarPanel::class);

        SolarPanel::create([
            'Model' => $request->Model,
            'Warranty' => $request->Warranty,
            'Durability' => $request->Durability,
            'Cost' => $request->Cost,
            'EnergyOutputWatts' => $request->EnergyOutputWatts,
            'DimensionsInches' => $request->DimensionsInches,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SolarPanel $solarpanel): View
    {
        //
        $this->authorize('view', $solarpanel);
        return view('solarpanel.show', ['solarpanel' => $solarpanel]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolarPanel $solarpanel)
    {
        //
        $this->authorize('update', $solarpanel);
        return view('solarpanel.edit', ['solarpanel' => $solarpanel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolarRequest $request, SolarPanel $solarpanel): RedirectResponse
    {
        //
        $this->authorize('update', $solarpanel);

        $solarpanel->update([
            'Model' => $request->Model,
            'Warranty' => $request->Warranty,
            'Durability' => $request->Durability,
            'Cost' => $request->Cost,
            'EnergyOutputWatts' => $request->EnergyOutputWatts,
            'DimensionsInches' => $request->DimensionsInches,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolarPanel $solarpanel): RedirectResponse
    {
        //
        $this->authorize('delete', $solarpanel);
        $solarpanel->delete();
        return redirect(route('products.index'));
    }
}
