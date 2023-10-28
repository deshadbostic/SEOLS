<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatteryRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Battery;


class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $this->authorize('list', Battery::class);
        $batteries = Battery::all();
        return view('battery.index')->with('batteries', $batteries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $this->authorize('create', Battery::class);
        return view('battery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BatteryRequest $request): RedirectResponse
    {
        //
        $this->authorize('create', Battery::class);

        Battery::create([
            'Model' => $request->Model,
            'CapacityAh' => $request->CapacityAh,
            'VoltageV' => $request->VoltageV,
            'RatingWh' => $request->RatingWh,
            'WeightLbs' => $request->WeightLbs,
            'Cost' => $request->Cost,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Battery $battery): View
    {
        //
        $this->authorize('view', $battery);
        return view('battery.show', ['battery' => $battery]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Battery $battery)
    {
        //
        $this->authorize('update', $battery);
        return view('battery.edit', ['battery' => $battery]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BatteryRequest $request, Battery $battery): RedirectResponse
    {
        //
        $this->authorize('update', $battery);

        $battery->update([
            'Model' => $request->Model,
            'CapacityAh' => $request->CapacityAh,
            'VoltageV' => $request->VoltageV,
            'RatingWh' => $request->RatingWh,
            'WeightLbs' => $request->WeightLbs,
            'Cost' => $request->Cost,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Battery $battery): RedirectResponse
    {
        //
        $this->authorize('delete', $battery);
        $battery->delete();
        return redirect(route('products.index'));
    }
}
