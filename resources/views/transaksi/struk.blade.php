<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Nota | Loundry</title>
  </head>
  <body>
  <div class="container">
            <div class="row">
            <div class="col-md-12">
                <h2>{{$struk->nama_outlet}}</h2>
                <p>{{$struk->alamat_outlet}}</p>
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

            </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>