@extends('layouts.template')
@section('content')
<title>Data Transaksi | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>        
            @endif
            <a href="/transaksi/tambah" class="btn btn-success">Tambah Data</a>
            <br>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Outlet</th>
                        <th rowspan="2">Invoice</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Pakaian</th>
                        <th rowspan="2">Bayar</th>
                        <th colspan="2" class="text-center">Edit</th>
                        <th rowspan="2">View</th>
                    </tr>
                    <tr>
                        <th>Status Pakaian</th>
                        <th>Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_outlet}}</td>
                        <td>{{$u->kode_invoice}}</td>
                        <td>{{$u->tgl_transaksi}}</td>
                        <td>{{$u->status_pakaian}}</td>
                        @if($u->status_bayar == 'belum_dibayar')
                        <td>Belum Dibayar</td>
                        @else
                        <td>Lunas</td>
                        @endif
                        @if($u->status_pakaian == 'baru')
                        <td><a href="/transaksi/pakaian1/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Proses</a></td>
                        @elseif($u->status_pakaian=='proses')
                        <td><a href="/transaksi/pakaian2/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Selesai</a></td>
                        @elseif($u->status_pakaian=='selesai')
                        <td><a href="/transaksi/pakaian3/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Diambil</a></td>
                        @else
                        <td> No Action</td>
                        @endif

                        @if($u->status_bayar == 'belum_dibayar')
                        <td><a href="/transaksi/bayar1/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Lunas</a></td>
                        @else
                        <td> No Action</td>
                        @endif
                        <td><a href="/transaksi/show/{{ $u->id_transaksi}}" class="btn btn-success btn-sm">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection