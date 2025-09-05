@extends('back_layout')
@section('title')
<title>Package | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Package</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>Package</h5>

                </div>
                <div class="card-block p-3">
                    <form id="add-package" method="post" action="{{url('admin/packages')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="service_package_id" @if(!empty($package)) value="{{$package->id}}" @endif>
                            <div class="col-6">

                                <div class="form-group row mb-2">
                                    <label class="col-form-label">Name</label>
                                    <div class="">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" name="name" placeholder="Package Name" @if(!empty($package)) value="{{$package->name}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2 @if(empty($services)) d-none @endif">
                                    <label class="col-form-label">Service</label>
                                    <div class="">
                                        <select class="form-select" name="service_id" id="">
                                            <option value="">Select Service</option>
                                            @foreach($services as $service)
                                            <option value="{{$service->id}}" @if((!empty($package) && $package->service_id != null && $package->service_id == $service->id)) selected @endif>
                                                {{$service->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label">Description</label>
                                    <div class="">
                                        <div name="description" class="form-control" id="description_quill" placeholder="Enter Description"> @if(!empty($package)) {!! $package->description !!} @endif</div>
                                        <input type="hidden" name="description" id="description" @if(!empty($package)) value="{!! $package->description !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label">How it works</label>
                                    <div class="">
                                        <div name="how_work" class="form-control" id="how_work_quill" placeholder="Enter Excluded"> @if(!empty($package)) {!! $package->how_work !!} @endif</div>
                                        <input type="hidden" name="how_work" id="how_work" @if(!empty($package)) value="{!! $package->how_work !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row mb-2">
                                    <label class="col-form-label">Included</label>
                                    <div class="">
                                        <div name="included" class="form-control" id="included_quill" placeholder="Enter Included"> @if(!empty($package)) {!! $package->included !!} @endif</div>
                                        <input type="hidden" name="included" id="included" @if(!empty($package)) value="{!! $package->included !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label">Excluded</label>
                                    <div class="">
                                        <div name="excluded" class="form-control" id="excluded_quill" placeholder="Enter Excluded"> @if(!empty($package)) {!! $package->excluded !!} @endif</div>
                                        <input type="hidden" name="excluded" id="excluded" @if(!empty($package)) value="{!! $package->excluded !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label class="col-form-label">Price</label>
                                        <div class="">
                                            <input type="number" class="form-control" autocomplete="wewqeqeq" name="price" id="price" placeholder="" @if(!empty($package)) value="{{$package->price}}" @endif>
                                            <span class="messages"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label class="col-form-label">Duration</label>
                                        <div class="">
                                            <input type="text" class="form-control" autocomplete="wewqeqeq" name="duration" id="duration" placeholder="" @if(!empty($package)) value="{{$package->duration}}" @endif>
                                            <span class="messages"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label">Image</label>
                                    <div class="">
                                        <input type="file" class="form-file-control" name="image" id="image" autocomplete="cqewqeq" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,@if(!empty($package)) {{$package->image}} @else {{$site_data['bg_image']}} @endif" id="image_preview">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light save_package">@if(empty($package))Add @else Update @endif</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#image').change(function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#image_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var quill = new Quill('#description_quill', {
            theme: 'snow'
        });
        var quill1 = new Quill('#included_quill', {
            theme: 'snow'
        });
        var quill2 = new Quill('#excluded_quill', {
            theme: 'snow'
        });
        var quill3 = new Quill('#how_work_quill', {
            theme: 'snow'
        });
        $('.save_package').click(function() {
            $('#description').attr('value', quill.root.innerHTML);
            $('#included').attr('value', quill1.root.innerHTML);
            $('#excluded').attr('value', quill2.root.innerHTML);
            $('#how_work').attr('value', quill3.root.innerHTML);
            $("#add-package").validate({
                rules: {
                    name: "required",
                    service_id: "required",
                    price: "required"
                },
                messages: {
                    name: "Package Name is required.",
                    service_id: "Please select service",
                    price: "Enter price of package"
                }
            });
        })
    });
</script>
@endsection