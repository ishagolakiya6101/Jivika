@extends('back_layout')
@section('title')
    <title>Payment Settings | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Payment Settings</h5>
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
                            <h5>Payment Settings</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-user" method="post" action="{{url('admin/payment_settings/update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Tax</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" autocomplete="wewqeqeq" name="tax" placeholder="" @if(!empty($setting)) value="{{$setting['tax']}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Platform Fees</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" autocomplete="wewqeqeq" name="platform_fee" placeholder="" @if(!empty($setting)) value="{{$setting['platform_fee']}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light">Settings</button>
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
    $(document).ready(function(){
        $('#bg_image').change(function(e){
            var file = e.target.files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#bg_image_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $('#logo').change(function(e){
            var file = e.target.files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#logo_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
        $('#favicon').change(function(e){
            var file = e.target.files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#favicon_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection