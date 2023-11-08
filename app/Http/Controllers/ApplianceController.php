<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApplianceHelper;
use App\Models\Room;

class ApplianceController extends Controller
{
    use ApplianceHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('appliance.index')->with('batteries', 'f');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('appliance.index')->with('batteries', 'f');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
		{
			$room = Room::find($request->room_id);

			$validated = $request->validate([
				'name' => 'required',
				'wattage' => 'required|numeric', 
			]);
					
			$room->appliance()->create($validated);
		}
		catch (\Exception $ex)
		{
			echo $ex->getMessage();
			//error handling
		}
		return redirect(route('appliance.create'));
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
        return view('appliance.edit')->with('batteries', 'f');
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
