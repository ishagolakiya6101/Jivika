<?php

namespace App\Livewire;

use App\Models\User;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LineChart extends Component
{
    public $days = [];

    public $subscribers = array();
    public $endDate;
    public $startDate;
    protected $listeners = ['updatedStartDate' => 'updatedStartDate'];
    public function mount()
    {
        $this->startDate = Carbon::now()->subDays(7);
        $this->endDate = Carbon::now();
        $this->loadChartData();
    }
    public function loadChartData()
    {
        $userCount = User::rightJoin(DB::raw("(SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c WHERE CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY BETWEEN ? AND ?) as dates"), function ($join) {
            $join->on(DB::raw('DATE(users.created_at)'), '=', 'dates.date');
        })
            ->selectRaw('UNIX_TIMESTAMP(dates.date) * 1000 AS date, COUNT(users.id) AS user_count')
            ->groupBy('dates.date')
            ->orderBy('dates.date')
            ->setBindings([$this->startDate, $this->endDate])
            ->pluck('user_count', 'date')
            ->toArray();

        $this->days = array_keys($userCount);
        $this->subscribers = array_values($userCount);
    }

    public function updatedStartDate()
    {
        dd('dsaf');
        $this->loadChartData();
        $this->emitChartRefresh();
    }

    public function updatedEndDate()
    {
        $this->loadChartData();
        $this->emitChartRefresh();
    }
    public function render()
    {
        return view('livewire.line-chart');
    }

    public function emitChartRefresh()
    {
        $this->emit('refreshChart', [
            'seriesData' => $this->subscribers,
            'categories' => $this->days,
        ]);
    }
}
