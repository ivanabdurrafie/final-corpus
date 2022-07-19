@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <h1 class="m-0 text-dark">Change Password</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('change-password')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" value="{{old('current_password')}}">
                            @error('current_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" value="{{old('new_password')}}">
                            @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_confirm_password">New Confirm Password</label>
                            <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password" placeholder="New Confirm Password" value="{{old('new_confirm_password')}}">
                            @error('new_confirm_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop