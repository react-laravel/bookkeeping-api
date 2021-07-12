<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBill;
use App\Models\Bill;
use App\Models\Avg;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index(Request $request): Collection
    {
        $query = Bill::orderByDesc('created_at');
        if ($size = $request->query('size')) {
            $query->take($size);
        }

        return $query->get();
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
        $startTime = strtotime($request->start_date);
        $endTime = strtotime($request->end_date);

        $months = [$request->start_date];

        while (($startTime = strtotime('+1 month', $startTime)) <= $endTime) {
            $months[] = date('Y-m', $startTime);
        }

        $avg = (int) ($request->money / count($months));

        Bill::create(array_merge($request->all(), ['avg' => $avg]));

        foreach ($months as $month) {
            \Log::info($months);
            $row = Avg::whereDate('month', $month.'-01')->first();

            if ($row) {
                $row->increment('money', $avg);
            } else {
                \Log::info('创建');
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

    public function diff($start_date, $end_date)
    {
        $from = Carbon::parse($start_date);
        $to = Carbon::parse($end_date);

        return $from->diffInMonths($to);
    }

    public function info(): array
    {
        $nextMonth = Carbon::now()->addMonth()->format('Y-m');

        $lastThreeMonthMoney = $this->lastThreeMonthMoney();

        if(array_key_exists($nextMonth, $lastThreeMonthMoney->toArray()) === false){
            $lastThreeMonthMoney[] = [
                'id' => -1,
                'month' => $nextMonth,
                'money' => 0,
            ];
        }

        return [
            'lastThreeMonthMoney' => $lastThreeMonthMoney,
            'nextMonthRenewalMoney' => $this->nextMonthRenewalMoney(),
        ];
    }

    public function lastThreeMonthMoney()
    {
        $start = Carbon::now()->startOfMonth()->subMonth();
        $end = Carbon::now()->endOfMonth()->addMonth();

        return Avg::whereBetween('month', [$start, $end])->get(['id', 'month', 'money']);
    }


    public function currentMonthMoney()
    {
        return Avg::whereYear('month', '=', date('Y'))
            ->whereMonth('month', '=', date('m'))->value('money');
    }

    public function nextMonthRenewalMoney()
    {
        return Bill::whereYear('end_date', '=', date('Y'))
            ->whereMonth('end_date', '=', date('m'))->where('is_renewal', 1)->sum('money');
    }
}
