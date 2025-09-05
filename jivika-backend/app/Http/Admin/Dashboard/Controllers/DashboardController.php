<?php

namespace App\Http\Admin\Dashboard\Controllers;

use App\Charts\LineChart;
use App\Http\Admin\Payment\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $customer_count = User::whereHas('roles', function ($role) {
            $role->whereName('customer');
        })->count();
        $freelancer_count = User::whereHas('roles', function ($role) {
            $role->whereName('freelancer');
        })->count();
        $order_count = Order::all()->count();
        $order_amount = Order::all()->sum('total_amount');
        $chart = new LineChart;
        $toDate = $request->has('to_date') && $request->has('to_date') != null ?  (new Carbon)->parse($request->to_date)->toDateString() : (new Carbon)->now()->toDateString();
        $fromDate = $request->has('from_date') && $request->has('from_date') != null ?  (new Carbon)->parse($request->from_date)->toDateString() : (new Carbon)->now()->subDays(30)->toDateString();
        $userCount = User::rightJoin(DB::raw("(SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c WHERE CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY BETWEEN ? AND ?) as dates"), function ($join) {
            $join->on(DB::raw('DATE(users.created_at)'), '=', 'dates.date');
        })
            ->selectRaw('DATE_FORMAT(dates.date, "%b-%d") AS date, COUNT(users.id) AS user_count')
            ->groupBy('dates.date')
            ->orderBy('dates.date')
            ->setBindings([$fromDate, $toDate])
            ->pluck('user_count', 'date')
            ->toArray();
        $orderCount = Order::rightJoin(DB::raw("(SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c WHERE CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY BETWEEN ? AND ?) as dates"), function ($join) {
            $join->on(DB::raw('DATE(orders.created_at)'), '=', 'dates.date');
        })
            ->selectRaw('DATE_FORMAT(dates.date, "%b-%d") AS date, CAST(COALESCE(SUM(orders.total_amount), 0) AS FLOAT) AS order_amount,COUNT(orders.id) AS order_count')
            ->groupBy('dates.date')
            ->orderBy('dates.date')
            ->setBindings([$fromDate, $toDate])
            ->get();
            // dd($orderCount);
        $chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ], 'chart' => [
                'backgroundColor' => [
                    'linearGradient' => [0, 0, 500, 500],
                    'stops' => [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                ]
                    ],
                    // 'yAxis' => [
                    //     'tickPositions' => [0, 10, 100, 500, 1000, 1500, 2000,2500,3000]
                    // ],
        ]);
        $labels = array_keys($userCount);
        $order_amounts = $orderCount->pluck('order_amount')->toArray();
        $order_counts = $orderCount->pluck('order_count')->toArray();
        $chart->labels($labels);
        $chart->dataset('Customers ', 'spline', array_values($userCount))->color('#373a3c');
        $chart->dataset('Order Value ', 'spline', $order_amounts)->color('green');
        $chart->dataset('Total orders ', 'spline', $order_counts)->color('blue');
        if ($request->ajax()) {
            $date1 = date_create($fromDate);
            $date2 = date_create($toDate);
            $diff  = date_diff($date1, $date2)->d;
            $data =  [
                'customers' => array_values($userCount),
                'order_value' => $order_amounts,
                'total_orders' => $order_counts,
                'labels' => $labels,
                'days' => $diff
            ];
            return response()->json($data);
        }
        return view('_back.dashboard', compact('customer_count', 'freelancer_count', 'order_count', 'order_amount','chart','fromDate','toDate'));
    }
}
