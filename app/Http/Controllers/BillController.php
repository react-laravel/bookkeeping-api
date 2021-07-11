<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Http\Requests\StoreBill;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillController extends Controller
{
    public function index(): Collection
    {
        return Bill::orderByDesc('created_at')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBill  $request
     * @return void
     */
    public function store(StoreBill $request): void
    {
        Bill::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Bill  $bill
     * @return Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bill  $bill
     * @return Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
