<?php

namespace App\Http\Controllers;

use App\Models\Avg;
use Illuminate\Http\Request;

class AvgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Avg::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avg  $avg
     * @return \Illuminate\Http\Response
     */
    public function show(Avg $avg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avg  $avg
     * @return \Illuminate\Http\Response
     */
    public function edit(Avg $avg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avg  $avg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avg $avg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avg  $avg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avg $avg)
    {
        //
    }
}
