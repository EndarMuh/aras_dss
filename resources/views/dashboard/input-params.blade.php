@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Input Parameter DSS</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('user.storeParameters') }}" method="post">
                @csrf
            @method('POST')
                <input type="hidden" name="dssId" value="{{ $dssId }}">
                <input type="hidden" value="alternatif-0" class="form-control" name="name_alternative[]" placeholder="masukkan nama alternatif" required>
                <div class="card">
                    <div class="card-header">
                        <h5>Input Alternatif (Ascending)</h5>
                    </div>
                    <div class="card-body">
                    <div id="dynamicInputAlternative">
                        <div class="form-group">
                            <label>Alternatif</label>
                            <div class="row justify-content-between">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="name_alternative[]" placeholder="masukkan nama alternatif" required>
                                </div>
                              </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addInputAlternative()">Tambah Alternatif</button>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Input Kriteria (Ascending)</h5>
                </div>
                <div class="card-body">
                    <div id="dynamicInputCriteria">
                        <div class="form-group">
                            <label>Kriteria</label>
                            <div class="row justify-content-between">
                                <div class="col-3">
                                    <input type="text" class="form-control" name="name_criteria[]" placeholder="masukkan nama alternatif" required>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" name="weight[]" step="any" placeholder="masukkan bobot" required>
                                </div>
                                <div class="col-3">
                                    {{-- <input type="text" class="form-control" name="category[]" placeholder="masukkan jenis kriteria" required> --}}
                                    <select class="form-control" name="category[]">
                                        <option selected value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                      </select>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger disabled">Hapus</button>
                                </div>
                              </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addInputCriteria()">Tambah Alternatif</button>
                </div>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <button type="submit" onclick="return confirm('Apakah anda yakin parameter sudah sesuai?')" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
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
