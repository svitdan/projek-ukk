@extends('layouts.template')
@section('content')
<title>Data Transaksi | Loundry</title>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <div class="card-body">
                <form action="/transaksi/store" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Invoice</label>
                        <input type="text" name="kode_invoice" class="form-control" readonly value="{{$kode_invoice}}" readonly>
                    </div>
                    <div class="form-group">
                    <label for="">Outlet</label>
                        <select name="transaksi_outlet_id" id="country" class="form-control" >
                            <option value="" disabled selected>Pilih Outlet</option>
                            @foreach($outlet as $o)
                            <option value="{{$o->id_outlet}}">{{$o->nama_outlet}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Paket</label>
                        <select name="paket_id" id="state" class="form-control" >
                        <option value="" disabled selected>Pilih Paket</option>
                        
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="">Member</label>
                        <select name="member_id" class="form-control" id="">
                            <option value="" disabled selected>Pilih Member</option>
                            @foreach($member as $m)
                            <option value="{{$m->id_member}}">{{$m->nama_member}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" name="qty" id="jumlah" onkeyup="hitung2();" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_transaksi"  onchange="hitung3();" id="tgl_transaksi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Waktu Selesai</label>
                        <input type="text" id="tgl_selesai" readonly class="form-control" required>
                        <input type="hidden" name="batas_waktu" id="tgl_selesai2" readonly class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Waktu Bayar</label>
                        <input type="date" name="tgl_bayar"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Status Bayar</label>
                        <select name="status_bayar" class="form-control">
                            <option value="" disabled selected>Pilih Status Bayar</option>
                            <option value="dibayar">Dibayar</option>
                            <option value="belum_dibayar">Belum Di Bayar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan"  class="form-control" required>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Biaya</h6>
            </div>
            <div class="card-body">
                
                    <input type="hidden" id="harga_paket">

                    <div class="form-group">
                        <label for="">Sub Total</label>
                        <input type="number" name="sub_total" readonly id="total" class="form-control" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="">Biaya Tambahan</label>
                        <input type="number" name="biaya_tambahan" value="0" onkeyup="hitung4();"  id="tambahan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        
                        <label for="">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" value="0" onkeyup="hitung4();" class="form-control" onKeyPress="if(this.value.length==2) return false;" required>
                    </div>
                    <input type="hidden" id="coba">
                    <div class="form-group">
                        <label for="">Pajak (%)</label>
                        <input type="number" name="pajak" id="pajak" onkeyup="hitung4();"  onKeyPress="if(this.value.length==2) return false;" value="0" class="form-control" required>
                    </div>
                    <input type="hidden" id="coba2">
                    <div class="form-group">
                        <label for="">Total Harga</label>
                        <input type="number" name="harga_total" readonly id="total_asli" class="form-control" required>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $('#country').change(function(){
    var outletID = $(this).val();    
    if(outletID){
        $.ajax({
           type:"GET",
           url:"{{url('ambil')}}?outlet_paket_id="+outletID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option></option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
       
    }      
   });
   

   $('#state').change(function(){
    var paketID = $(this).val();      
    if(paketID){
        $.ajax({
           type:"GET",
           url:"{{url('ambil2')}}?id_paket="+paketID,
           success:function(res){               
            if(res){
                $("#harga_paket").empty();
                $.each(res,function(key,value){
                    $("#harga_paket").val(value);
                });
           
            }else{
               $("#harga_paket").empty();
            }
           }
        });
    }else{
        $("#harga_paket").empty();
       
    }      
   });

function hitung2() {
    var a = $("#jumlah").val();
    var b = $("#harga_paket").val();
    c = a * b; //a kali b
    $("#total").val(c);
    $("#total_asli").val(c);
}

function hitung3() {
    var tanggal = new Date($("#tgl_transaksi").val());
    var awe = tanggal.setDate(tanggal.getDate() + 3);
    var ea= moment(awe).format('MM/DD/YYYY');
    var ea2= moment(awe).format('YYYY-MM-DD');
    $("#tgl_selesai").val(ea);
    $("#tgl_selesai2").val(ea2);
}

function hitung4() {
    var a = $("#total").val();
    var b = $("#tambahan").val();
    var c = $("#diskon").val();
    var d = $("#pajak").val();

    var nambah = parseInt(a)+parseInt(b);
    var diskon = nambah - nambah * c / 100;
    var pajak = diskon - diskon * d / 100;

   
   $("#coba").val(diskon);
   $("#total_asli").val(pajak);
}

function hitung5() {
    var diskon = $("#coba").val();
    var d = $("#pajak").val();

    $("#total_asli").val(pajak);
}

</script>

@endpush

@endsection


