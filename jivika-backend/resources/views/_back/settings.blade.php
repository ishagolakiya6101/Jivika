@extends('back_layout')
@section('title')
    <title>Settings | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Settings</h5>
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
                            <h5>Settings</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-user" method="post" action="{{url('admin/settings/update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Site Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" value="{{$site_data['site_name']}}" name="name" placeholder="Site Name">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Background Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-file-control" name="bg_image" id="bg_image" autocomplete="cqewqeq" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="50" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,{{$site_data['bg_image']}}" id="bg_image_preview">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-file-control" name="logo" id="logo" placeholder="Enter Name" autocomplete="cqewqeq" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="50" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,{{$site_data['logo']}}" id="logo_preview">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Favicon</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-file-control" id="favicon" autocomplete="qweqeqe" name="favicon" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="50" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,{{$site_data['favicon']}}" id="favicon_preview">
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