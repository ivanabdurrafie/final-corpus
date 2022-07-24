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
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                    aria-selected="true">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-three-profile" role="tab"
                                    aria-controls="custom-tabs-three-profile" aria-selected="false">Popular Word</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-three-messages" role="tab"
                                    aria-controls="custom-tabs-three-messages" aria-selected="false">Word Frequency</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                                aria-labelledby="custom-tabs-three-home-tab">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <table>
                                            <tr>
                                                <th>Nama</th>
                                                <th> : </th>
                                                <th>{{$jurnal->nama}}</th>
                                            </tr>
                                            <tr>
                                                <th>Penerbit</th>
                                                <th> : </th>
                                                <th>{{$jurnal->penerbit}}</th>
                                            </tr>
                                            <tr>
                                                <th>Tahun</th>
                                                <th> : </th>
                                                <th>{{$jurnal->tahun}}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12 text-justify">
                                        @php
                                            $f = $fileEncoded.utf8_decode($jurnal->file);
                                            
                                        @endphp
                                        {{$f}}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-three-profile-tab">
                                @foreach ($word->PopularWord as $item)
                                @php
                                $a = [];
                                $a = json_encode($item);
                                $c = preg_replace('/[^A-Za-z-]/', ' ', $a);
                                $b = preg_replace('/[^0-9\-]/', ' ', $a);
                                $d = str_replace(',',' ',$b);


                                @endphp
                                <ul>
                                    <li> {{$b.$c}} </li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-three-messages-tab">
                                <ul>
                                    @foreach ($word->WordFrequency as $item => $value)
                                    <li>{{ $value }} {{$item}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @stop