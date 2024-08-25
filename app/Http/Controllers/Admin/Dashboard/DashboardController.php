<?php

namespace App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;


class DashboardController extends Controller
{

    public function index()
    {

        if (!$this->authorize('admin-access'))
        {
            abort(403);
        }


        //Calc today profit or sales percentage
        $todayDiffSales =  $this->getSalesDifference();
        $todaySales =  $this->TodaySales();
        $yesterdaySales = $this->getLastSales('day');
        $lastWeekSales = $this->getLastSales('week');
        $lastMonthSales = $this->getLastSales('month');
        $lastYearSales = $this->getLastSales('year');
        //count sales
        $todaySalesCount = $this->counter('salesCountToday');
        $salesSum= $this->counter('salesSum');
        $salesCount = $this->counter('SalesCount');
        $conversionRate = $this->counter('conversionRate');
        //count customers
        $customers = $this->counter('customers');
        $new_comments  = Comment::whereStatus('hidden')->get();
        //Best Customers
         if (request()->query('order') == 'sum')
         {
             $bestCustomers =  $this->bestCustomers('sumTotalPrice') ?? [];
         }
         else
         {
             $bestCustomers =  $this->bestCustomers('orders');
         }
         //best products
        if (request()->query('bestProducts') == 'inorders') {
            $bestProducts = $this->bestProducts('orders');
        }
        else
        {
            $bestProducts = $this->bestProducts('products');
        }

            return view('admin.dashboard.index',compact(['todayDiffSales',
            'todaySales',
            'new_comments',
            'yesterdaySales',
            'conversionRate',
            'customers',
            'bestCustomers',
            'bestProducts',
            'todaySalesCount',
            'salesSum',
            'salesCount',
            'lastWeekSales',
            'lastMonthSales',
            'lastYearSales']));
    }


/**
 * Calculates the percentage difference between today's sales and yesterday's sales.
 *
 * @return float
 */
    public function getSalesDifference(): float
{
    $today = Carbon::now()->today();
    $yesterday = Carbon::now()->yesterday();

    $totalSalesToday = Order::whereDate('created_at', $today)
        ->where('payment_status','paid')
        ->sum('grand_total') ?? 0;
    $totalSalesYesterday = Order::whereDate('created_at', $yesterday)
        ->where('payment_status','paid')
        ->sum('grand_total') ?? 0;

    if ($totalSalesYesterday == 0) {
        return 0;
    }

    $salesPercentageDifference = (($totalSalesToday - $totalSalesYesterday) / $totalSalesYesterday) * 100;

    return max(0, $salesPercentageDifference);
}


    private function TodaySales()
    {
        $today = Carbon::today();

        $totalSalesToday = Order::where('payment_status','paid')->whereDate('created_at', $today)->sum('grand_total');
        return $totalSalesToday ?? 0;
    }


    private function getLastSales($time)
    {
        $lastSales = 0;
        $startDateTime = null;
        $endDateTime = null;

        switch ($time) {
            case 'week':
                $startDateTime = Carbon::now()->subWeek()->startOfWeek();
                $endDateTime = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'day':
                $startDateTime = Carbon::yesterday()->startOfDay();
                $endDateTime = Carbon::yesterday()->endOfDay();
                break;
            case 'month':
                $startDateTime = Carbon::now()->subMonth()->startOfMonth();
                $endDateTime = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'year':
                $startDateTime = Carbon::now()->subYear()->startOfYear();
                $endDateTime = Carbon::now()->subYear()->endOfYear();
                break;
        }

        if ($startDateTime && $endDateTime) {
            $totalSales = Order::where('payment_status','paid')->whereBetween('created_at', [$startDateTime, $endDateTime])
                ->selectRaw('SUM(grand_total) as total_sales')
                ->first()
                ->total_sales;
            $lastSales = $totalSales;
        }

        return $lastSales;
    }

    private function counter($type ='salesSum')
    {
        if ($type == 'salesSum')
        {
           return Order::where('payment_status','paid')->select('grand_total')->sum('grand_total');
        }
        if ($type == 'salesCountToday')
        {
            return Order::where('payment_status','paid')->whereDate('created_at', Carbon::today())->count('id');
        }


        if ($type == 'SalesCount')
        {
            return Order::select('id','payment_status')->where('payment_status','paid')->count('id');
        }
        if ($type == 'customers')
        {
            return User::select('id','role')->where('role','customer')->count('id');
        }
        if ($type == 'conversionRate')
        {
            $views = Product::select('views')->sum('views');
            $sales =  $this->counter('SalesCount') ?? 1;

              return  $conversionRate = $views > 0 ? (($sales / $views) * 100) : 0;



        }

    }

    private function bestCustomers($type)
{
   $query = User::with(['orders', 'profile'])
           ->whereHas('orders', function ($query) {
               $query->where('payment_status', 'paid');
           })
           ->withCount('orders');

   if ($type == 'orders')
   {
       $users = $query->orderByDesc('orders_count')
           ->get();
   }
   else
   {
       $users = $query->withSum('orders', 'grand_total')
           ->orderByDesc('orders_sum_grand_total')
           ->get();
   }
    return $users;
}

    private function bestProducts($type)
    {

        $products = Product::withCount('history as order_count')
            ->orderByDesc('order_count')
            ->take(10)
            ->get();
        return $products;


    }



}

















