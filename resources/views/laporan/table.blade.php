<table id="dataTable" class="table table-bordered" cellspacing="0">
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