<?php

namespace App\Http\Controllers;

use App\Http\Requests\InverterRequest;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Inverter;

class InverterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $this->authorize('list', Inverter::class);
        $inverters = Inverter::all();
        return view('inverter.index')->with('inverters', $inverters);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $this->authorize('create', Inverter::class);
        return view('inverter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InverterRequest $request): RedirectResponse
    {
        //
        $this->authorize('create', Inverter::class);

        Inverter::create([
            'Model' => $request->Model,
            'InputPowerWatts' => $request->InputPowerWatts,
            'OutputPowerWatts' => $request->OutputPowerWatts,
            'SizeInches' => $request->SizeInches,
            'FrequencyHz' => $request->FrequencyHz,
            'Efficiency' => $request->Efficiency,
            'Cost' => $request->Cost,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inverter $inverter): View
    {
        //
        $this->authorize('view', $inverter);
        return view('inverter.show', ['inverter' => $inverter]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inverter $inverter)
    {
        //
        $this->authorize('update', $inverter);
        return view('inverter.edit', ['inverter' => $inverter]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InverterRequest $request, Inverter $inverter): RedirectResponse
    {
        //
        $this->authorize('update', $inverter);

        $inverter->update([
            'Model' => $request->Model,
            'InputPowerWatts' => $request->InputPowerWatts,
            'OutputPowerWatts' => $request->OutputPowerWatts,
            'SizeInches' => $request->SizeInches,
            'FrequencyHz' => $request->FrequencyHz,
            'Efficiency' => $request->Efficiency,
            'Cost' => $request->Cost,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inverter $inverter): RedirectResponse
    {
        //
        $this->authorize('delete', $inverter);
        $inverter->delete();
        return redirect(route('products.index'));
    }
}
