@extends('layouts.template')
@section('content')
<title>Data Member | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jk</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($member as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_member}}</td>
                        <td>{{$u->alamat_member}}</td>
                        <td>{{$u->jk}}</td>
                        <td>{{$u->tlp}}</td>
                        <td>
                            <a href="/member/edit/{{ $u->id_member}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <a href="/member/delete/{{ $u->id_member}}" class="btn btn-danger btn-sm ml-2">Hapus</a>                            
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
    <form action="/member/store" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama_member" class="form-control" >
        </div>
        <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" name="alamat_member" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Jk</label>
            <select name="jk" class="form-control">
                <option value="" selected disabled>Pilih Jk</option>
                <option value="L">Laki - laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">No Telp</label>
            <input type="number" name="tlp" class="form-control">
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