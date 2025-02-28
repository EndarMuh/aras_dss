@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Homepage</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="container d-flex justify-content-between">
                        <div class="p-2">
                            <h5>Data Hasil Penghitungan DSS</h5>
                        </div>
                        <div class="p-2">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ TAMBAH</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Penghitungan</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->dss_title }}</td>
                                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('form-delete').submit()" class="btn btn-danger">Hapus</a> <a href="{{ route('user.show', $data) }}" class="btn btn-info">Detail</a> </td>
                                </tr>

                                <form id="form-delete" action="{{ route('user.destroy', $data) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah DSS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Penghitungan</label>
                        <input type="text" class="form-control" name="dss_title" placeholder="masukkan judul" required>
                    </div>
                    {{-- <div class="form-group">
                        <label>Jumlah Alternatif</label>
                        <input type="number" class="form-control" name="altCount" placeholder="masukkan jumlah alternatif" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Kriteria</label>
                        <input type="number" class="form-control" name="critCount" placeholder="masukkan jumlah kriteria" required>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
