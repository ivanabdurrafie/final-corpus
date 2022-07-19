@extends('adminlte::page')

@section('title', 'Concordance')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
<h1 class="m-0 text-dark">Find Concordance</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <form action="{{route('concordance.find')}}" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Find Concordance by name"
                                    name="nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="number" class="form-control" id="tahun"
                                    placeholder="Find Concordance by year" name="tahun">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keyword</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="keyword" placeholder="Find Concordance"
                                        name="keyword">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-fw fa-search"></i></button>
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <br><hr class="mb-5">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($data)
                        <table class="table display table-hover" id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">index</th>
                                    <th colspan="3" class="text-center" style="width: 100%">Concordance</th>
                                    {{-- <th rowspan="2">file</th> --}}
                                </tr>
                                <tr>
                                    <th style="display: none"> </th>
                                    <th style="display: none"> </th>
                                    <th style="display: none"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{$item[3]}}</td>
                                    <td class="text-right">{{$item[4]}}</td>
                                    <td class="text-center"><b>{{$item[1]}}</b></td>
                                    <td class="text-left">{{$item[5]}}</td>
                                    {{-- <td>tba </td> --}}
                                </tr>    
                                @empty
                                    <tr>
                                        <td colspan="4">data not found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "order": [],
            "autoWidth": true,
        });
        $('#example').DataTable({
            "order": [],
            "autoWidth": true,
        });
    } );
    $('.delete-confirm').on('click', function (e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log(form);
                console.log(result.value);
                form.submit();
            }
        })
    });
</script>
@endsection