@extends('back_layout')
@section('title')
<title>Discount | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Discount</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Discount</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-discount" method="post" action="{{url('admin/discount')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="discount_id" @if(!empty($discount)) value="{{$discount->id}}" @endif>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" name="code" placeholder="Enter discount code" @if(!empty($discount)) value="{{$discount->code}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                    <input class="form-control" id="start_date" name="start_date" @if(!empty($discount)) value="{{$discount->start_date}}" @endif placeholder="MM/DD/YYY" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">End Date</label>
                                    <div class="col-sm-9">
                                    <input class="form-control" id="end_date" name="end_date" @if(!empty($discount)) value="{{$discount->end_date}}" @endif placeholder="MM/DD/YYY" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Discount Value</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" min="0" name="value" placeholder="Enter discount value" @if(!empty($discount)) value="{{$discount->value}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Discount Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="type">
                                            <option value="">Select Discount Type</option>
                                                <option value="fix" @if(!empty($discount) && $discount->type == "fix") selected @endif>Fix</option>
                                                <option value="percentage" @if(!empty($discount) && $discount->type == "percentage") selected @endif>Percentage</option>
                                        </select>
                                    <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Max. Users</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" min="0" step="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="max_users_limit" placeholder="" @if(!empty($discount)) value="{{$discount->max_users_limit}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Limit Per user</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" min="0" step="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="max_limit" placeholder="" @if(!empty($discount)) value="{{$discount->max_limit}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light save_discount">@if(empty($discount))Add @else Update @endif</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.save_discount').click(function(){
            $("#add-discount").validate({
                rules: {
                    name: "required",
                    category_id: "required",
                    price: "required"
                },
                messages: {
                    name: "Service Name is required.",
                    category_id: "Please select category",
                    price: "Enter price of discount"
                }
            });
        })
        var start_date_input=$('input[name="start_date"]'); 
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true
        };
        start_date_input.datepicker(options);
        var end_date_input=$('input[name="end_date"]');
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            yearRange: '1999:c',
            todayHighlight: true,
            autoclose: true
        };
        end_date_input.datepicker(options);
        // var options={
        //     format: 'mm/dd/yyyy',
        //     container: container,
        //     yearRange: '1999:2030',
        //     todayHighlight: true,
        //     autoclose: true
        // };
        // end_date_input.datepicker(options);
        // start_date_input.change(function(){
        //     var date = $(this).val();
        //     // end_date_input.datepicker('options','minDate',date);
        // });
    })
</script>
@endsection