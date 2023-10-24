<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HouseInfoRequest;
use App\Models\HouseInfo; //Including the HouseInfo Model.
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HouseInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //Getting a list of all items in the HouseInfo model and diaplying them.
        $house_info = HouseInfo::all();
        return view('house_info.index')->with('house_info', $house_info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('house_info.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HouseInfoRequest $request): RedirectResponse
    {
        $this->authorize('create', HouseInfo::class);

        HouseInfo::create([
            'customer_fName' => $request->fName,
            'customer_lName' => $request->lName,
            'electricity_usage' => $request->electricity,
            'roof_size' => $request->roof_size,
            'roof_slope' => $request->roof_slope,
            'roof_age' => $request->roof_age,
        ]);
        
        return redirect(route('house_info.index'));
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
