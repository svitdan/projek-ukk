@extends('layouts.template')
@section('content')
<title>Dashboard | Loundry</title>

@if( Session::get('berhasil') !="")
<div class='alert alert-success'><center><b>{{Session::get('berhasil')}}</b></center></div>        
@endif
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Member</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_member}}</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-user-circle fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4 d-none">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{$jumlah_pendapatan}}</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-dark shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Jumlah Paket</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_paket}}</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-briefcase fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Transaksi</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_transaksi}}</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data - data Transaksi</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
            
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Outlet</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pakaian</th>
                        <th>Bayar</th>
                        <th>View</th>
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
                        <td><a href="/transaksi/show/{{ $u->id_transaksi}}" class="btn btn-success btn-sm">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
