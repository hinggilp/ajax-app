<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all activities
        $activities = Activity::all();

        return $activities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create activity
        $request->validate([
            'name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'method_id' => 'required',
        ]);
        
        return Activity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get single activity
        return Activity::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // update activity
         $activity = Activity::find($id);
         $activity->update($request->all());
         $activity->status = "Updated Successfully.";
 
         return $activity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete activity
        $activity = Activity::find($id);
        Activity::destroy($id);
        $activity->status = "Deleted Successfully.";

        return $activity;
    }
}
