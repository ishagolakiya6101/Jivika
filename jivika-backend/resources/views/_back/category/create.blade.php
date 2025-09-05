@extends('back_layout')
@section('title')
<title>Category | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Category</h5>
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
                            <h5>Category</h5>

                        </div>
                        <div class="card-block p-3">
                            <form id="add-category" method="post" action="{{url('admin/category')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="category_id" @if(!empty($category)) value="{{$category->id}}" @endif>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" autocomplete="wewqeqeq" name="name" placeholder="Category Name" @if(!empty($category)) value="{{$category->name}}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div name="description" class="form-control" id="description_quill" placeholder="Enter Description"> @if(!empty($category)) {!! $category->description !!} @endif</div>
                                        <input type="hidden" name="description" id="description" @if(!empty($category)) value="{!! $category->description !!}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2 @if(empty($categories)) d-none @endif">
                                    <label class="col-sm-3 col-form-label">Parent Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="parent_id" id="">
                                            <option value="">Select Parent Category</option>
                                            @foreach($categories as $category_data)
                                                <option value="{{$category_data->id}}" 
                                                @if((!empty($category) && $category->parent_id != null && $category->parent_id == $category_data->id)) selected @endif>
                                                {{$category_data->name}}</option>
                                            @endforeach
                                        </select>
                                    <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label">Category Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-file-control" name="image" id="image" autocomplete="cqewqeq" accept="image/*">
                                        <span class="messages"></span>
                                        <img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="data:image/png;base64,@if(!empty($category)) {{$category->image}} @else {{$site_data['bg_image']}} @endif" id="image_preview">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light save_category">@if(empty($category)) Add @else Update @endif</button>
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
        $('.save_category').click(function(){
            $('#description').attr('value',quill.root.innerHTML);
            $("#add-category").validate({
                rules: {
                    name: "required"
                },
                messages: {
                    name: "Category Name is required."
                }
            });
        })
    });
</script>
@endsection