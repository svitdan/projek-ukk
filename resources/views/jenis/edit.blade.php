@extends('layouts.template')
@section('content')
<title>Data Jenis | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="/jenis/update" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama Jenis</label>
                <input type="hidden" name="id_jenis" value="{{$jenis->id_jenis}}">
                <input type="text" name="nama_jenis" class="form-control" value="{{$jenis->nama_jenis}}">
            </div>
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection