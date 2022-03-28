<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Transaksi</h4>
	</center>

        <table class="table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Invoice</th>
                    <th>Tanggal</th>
                    <th>Status Bayar</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
        
            @foreach ($transaksi as $i => $u)
                <tr>
                    <td>{{++$i}}</td>   
                    <td>{{$u->kode_invoice}}</td>   
                    <td>{{$u->tgl_transaksi}}</td>   
                    <td>{{$u->status_bayar}}</td>   
                    <td>{{$u->harga_total}}</td>   
                </tr>
            @endforeach
            </tbody>
        </table>

</body>
</html>