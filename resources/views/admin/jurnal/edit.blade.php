@extends('adminlte::page')

@section('title', 'Edit Jurnal')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Jurnal</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('jurnal.update',$jurnal)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Name" value="{{$jurnal->nama ?? old('nama')}}">
                            @error('nama')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" value="{{$jurnal->penerbit ?? old('penerbit')}}">
                            @error('penerbit')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" value="{{$jurnal->tahun ?? old('tahun')}}">
                            @error('tahun')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control" id="file" name="file" placeholder="File" value="{{old('file')}}">
                            @error('file')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

