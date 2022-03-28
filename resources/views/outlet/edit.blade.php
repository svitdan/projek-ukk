@extends('layouts.template')
@section('content')
<title>Data Outlet | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="/outlet/update" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama Outlet</label>
                <input type="hidden" name="id_outlet" value="{{$outlet->id_outlet}}">
                <input type="text" name="nama_outlet" class="form-control" value="{{$outlet->nama_outlet}}">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" name="alamat_outlet" class="form-control" value="{{$outlet->alamat_outlet}}"  required>
            </div>
            <div class="form-group">
                <label for="">No Telp</label>
                <input type="number" name="tlp_outlet" value="{{$outlet->tlp_outlet}}" class="form-control"  required>
            </div>
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection