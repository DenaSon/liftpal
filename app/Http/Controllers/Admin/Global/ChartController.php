<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{

    public function getChartData(Request $request)
    {
        $type = $request->input('type');

        $data = $this->calcSales($type);

       return response()->json($data);


    }


    private function calcSales($type ='day')
    {
        $validTypes = ['day', 'week', 'month', 'year'];
        if (!in_array($type, $validTypes)) {
            return false;
        }

        $now = Carbon::now();
        $interval = 'day';
        $step = 1;
        $scale = 14;

        switch ($type) {
            case 'week':
                $interval = 'week';
                $step = 7;
                $scale = 60;
                break;
            case 'month':
                $interval = 'month';
                $step = 30;
                $scale = 183;
                break;
            case 'year':
                $interval = 'year';
                $step = 365;
                $scale = 2190;
                break;
            default:
                $type = 'day';
                $scale = 14;
                break;
        }

        $dailySales = [];
        $numberOfSales = [];
        $dateLabels = [];


        for ($i = 0; $i < ($scale); $i += $step) {
            $startDate = $now->copy()->subDays($i)->startOf($interval);
            $endDate = $now->copy()->subDays($i)->endOf($interval);

            $orders = Order::select('created_at','grand_total','payment_status')
                ->where('payment_status','paid')
                ->whereBetween('created_at', [$startDate, $endDate])->get();

            $totalPrice = $orders->where('payment_status','paid')->sum('grand_total');
            $formattedPrice = $totalPrice;
            $dailySales[] = $formattedPrice;

            $numberOfOrders = $orders->count();
            $numberOfSales[] = $numberOfOrders;

            $jStartDate = jdate($startDate);
            $jEndDate = jdate($endDate);

            if ($interval == 'month') {
                $dateLabels[] = $jStartDate->format('M') . ' - ' . $jEndDate->format('M');
            } elseif ($interval == 'day') {
                $dateLabels[] = $jStartDate->format('y/m/d');
            } elseif ($interval == 'year') {
                $dateLabels[] = $jStartDate->format('Y') . ' - ' . $jEndDate->format('Y');
            } else {
                $dateLabels[] = $jStartDate->format('m/d') . ' - ' . $jEndDate->format('m/d');
            }
        }


            $dailySales = array_reverse($dailySales);
            $numberOfSales = array_reverse($numberOfSales);
            $dateLabels = array_reverse($dateLabels);


        return compact('dailySales', 'numberOfSales', 'dateLabels', 'type');

    }


}
