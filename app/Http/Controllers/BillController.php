<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBill;
use App\Models\Bill;
use App\Models\Avg;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillController extends Controller
{
    public function index(): Collection
    {
        return Bill::orderByDesc('created_at')->take(5)->get();
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
     */
    public function store(StoreBill $request)
    {
        Bill::create($request->all());

        $startTime = strtotime($request->startDate);
        $endTime = strtotime($request->endDate);

        $months = [$request->startDate];

        while (($startTime = strtotime('+1 month', $startTime)) <= $endTime) {
            $months[] = date('Y-m', $startTime);
        }

        $avg = (int) ($request->money / count($months));

        foreach ($months as $month) {
            $row = Avg::whereDate('month', $month.'-01')->first();
            if ($row->isNotEmpty()) {
                $row->increment('money', $avg);
            } else {
                Avg::create([
                    'month' => $month,
                    'money' => $avg,
                ]);
            }
        }
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

    public function diff($startDate, $endDate)
    {
        $from = Carbon::parse($startDate);
        $to = Carbon::parse($endDate);

        return $from->diffInMonths($to);
    }
}
