<?php

namespace App\Livewire;

use App\Http\Admin\Payment\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderPriceChart extends Component
{
    public $days = [];

    public $orderPrice = array();
    public $endDate;
    public $startDate;
    public function mount()
    {
        $this->startDate = Carbon::now()->subDays(7);
        $this->endDate = Carbon::now();
        $this->loadChartData();
    }
    public function loadChartData()
    {
        $orderCount = Order::rightJoin(DB::raw("(SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c WHERE CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY BETWEEN ? AND ?) as dates"), function ($join) {
            $join->on(DB::raw('DATE(orders.created_at)'), '=', 'dates.date');
        })
            ->selectRaw('UNIX_TIMESTAMP(dates.date) * 1000 AS date, COALESCE(SUM(orders.total_amount), 0) AS order_count')
            ->groupBy('dates.date')
            ->orderBy('dates.date')
            ->setBindings([$this->startDate, $this->endDate])
            ->pluck('order_count', 'date')
            ->toArray();

        $this->days = array_keys($orderCount);
        $this->orderPrice = array_values($orderCount);
        // dd($this);
    }
    public function render()
    {
        return view('livewire.order-price-chart');
    }
}
