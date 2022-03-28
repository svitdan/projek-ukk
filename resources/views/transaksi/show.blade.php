@extends('layouts.template')
@section('content')
<title>Data Transaksi | Loundry</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
    </div>
    <div class="card-body">
       
            <div class="row">
            <div class="col-md-12">
                <h2>{{$struk->nama_outlet}}</h2>
                <hr>
            </div>
                <div class="col-md-6">

                    <table>
                        <tr>
                            <td>Kode Invoice</td>
                            <td>:</td>
                            <td>{{$struk->kode_invoice}}</td>
                        </tr>
                        <tr>
                            <td>Nama Kasir</td>
                            <td>:</td>
                            <td>{{$struk->name}}</td>
                        </tr>
                        <tr>
                            <td>Nama Member</td>
                            <td>:</td>
                            <td>{{$struk->nama_member}}</td>
                        </tr>
                        <tr>
                            <td>Notel Member</td>
                            <td>:</td>
                            <td>{{$struk->tlp}}</td>
                        </tr>
                        <tr>
                            <td>Status Bayar</td>
                            <td>:</td>
                            @if($struk->status_bayar == 'belum_dibayar')
                            <td>Belum Dibayar</td>
                            @else
                            <td>Lunas</td>
                            @endif
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>:</td>
                            <td>{{$struk->tgl_transaksi}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>:</td>
                            <td>{{$struk->batas_waktu}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$struk->nama_paket}}</td>
                        <td>{{$struk->harga_paket}}</td>
                        <td>{{$struk->qty}}</td>
                        <td>{{$struk->sub_total}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right">Diskon</td>
                        <td>{{$struk->diskon}}%</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right">Pajak</td>
                        <td>{{$struk->pajak}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right">Biaya Tambahan</td>
                        <td>{{$struk->biaya_tambahan}}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:right">Total</th>
                        <th>{{$struk->harga_total}}</th>
                    </tr>
                </tbody>
            </table>
            
            <a href="/cetak/{{$struk->id_transaksi}}" class="btn btn-primary">Cetak Nota</a>
        </div>
    </div>
</div>

@endsection