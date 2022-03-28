@extends('layouts.template')
@section('content')
<title>Data Paket | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
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
                        <th>Outlet</th>
                        <th>Jenis Paket</th>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paket as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_outlet}}</td>
                        <td>{{$u->nama_jenis}}</td>
                        <td>{{$u->nama_paket}}</td>
                        <td>{{$u->harga_paket}}</td>
                        <td>
                            <a href="/paket/edit/{{ $u->id_paket}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <a href="/paket/delete/{{ $u->id_paket}}" class="btn btn-danger btn-sm ml-2">Hapus</a>
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
    <form action="/paket/store" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Outlet</label>
            <select name="outlet_paket_id" class="form-control" id="">
                <option value="" disabled selected>Pilih Outlet</option>
                @foreach($outlet as $o)
                <option value="{{$o->id_outlet}}">{{$o->nama_outlet}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Jenis</label>
            <select name="jenis_id" class="form-control" id="">
                <option value="" disabled selected>Pilih Jenis</option>
                @foreach($jenis as $j)
                <option value="{{$j->id_jenis}}">{{$j->nama_jenis}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Harga</label>
            <input type="number" name="harga_paket" class="form-control"  required>
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