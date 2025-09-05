@extends('back_layout')
@section('title')
<title>Dashboard | {{$site_data['site_name']}}</title>
@endsection
@section('content')

<div class="row g-4 mb-4">
    <div class="col-sm-6">
        <div class="row pb-2">
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Customers</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{$customer_count}}</h4>
                                    <span class="text-success"></span>
                                </div>
                                <span>Total Customers</span>
                            </div>
                            <span class="badge rounded p-2">
                                <img src="data:image/x-icon;base64,{{$site_data['favicon']}}" width="40" alt="">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Freelancers</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{$freelancer_count}}</h4>
                                </div>
                                <span>Total Freelancers</span>
                            </div>
                            <span class="badge rounded p-2">
                                <img src="data:image/x-icon;base64,{{$site_data['favicon']}}" width="40" alt="">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Orders</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$order_count}}</h4>
                            </div>
                            <span>Total Orders</span>
                        </div>
                        <span class="badge rounded p-2">
                            <img src="data:image/x-icon;base64,{{$site_data['favicon']}}" width="40" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Order Amount</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$order_amount}}</h4>
                                <!-- <span class="text-danger">(-14%)</span> -->
                            </div>
                            <span>Total Order Amount</span>
                        </div>
                        <span class="badge rounded p-2">
                            <img src="data:image/x-icon;base64,{{$site_data['favicon']}}" width="40" alt="">

                        </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-sm-6">
<livewire:order-chart />
    </div>

</div>
<div class="col-sm-12 col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="">
                <div class="content-left">
                    <div class="d-flex justify-content-between">
                        <span>Customers</span>
                        <div class="col-md-6 col-12 mb-4">
                            <form class="form-inline float-right d-flex">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="staticEmail2">From : </label>
                                    <input type="text" id="from_date" class="form-control" value="{{$fromDate}}">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2">To : </label>
                                    <input type="text" id="to_date" class="form-control" value="{{$toDate}}">
                                </div>
                                <button type="button" onclick="chartDatechange()" class="filterChart btn btn-primary mb-1 mt-4">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="w-full" style="height: 50%;">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! $chart->script() !!}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
  $("#from_date").datepicker({
    dateFormat: "yy-mm-dd", // Set date format
    changeMonth: true,       // Allow changing of months
    changeYear: true         
  });
  $("#to_date").datepicker({
    dateFormat: "yy-mm-dd", // Set date format
    changeMonth: true,       // Allow changing of months
    changeYear: true,
    maxDate: 0      
  });
});
    function chartDatechange() {
        $.ajax({
            url: "{{route('admin.dashboard')}}",
            data: {
                _token: '{{ csrf_token() }}',
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            }
        }).done(function(data) {
            console.log(data);
            {{$chart->id}}.series[0].setData(data.customers, true);
            {{$chart->id}}.series[1].setData(data.order_value, true);
            {{$chart->id}}.series[2].setData(data.total_orders, true);
            {{$chart->id}}.xAxis[0].setCategories(data.labels);
        });
    };
</script>
@livewireScriptConfig
@livewireScripts
@stack('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection