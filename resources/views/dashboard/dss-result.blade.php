@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hasil Penghitungan DSS</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h5>Data Alternatif dan Kriteria</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6>Alternatif</h6>
                            <ul class="list-group">
                                @foreach ($alternatives as $alt)
                                    @if ($alt->name_alternative == 'alternatif-0')
                                        @continue
                                    @endif
                                    <li class="list-group-item">
                                        [A{{ $loop->iteration - 1 }}] {{ $alt->name_alternative }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <h6>Kriteria</h6>
                            <ul class="list-group">
                                @foreach ($criterias as $crt)
                                    <li class="list-group-item">[C{{ $loop->iteration }}] {{ $crt->name_criteria }} <span class="badge badge-primary">{{ $crt->category }}</span> <span class="badge badge-success">{{ $crt->weight }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Nilai Matriks Keputusan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Alternatif</th>
                                <th colspan="{{ count($criterias) }}">Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($alternatives as $alt)
                                    <tr>
                                        <td><input type="text" class="form-control" readonly=""
                                                value="{{ $alt->name_alternative }}" style="min-width: 100px"></td>
                                        @foreach ($criterias as $crt)
                                            <td><input type="number" class="form-control" step="any" style="min-width: 84px"
                                                    value="{{ $matrixDec[$alt->id][$crt->id] }}" disabled ></td>
                                        @endforeach
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Hasil Normalisasi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach ($criterias as $item)
                                    <th>Kriteria {{ $loop->iteration}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalized as $row)
                                <tr>
                                    <td>Alternatif {{ $loop->iteration - 1 }}</td>
                                    @foreach ($row as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Hasil Normalisasi Terbobot</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach ($criterias as $item)
                                    <th>Kriteria {{ $loop->iteration}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weighted as $row)
                                <tr>
                                    <td>Alternatif {{ $loop->iteration - 1 }}</td>
                                    @foreach ($row as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Hasil Fungsi Optimalisasi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @foreach ($optimumValues as $ov)
                                    <th>Alternatif {{ $loop->iteration - 1 }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($optimumValues as $ov)
                                    <td>{{ $ov }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Hasil Nilai K</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @foreach ($kValues as $kv)
                                    <th>Alternatif {{ $loop->iteration }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($kValues as $kv)
                                    <td>{{ $kv }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" style="overflow: scroll">
                <div class="card-header">
                    <h5>Hasil Perhitungan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Alternatif</th>
                                <th scope="col">Skor</th>
                                <th scope="col">Peringkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arasResults as $item)
                                <tr>
                                    <td>{{ $item->name_alternative_res }}</td>
                                    <td>{{ $item->score }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('sidebar')
    @parent
    <li class="menu-header">Starter</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
            <span>Layout</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="layout-default.html">Default Layout</a>
            </li>
            <li>
                <a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a>
            </li>
            <li>
                <a class="nav-link" href="layout-top-navigation.html">Top Navigation</a>
            </li>
        </ul>
    </li>
@endsection
