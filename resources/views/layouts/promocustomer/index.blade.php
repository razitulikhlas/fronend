@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">RANGKING CUSTOMER MENDAPATKAN PROMO</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >


        <table class="table table-bordered table-sm" id="example1">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="15%">NAMA CUSTOMER</th>
                    <th width="20%">PHONE</th>
                    <th width="20%">ADDRESS</th>
                    <th width="10%">LEVEL</th>
                    <th width="15%">Jumlah Transaksi</th>
                    <th width="15%">Total Transaksi</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['name']}}</td>
                    <td>{{ $item['phone']}}</td>
                    <td>{{ $item['address']}}</td>
                    <td>{{ $item['level']}}</td>
                    <td>{{ $item['total_transaction'] }}</td>
                    <td>Rp {{ number_format($item['total_price'],'0',',','.') }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" id="edit" class="btn btn-warning btn-sm position-relative" data-id={{ $item["id_customer"] }}   data-toggle="modal" data-target="#insert">
                                <i class="fa fa-edit"></i> PROMO
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

<!-- /header -->
</div>

<div class="card">
    <div class="card-header" style="background-color: aqua">
      <h3 class="card-title">SAW PROMO</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="background-color: #212529; color: white;" >


<table class="table table-bordered table-sm" id="example1">
    <thead>
        <tr>
            <th width="5%">NO</th>
            <th width="15%">NAMA CUSTOMER</th>
            <th width="15%">SAW TOTAL TRANSAKSI</th>
            <th width="10%">SAW LEVEL</th>
            <th width="15%">SAW JUMLAH TRANSAKSI</th>
            <th width="15%">SAW</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($data as $item )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['name']}}</td>
            <td>{{ $item['total_transactionSaw']}}</td>
            <td>{{ $item['levelSaw']}}</td>
            <td>{{ $item['total_priceSaw'] }}</td>
            <td>{{ $item['saw'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>


{{-- insert --}}
 <div class="modal fade bd-example-modal-xl" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">BERIKAN PROMO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="formEdit" action="/promo" method="post" >
           {{-- @method('post') --}}
           @csrf
            <div class="form-group">
              <input type="hidden" class="form-control" name="idCustomer" id="idCustomer" value="">
            </div>
            <div class="form-group">
              <label for="promoName">NAMA PROMO</label>
              <input type="text" name="promoName" class="form-control" id="promoName" placeholder="Nama Promo">
            </div>
            <div class="form-group">
                <label for="promoDescription">DESKRIPSI PROMO</label>
                <textarea class="form-control" id="promoDescription" rows="3" name="promoDescription"></textarea>
              </div>
            <div class="form-group">
              <label for="promoPrice">HARGA PROMO</label>
              <input type="number" class="form-control" id="promoPrice" name="promoPrice" placeholder="0">
            </div>
            <div class="form-group">
                <label>Date:</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="expired" id="expired"  data-target="#reservationdate">
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- insert --}}

<script>
$(function() {
  $(document).on('click','#edit',function(){
        const id = $(this).data('id');
        $("#idCustomer").val(id);
   })

   $('#reservationdate').datetimepicker({
        format: 'L'
    });
});
</script>
@endsection
