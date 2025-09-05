@extends('back_layout')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Change Password</h5>
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
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-block p-3">
                            <form id="add-user" method="post" action="{{url('admin/changepassword')}}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" class="form-control" name="current_password" id="current_password" placeholder="Enter Old Password">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Re-enter New Password">
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0 waves-effect waves-light">Change</button>
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