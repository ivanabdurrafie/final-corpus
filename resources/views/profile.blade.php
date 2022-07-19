@extends('adminlte::page')

@section('title', 'profile')

@section('content_header')
<h1 class="m-0 text-dark">{{auth()->user()->name}} Profile</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{$profile->name}}</h3>
                    <p class="text-muted text-center">{{$profile->email}}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>created at</b> <a class="float-right">{{$profile->created_at}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>updated at</b> <a class="float-right">{{$profile->updated_at}}</a>
                        </li>
                        {{-- <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                        </li> --}}
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('profile.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile->name ?? old('name')}}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{$profile->email ?? old('email')}}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
@stop