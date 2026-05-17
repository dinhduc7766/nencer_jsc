<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    /**
     *  Controller method render view dashboard page.
     * 
     * @return mixed \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function board()
    {
        $callTotal = $this->callTotal();
        return view("pages.dashboard", compact('callTotal'));
    }

    /**
     * Call total.
     * receipt delivery.
     * receipt in stock.
     * receipt out stock.
     * rate profit.
     */
    private function callTotal()
    {
        // Call receipt delivery.
        $receiptDelivery = Receipt::where('status', Receipt::STATUS_PROCESSING)->count();
        // Call receipt in stock.
        $receiptInStock = Receipt::where('type', Receipt::InStock)->count();
        // Call receipt out stock.
        $receiptOutStock = Receipt::where('type', Receipt::OutStock)->count();
        // Call profit.
        $QueryPriceOutStock = Receipt::where('type', Receipt::OutStock)
            ->select('total_price')
            ->pluck('total_price')->toArray();
        $sumPriceOutStock = 0;
        foreach ($QueryPriceOutStock as $price) {
            $sumPriceOutStock += $price;
        }
        $QueryPriceInStock = Receipt::where('type', Receipt::InStock)
            ->select('total_price')
            ->pluck('total_price')->toArray();
        $sumPriceInStock = 0;
        foreach ($QueryPriceInStock as $price) {
            $sumPriceInStock += $price;
        }
        $profit = (($sumPriceOutStock - $sumPriceInStock) / $sumPriceInStock) * 100;
        return [
            'receipt_delivery'  => $receiptDelivery,
            'receipt_in_stock'  => $receiptInStock,
            'receipt_out_stock' => $receiptOutStock,
            'profit'            => $profit
        ];
    }

    public function calChartOutStock(Request $request)
    {
        $month = $request->input('month') ?: now()->format('Y-m');
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = $month === now()->format('Y-m')
            ? now()
            : Carbon::createFromFormat('Y-m', $month)->endOfMonth();
        $days = collect(CarbonPeriod::create($startDate, $endDate))
            ->map(fn($date) => "Ngày " . $date->format('d'))
            ->toArray();
        $inStock = DB::select("
            WITH RECURSIVE dates AS (
                SELECT DATE(?) as day
                UNION ALL
                SELECT DATE_ADD(day, INTERVAL 1 DAY)
                FROM dates
                WHERE day < DATE(?)
            )

            SELECT
                dates.day,
                COALESCE(SUM(r.quantity), 0) as qty
            FROM dates
            LEFT JOIN receipts r
                ON DATE(r.delivery_date) = dates.day
                AND r.type = ?
            GROUP BY dates.day
            ORDER BY dates.day
        ", [
            $startDate,
            $endDate,
            Receipt::InStock
        ]);
        $outStock = DB::select("
            WITH RECURSIVE dates AS (
                SELECT DATE(?) as day
                UNION ALL
                SELECT DATE_ADD(day, INTERVAL 1 DAY)
                FROM dates
                WHERE day < DATE(?)
            )

            SELECT
                dates.day,
                COALESCE(SUM(r.quantity), 0) as qty
            FROM dates
            LEFT JOIN receipts r
                ON DATE(r.delivery_date) = dates.day
                AND r.type = ?
            GROUP BY dates.day
            ORDER BY dates.day
        ", [
            $startDate,
            $endDate,
            Receipt::OutStock
        ]);
        return [
            'day_in_month' => $days,
            'in_stock'     => collect($inStock)->pluck('qty')->toArray(),
            'out_stock'    => collect($outStock)->pluck('qty')->toArray()
        ];
    }
}
