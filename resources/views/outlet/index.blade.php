@extends('layouts.template')
@section('content')
<title>Data Outlet | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Outlet</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>        
            @endif
            <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
            <br>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Outlet</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlet as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_outlet}}</td>
                        <td>{{$u->alamat_outlet}}</td>
                        <td>{{$u->tlp_outlet}}</td>
                        <td>
                            <a href="/outlet/edit/{{ $u->id_outlet}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <a href="/outlet/delete/{{ $u->id_outlet}}" class="btn btn-primary btn-sm ml-2">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Masukan Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <form action="/outlet/store" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nama Outlet</label>
            <input type="text" name="nama_outlet" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" name="alamat_outlet" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="">No Telp</label>
            <input type="number" name="tlp_outlet" class="form-control"  required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    </div>
    </div>
</div>
</div>
@endsection