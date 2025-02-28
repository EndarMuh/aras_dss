@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Penghitungan DSS</h1>
        </div>
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h5>Alternatif (Karyawan)</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.updateCreateAlt') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="alternatif-0" class="form-control" name="name_alternative[]"
                            placeholder="masukkan nama alternatif" required>
                        @foreach ($alternatives as $item)
                            <input type="hidden" name="dssId" value="{{ $item->dss_id }}">
                            <div id="alternatives">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Alternatif {{ $loop->iteration }}</label>
                                            <input type="text" value="{{ $item->name_alternative }}" name="name_alternative_update[{{ $item->id }}]" class="form-control">
                                            <input type="hidden" value="{{ $item->id}}" name="alt_id_update[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                        <a href="{{ route('user.deleteOneAlt', $item->id) }}"
                                            class="btn btn-outline-danger delete-btn">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Container untuk menambahkan input baru -->
                        <div id="newAlternatives"></div>

                        <div class="row justify-content-center">
                            <div class="col-3 text-center">
                                <button type="submit" style="width: 100%" class="btn btn-warning">Update</button>
                            </div>
                            <div class="col-3 text-center">
                                <button type="button" style="width: 100%" onclick="addAlternative()"
                                    class="btn btn-primary">Tambah Alternatif</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Kriteria</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.updateCreateCri') }}" method="post">
                        @csrf
                        @method('POST')
                        @foreach ($criterias as $item)
                            <input type="hidden" name="dssId" value="{{ $item->dss_id }}">
                            <div id="criterias">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nama Kriteria {{ $loop->iteration }}</label>
                                            <input type="text" class="form-control" name="name_criteria_update[{{ $item->id }}]" value="{{ $item->name_criteria }}" placeholder="masukkan nama alternatif" required>
                                            <input type="hidden" value="{{ $item->id}}" name="cri_id_update[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Bobot</label>
                                            <input type="number" class="form-control" value="{{ $item->weight }}" name="weight_update[{{ $item->id }}]" step="any" placeholder="masukkan bobot" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Kriteria</label>
                                            <select class="form-control" name="category_update[{{ $item->id }}]">
                                                <option {{ $item->category === 'Benefit' ? 'selected' : '' }}
                                                    value="Benefit">Benefit</option>
                                                <option {{ $item->category === 'Cost' ? 'selected' : '' }} value="Cost">
                                                    Cost</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mt-4">
                                        <a href="{{ route('user.deleteOneCri', $item->id) }}"
                                            class="btn btn-outline-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Container untuk menambahkan input baru -->
                        <div id="newCriterias"></div>

                        <div class="row justify-content-center">
                            <div class="col-3 text-center">
                                <button type="submit" style="width: 100%" onclick="return confirm('Apakah anda yakin?')"
                                    class="btn btn-warning">Update</button>
                            </div>
                            <div class="col-3 text-center">
                                <button type="button" style="width: 100%" onclick="addCriteria()"
                                    class="btn btn-primary">Tambah Kriteria</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (!$dss->isCounted)
                <div class="card" style="overflow: scroll">
                    <div class="card-header">
                        <h5>Input Nilai Matriks Keputusan</h5>
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
                                <form action="{{ route('user.store-decMatrix') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="dssId" value="{{ $dss->id }}">
                                    <input type="hidden" name="altId" value="{{ $alternatives[0]->id }}">
                                    <input type="hidden" name="criId" value="{{ $criterias[0]->id }}">
                                    @foreach ($alternatives as $alt)
                                        <tr>
                                            <td><input type="text" class="form-control" readonly=""
                                                    value="{{ $alt->name_alternative }}" style="min-width: 100px"></td>
                                            @foreach ($criterias as $crt)
                                                <td><input type="number" class="form-control" step="any"
                                                        style="min-width: 84px"
                                                        name="matrix[{{ $alt->id }}][{{ $crt->id }}]"
                                                        placeholder="C{{ $i = $loop->iteration }}" required></td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" onclick="return confirm('Apakah anda yakin?')"
                            class="btn btn-primary">Hitung</button>
                        </form>
                    </div>
                </div>
            @else
                @isset($matrixDec)
                    <div class="card" style="overflow: scroll">
                        <div class="card-header">
                            <h5>Input Nilai Matriks Keputusan</h5>
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
                                    <form action="{{ route('user.store-decMatrix') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="dssId" value="{{ $dss->id }}">
                                        <input type="hidden" name="altId" value="{{ $alternatives[0]->id }}">
                                        <input type="hidden" name="criId" value="{{ $criterias[0]->id }}">
                                        @foreach ($alternatives as $alt)
                                            <tr>
                                                <td><input type="text" class="form-control" readonly=""
                                                        value="{{ $alt->name_alternative }}" style="min-width: 100px"></td>
                                                @foreach ($criterias as $crt)
                                                    <td><input type="number" class="form-control" step="any" style="min-width: 84px"
                                                            name="matrix[{{ $alt->id }}][{{ $crt->id }}]"
                                                            value="{{ $matrixDec[$alt->id][$crt->id] }}"
                                                            placeholder="C{{ $i = $loop->iteration }}" required></td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" onclick="return confirm('Apakah anda yakin?')"
                                class="btn btn-primary">Hitung</button>
                            </form>
                        </div>
                    </div>
                @endisset
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
            @endif
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
