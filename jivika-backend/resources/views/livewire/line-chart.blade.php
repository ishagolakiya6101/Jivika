<div class="col-sm-6 col-xl-6">
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="content-left">
                    <div class="d-flex justify-content-between">

                        <span>Customers</span>
                        <div class="col-md-6 col-12 mb-4">
                            <button wire:click="$emit('updatedStartDate')">startdate</button>
                            <label for="flatpickr-range" class="form-label">Range Picker</label>
                            <input wire:model.live="startDate" wire:click="$emit('updatedStartDate')" type="text" id="start-date" placeholder="Start Date">
                            <input wire:model.live="endDate" type="text" id="end-date" placeholder="End Date">
                        </div>
                    </div>
                    <div class="w-full" style="height: 50%;">
                        <div class="px-10" id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#start-date, #end-date").datepicker();
        $('body').on('change','#start-date',function() {
            Livewire.dispatch('updatedStartDate');
        });
    });
    // document.addEventListener('livewire:load', function () {
    //         flatpickr("#start-date", {
    //             dateFormat: "Y-m-d",
    //             onChange: function(selectedDates, dateStr, instance) {
    //                 @this.set('startDate', dateStr);
    //             }
    //         });

    //         flatpickr("#end-date", {
    //             dateFormat: "Y-m-d",
    //             onChange: function(selectedDates, dateStr, instance) {
    //                 @this.set('endDate', dateStr);
    //             }
    //         });
    //     });

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
            name: 'Customers',
            data: @json($subscribers)
        }],
        xaxis: {
            type: 'datetime',
            categories: @json($days)
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

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