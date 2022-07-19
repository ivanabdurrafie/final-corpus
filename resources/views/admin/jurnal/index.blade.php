@extends('adminlte::page')

@section('title', 'Jurnal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
<h1 class="m-0 text-dark">Jurnal</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">


                <a href="{{ route('jurnal.create') }}" class="btn btn-primary">Tambah Jurnal</a>
                <br><br>
                <table class="table table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>penerbit</th>
                            <th>tahun</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->penerbit}}</td>
                            <td>{{$item->tahun}}</td>
                            <td>
                                <div class="dropdown show">
                                    <a class="btn btn-link text-dark m-0 p-0" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('jurnal.show',$item)}}">detail</a>
                                        <a class="dropdown-item" href="{{route('jurnal.edit',$item)}}">update</a>
                                        <form action="{{route('jurnal.destroy',$item->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="dropdown-item delete-confirm" data-toggle="tooltip" title='Delete'>delete</button>
                                        </form>
                                        {{-- <a class="dropdown-item delete-confirm"
                                            href="{{route('jurnal.destroy',$item)}}">delete</a> --}}
                                            
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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