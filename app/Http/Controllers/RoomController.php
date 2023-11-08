<?php

namespace App\Http\Controllers;

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
        //
        $user= Auth::user();
        $buildings = Building::whereBelongsTo($user)->get();
        $rooms=Room::whereBelongsTo($buildings[0])->get();
        return view('room.index')->with(['buildings'=> $buildings,'rooms'=>$rooms] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('room.index')->with('batteries', 'f');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Room::create([
        //     'name' =>$request->room_name,
        //     'building_id' => $request->building_id
        // ]);

    $building=
			$validated = $request->validate([
				'name' => 'required',
                'building_id' => 'required',
			]);
            $user= Auth::user();
            $buildings = Building::whereBelongsTo($user)->get();
			$buildings[0]->room()->create($validated);	
	
	
		
		return redirect(route('room.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

     public function dedit(Request $request)
    {
        return redirect(route('room.edit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $room=Room::where("id",$request->roomid)->get();
        //
        return view('room.edit')->with('room', $room);
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
    public function destroy(Request $request)
    {
        $room=Room::where("id",$request->roomid)->get();
        $room->delete();
        return view('room.index')->with('room', $room);
    }
}
