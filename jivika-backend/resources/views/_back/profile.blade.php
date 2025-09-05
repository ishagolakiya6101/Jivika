@extends('back_layout')
@section('title')
    <title>Profile | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
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
                            <h5>Profile</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-user" method="post" action="{{url('admin/user/update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" value="{{auth()->guard('admin')->user()->name}}" name="name" placeholder="Enter your Name">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" value="{{auth()->guard('admin')->user()->email}}" name="email" placeholder="Email" readonly>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light">Update</button>
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