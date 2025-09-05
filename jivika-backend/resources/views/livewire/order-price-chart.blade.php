<div class="col-sm-6 col-xl-6">
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="content-left">
                    <div class="d-flex justify-content-between">

                        <span>Order Price</span>
                        <!-- <div class="col-md-6 col-12 mb-4 d-flex">
                            <label for="start-date" class="form-label">Start date</label>
                            <input wire:model="startDate" type="datetime-local" id="start-date">
                            <label for="end-date" class="form-label">End date</label>
                            <input wire:model="endDate" type="datetime-local" id="end-date">
                        </div> -->
                    </div>
                    <div class="w-full" style="height: 50%;">
                        <div class="px-10" id="order-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>

    var options = {
        chart: {
            type: 'line',
            height: '250px',
            toolbar: {
                show: false // Disable toolbar
            },
            animations: {
                enabled: false,
            }
        },
        stroke: {
            curve: 'smooth',
        },
        series: [{
            name: 'Order Price',
            data: @json($orderPrice)
        }],
        xaxis: {
            type: 'datetime',
            categories: @json($days)
        }
    }

    var chart = new ApexCharts(document.querySelector("#order-chart"), options);

    chart.render();

    document.addEventListener('livewire:init', () => {
        @this.on('refreshChart', (chartData) => {
            chart.updateSeries([{
                data: chartData.seriesData
            }])
        })
    })
</script>
@endpush