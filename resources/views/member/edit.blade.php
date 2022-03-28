@extends('layouts.template')
@section('content')
<title>Data Member | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="/member/update" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama Member</label>
                <input type="hidden" name="id_member" value="{{$member->id_member}}">
                <input type="text" name="nama_member" class="form-control" value="{{$member->nama_member}}">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" name="alamat_member" class="form-control" value="{{$member->alamat_member}}"  required>
            </div>
            <div class="form-group">
            <label for="">Jk</label>
            <select name="jk" class="form-control">
            @if($member->jk=='L')
                <option value="{{$member->jk}}">Laki - laki</option>
                <option value="P">Perempuan</option>
            @else
            <option value="{{$member->jk}}">Perempuan</option>
                <option value="L">Laki - laki</option>
                
            @endif
            </select>
        </div>
        <div class="form-group">
            <label for="">No Telp</label>
            <input type="number" name="tlp" value="{{$member->tlp}}" class="form-control"  required>
        </div>
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection