@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">DATA {{$title}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >



<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th width="15%">NO TRANSACTIONS</th>
            <th width="10%">DATE</th>
            <th width="15%">CUSTOMER</th>
            <th width="15%">HARGA</th>
            <th width="15%">HARGA DRIVER</th>
			<th width="15%">KODE VALIDASI</th>
			<th width="15%">STATUS</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($data as $item )
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $item['notransaksi']}}</td>
			<td>{{ substr($item['created_at'],0,10) }}</td>
			<td>{{ $item['customer_name']}}</td>
			<td>{{ $item['total_price']}}</td>
			<td>{{ $item['driver_price']}}</td>
			<td>{{ $item['kode_validasi']}}</td>
			<td>
                @if ($item['status'] == 0)
                    <div class="btn btn-danger">Cancel</div>
                            @elseif ($item['status'] == 1)
                    <div class="btn btn-warning">Pending</div>
                            @elseif ($item['status'] == 2)
                    <div class="btn btn-primary">Store</div>
                            @elseif ($item['status'] == 3)
                    <div class="btn btn-info">Search</div>
                            @elseif ($item['status'] == 4)
                    <div class="btn btn-secondary">Driver</div>
                            @elseif ($item['status'] == 5)
                    <div class="btn btn-light">Pickup</div>
                            @else
                    <div class="btn btn-success">Done</div>
                @endif
             </td>
			<td>
				<div class="btn-group">
					<a href="transaksi/{{ $item["notransaksi"] }}" class="btn btn-info btn-sm" >
							<i class="fa fa-eye"></i> Detail
						</a>
					</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
<!-- /header -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aktivasi Akun Store</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin mengaktifkan akun Store?
      </div>
      <div class="modal-footer">
		<form id="formAktivasi" action="" method="post">
			@csrf
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
			<button type="submit" class="btn btn-primary" id="btnSubmit" value="">Ya</button>
		</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="nonAktif" tabindex="-1" aria-labelledby="nonAktifLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Banned Akun Store</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin banned akun Store?
      </div>
      <div class="modal-footer">
		<form id="formNotAktivasi" action="" method="post">
			@csrf
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
			<button type="submit" class="btn btn-primary" id="btnSubmit" value="">Ya</button>
		</form>
      </div>
    </div>
  </div>
</div>

{{-- insert --}}
 <div class="modal fade bd-example-modal-xl" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update data {{ $title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="formEdit" action="" method="post" >
           @method('put')
           @csrf
             <div class="form-group">
              <input type="hidden" class="form-control" name="kode_dokter" id="kode_dokter" placeholder="Kode Dokter">
            </div>
            <div class="form-group">
              <label for="ownerName">NAMA PEMILIK TOKO</label>
              <input type="text" name="ownerName" class="form-control" id="ownerName" placeholder="Nama Pemilik Toko">
            </div>
            <div class="form-group">
              <label for="storeName">NAMA TOKO</label>
              <input type="text" name="storeName" class="form-control" id="storeName" placeholder="Nama Toko">
            </div>
            <div class="form-group">
              <label for="nohp">NO HP</label>
              <input type="text" class="form-control" id="nohp" name="nohp" placeholder="No Handphone">
            </div>
            <div class="form-group">
              <label for="address">ADDRESS</label>
              <textarea class="form-control" id="address" rows="3" name="address"></textarea>
            </div>
            <div class="form-group">
              <label for="latitude">Latitude</label>
              <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
            </div>
            <div class="form-group">
              <label for="longititude">Longititude</label>
              <input type="text" class="form-control" id="longititude" name="longititude" placeholder="Longititude">
            </div>
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- insert --}}

<script>
$(function() {
	$(document).on('click','#notAktif',function(){
		$('#formAktivasi').attr('action','/store/'+$(this).data('id')+'/1')
	})
	$(document).on('click','#Aktif',function(){
		console.log();
		$('#formNotAktivasi').attr('action','/store/'+$(this).data('id')+'/0')
	})

  $(document).on('click','#edit',function(){
    const ownerName = $(this).data('name');
    const storeName = $(this).data('storename');
    const address = $(this).data('address');
    const phone = $(this).data('phone');
    const latitude = $(this).data('latitude');
    const longititude = $(this).data('longititude');


    $("#ownerName").val(ownerName);
    $("#storeName").val(storeName);
    $("#address").val(address);
    $("#nohp").val(phone);
    $("#latitude").val(latitude);
    $("#longititude").val(longititude);
    $('#formEdit').attr('action','/store/'+$(this).data('id'));
	})
});
</script>
@endsection


