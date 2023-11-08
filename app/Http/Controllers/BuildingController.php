<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Traits\BuildingHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{

    use BuildingHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user= Auth::user();
        $buildings = Building::whereBelongsTo($user)->get();
        return view('building.index')->with('buildings', $buildings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('building.create')->with('batteries', 'f');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try
		{
			$validated = $request->validate([
				'name' => 'required',
			]);
			
			$request->user()->building()->create($validated);	
		}
		catch (\Exception)
		{
			//error handling
		}
		
		return redirect(route('building.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        //
        return view('building.edit')->with('batteries', 'f');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        //

    }
}
