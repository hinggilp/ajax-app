<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Method;

class MethodController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all methods
        $methods = Method::all();

        return $methods;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create method
        $request->validate([
            'name' => 'required',
        ]);
        
        return Method::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get single method
        return Method::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // update method
         $method = Method::find($id);
         $method->update($request->all());
         $method->status = "Updated Successfully.";
 
         return $method;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Method  $method
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete method
        $method = Method::find($id);
        Method::destroy($id);
        $method->status = "Deleted Successfully.";

        return $method;
    }
}