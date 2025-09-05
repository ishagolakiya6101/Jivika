
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="content-left">
                    <div class="d-flex justify-content-between">
                        <span>Orders</span>
                    </div>

                    <div class="w-full" style="height: 50%;">
                        <div id="donut-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('js')
<script>
    console.log(@json($data));
    var options = {
        chart: {
            type: 'donut',
        },
        series: @json($data),
        labels: @json($labels),
    };

    var donut_chart = new ApexCharts(document.querySelector("#donut-chart"), options);
    donut_chart.render();
</script>
@endpush