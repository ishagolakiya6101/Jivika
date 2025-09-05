<?php

namespace App\Livewire;

use App\Http\Admin\Payment\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderChart extends Component
{
    public $data,$labels;

    public function mount()
    {
        // Fetch data for your chart
        $orders = Order::select(
            DB::raw('COUNT(*) as count'),
            'status'
        )
        ->groupBy('status')
        ->pluck('count', 'status')->toArray();
        $this->data = array_values($orders); // Replace YourModel with your actual model
        $this->labels = array_keys($orders);
    }

    public function render()
    {
        return view('livewire.order-chart');
    }
}
