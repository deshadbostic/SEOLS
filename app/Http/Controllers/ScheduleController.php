<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule; // include the Schedule model
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ScheduleController extends Controller
{

   public function index(): View
   {
   // Get a list of all the items in the Item
   // and display them.
   $schedule = Schedule::all();
   return view('schedule.index')->with('schedules', $schedule);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(): View
   {
       return view('schedule.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(ScheduleRequest $request): RedirectResponse
   {
       $user_id = Auth::user()->id;
       $user_fName = Auth::user()->first_name;
       $user_lName = Auth::user()->last_name;
       
       if (($user_fName == NULL) || $user_lName == NULL) {
           return redirect(route('schedule.nameError'));
       } 
       
       Schedule::updateOrCreate(
           ['id' => $user_id],
           [
               'fName' => $user_fName,
               'lName' => $user_lName,
               'address' => $request->address,
               'DOA' => $request->date,
               'time' => $request->time,
               'directions' => $request->directions
           ]);
       return redirect(route('schedule.index'));
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function nameError(): View
   {
       return view('schedule.nameError');
   }
}
