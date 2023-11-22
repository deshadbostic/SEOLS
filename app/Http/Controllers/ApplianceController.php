<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApplianceHelper;
use App\Models\Room;
use App\Models\Building;
use App\Models\Appliance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplianceController extends Controller
{
    use ApplianceHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $buildings = Building::whereBelongsTo($user)->get();
        $rooms = Room::whereBelongsTo($buildings[0])->get();
        $appliances = Appliance::whereBelongsTo($rooms[0])->get();
        return view('appliance.index')->with(['buildings' => $buildings, 'rooms' => $rooms, 'appliances' => $appliances]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        $rooms = Room::whereBelongsTo($building)->get();
        return view('appliance.create')->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $room = Room::find($request->room);
            $validated = $request->validate([
                'name' => 'required',
                'wattage' => 'required|numeric',
            ]);
            $room->appliance()->create($validated);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            //error handling
        }
        return redirect(route('room.show',$room));
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
    public function edit(Appliance $appliance)
    {
        $user = Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        $rooms = Room::whereBelongsTo($building)->get();
        return view('appliance.edit')->with('appliance', $appliance)->with('rooms',$rooms);
    }
    public function dedit(Request $request)
    {
        return redirect(route('appliance.edit'));
    }

    public function delete(Request $request)
    {
        return redirect(route('appliance.delete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appliance $appliance)
    {
        //
        try {
            $room = Room::find($request->room);
            $validated = $request->validate([
                'name' => 'required',
                'wattage' => 'required|numeric',
            ]);
            $room->appliance()->update($validated);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            //error handling
        }
        
        return redirect(route('room.show',$room));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appliance $appliance)
    {
        $room = Room::where('id', $appliance->room_id)->first();
        $appliance->delete();
        return redirect(route('room.show',$room));  
    }
}
