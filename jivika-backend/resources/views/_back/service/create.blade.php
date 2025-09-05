@extends('back_layout')
@section('title')
<title>Sevice | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Sevice</h5>
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
                            <h5>Sevice</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-service" method="post" action="{{url('admin/services')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="service_id" @if(!empty($service)) value="{{$service->id}}" @endif>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" name="name" placeholder="Service Name" @if(!empty($service)) value="{{$service->name}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div name="description" class="form-control" id="description_quill" placeholder="Enter Description"> @if(!empty($service)) {!! $service->description !!} @endif</div>
                                        <input type="hidden" name="description" id="description" @if(!empty($service)) value="{!! $service->description !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2 @if(empty($categories)) d-none @endif">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="category_id" id="">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" 
                                                @if((!empty($service) && $service->category_id != null && $service->category_id == $category->id)) selected @endif>
                                                {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" autocomplete="wewqeqeq" name="price" placeholder="" @if(!empty($service)) value="{{$service->price}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Offer Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" autocomplete="wewqeqeq" name="offer_price" placeholder="" @if(!empty($service)) value="{{$service->offer_price}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-file-control" name="image" id="image" autocomplete="cqewqeq" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,@if(!empty($service)) {{$service->image}} @else {{$site_data['bg_image']}} @endif" id="image_preview">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light save_service">@if(empty($service))Add @else Update @endif</button>
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
        $('.save_service').click(function(){
            $('#description').attr('value',quill.root.innerHTML);
            $("#add-service").validate({
                rules: {
                    name: "required",
                    category_id: "required",
                    price: "required"
                },
                messages: {
                    name: "Service Name is required.",
                    category_id: "Please select category",
                    price: "Enter price of service"
                }
            });
        })
    });
</script>
@endsection