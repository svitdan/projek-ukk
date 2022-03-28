@extends('layouts.template')
@section('content')
<title>Data Paket | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="/paket/update" method="post">
            @csrf
            <div class="form-group">
            <label for="">Outlet</label>
                <input type="hidden" value="{{$paket->id_paket}}" name="id_paket">
                <select name="outlet_paket_id" class="form-control" id="">
                    @foreach($outlet as $o)
                    @if($paket->outlet_paket_id == $o->id_outlet)
                    <option value="{{$o->id_outlet}}" selected>{{$o->nama_outlet}}</option>
                    @else
                    <option value="{{$o->id_outlet}}">{{$o->nama_outlet}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Jenis</label>
                <select name="jenis_id" class="form-control" id="">
                    @foreach($jenis as $j)
                    @if($paket->jenis_id == $j->id_jenis)
                    <option value="{{$j->id_jenis}}" selected>{{$j->nama_jenis}}</option>
                    @else
                    <option value="{{$j->id_jenis}}">{{$j->nama_jenis}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{$paket->nama_paket}}" required>
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="number" name="harga_paket" class="form-control" value="{{$paket->harga_paket}}"  required>
            </div>
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection