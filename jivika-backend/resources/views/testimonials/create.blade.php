@extends('back_layout')
@section('title')
<title>Testimonial | KeyTech</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Testimonial</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Testimonial</h5>

                        </div>
                        <div class="card-block p-3">
                        @if(isset($data))
                            {!! Form::open(['route' => ['testimonials.update',$data->id], 'method' => 'PUT', 'id'=>'add-testimonial','enctype' => 'multipart/form-data']) !!}
                            @else
                            {!! Form::open(['route' => 'testimonials.store', 'method' => 'POST', 'id'=>'add-testimonial','enctype' => 'multipart/form-data']) !!}
                            @endif
                            @csrf
                            @if(isset($data))
                            {!! Form::hidden('id', $data->id) !!}
                            @endif
                            <div class="form-group row mb-2">
                                <div class="col-sm-3">
                                    {!! Form::label('name', 'name', ['class' => 'control-label']) !!}
                                </div>
                                <div class="col-sm-9">

                                    {!! Form::text('name', !empty($data) ? $data->name : null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-3">
                                    {!! Form::label('title', 'title', ['class' => 'control-label']) !!}
                                </div>
                                <div class="col-sm-9">

                                    {!! Form::text('title', !empty($data) ? $data->title : null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-3">
                                    {!! Form::label('words', 'words', ['class' => 'control-label']) !!}
                                </div>
                                <div class="col-sm-9">

                                    {!! Form::textarea('words', !empty($data) ? $data->words : null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-3">
                                    {!! Form::label('author_image', 'author_image', ['class' => 'control-label']) !!}
                                </div>
                                <div class="col-sm-9">

                                    {!! Form::file('author_image', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light save_testimonial">@if(empty($data))Add @else Update @endif</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
    $('.save_testimonial').click(function() {
            $("#add-testimonial").validate({
                rules: {
                    name: "required",
                    title: "required",
                    words: "required"
                },
                messages: {
                    name: "Name is required.",
                    title: "Title is required",
                    words: "Please give details" 
                }
            });
        })
</script>
@endsection