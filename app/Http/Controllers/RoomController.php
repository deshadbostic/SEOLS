<?php

namespace App\Http\Controllers;

use App\Models\Appliance;
use Illuminate\Http\Request;
use App\Models\Room; 
use App\Traits\RoomHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Building;
class RoomController extends Controller
{
    use RoomHelper;
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room.index', $this->getIndexInfo());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user= Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        Room::create(
            [
                'name' =>$request->room_name,
                'building_id' => $building->id,
            ]
        );	
		return redirect(route('building.show', ['building' => $building]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $appliances = Appliance::where('room_id', $room->id)->get();
        return view('room.show',['room' => $room, 'appliances' => $appliances]);
    }

     public function dedit(Request $request)
    {
        return redirect(route('room.edit'));
    }

    public function delete(Request $request)
    {
        return redirect(route('room.delete'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('room.edit')->with('room', $room);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $user= Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        $room->update([
            'name' => $request->new_room_name,
            'building_id' => $building->id,
        ]);
        return redirect(route('building.show', ['building' => $building]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        $user= Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        return redirect(route('building.show', ['building' => $building]));
    }
}
