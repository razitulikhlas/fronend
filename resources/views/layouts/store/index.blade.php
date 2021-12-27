@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">TITLE </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#insert">
	 <i class="fa fa-plus"></i> Tambah Store
	</button>
</p>

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th width="15%">NAMA PEMILIK</th>
            <th width="10%">NAMA STORE</th>
            <th width="15%">PHONE</th>
			<th width="15%">EMAIL</th>
			<th width="15%">ALAMAT</th>
			<th width="10%">SALDO</th>
			<th width="5%">STATUS</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($data as $item )
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $item['owner_name']}}</td>
			<td>{{ $item['store_name']}}</td>
			<td>{{ $item['phone']}}</td>
			<td>{{ $item['email']}}</td>
			<td>{{ $item['address'] }}</td>
			<td>Rp {{ number_format($item['saldo'],'0',',','.') }}</td>
			<td>
				@if ($item['status_delete'] == 1)
				<button type="button" class="btn btn-primary position-relative" value="{{ $item["id_store"] }}" data-id={{ $item["id_store"] }} data-bs-toggle="modal"  data-bs-target="#nonAktif" id="Aktif">
					Aktif
				</button>
				@elseif ($item['status_delete'] == -1)
				<button type="button" class="btn btn-danger btn-sm position-relative" id="notAktif" data-id={{ $item["id_store"] }}  data-bs-toggle="modal"  data-bs-target="#exampleModal">
					Banned
				</button>
				@else
				<button type="button" class="btn btn-warning btn-sm position-relative" id="notAktif" data-id={{ $item["id_store"] }}  data-bs-toggle="modal"  data-bs-target="#exampleModal">
					Not Aktif
				</button>
				@endif
			</td>
			<td>
				<div class="btn-group">
          	<button type="button" id="edit" class="btn btn-warning btn-sm position-relative" data-id={{ $item["id_store"] }} data-name="{{ $item["owner_name"] }}" data-latitude="{{ $item["latitude"] }}" data-longititude="{{ $item["longititude"] }}" data-address="{{ $item["address"] }}" data-phone="{{ $item["phone"] }}" data-storename="{{ $item["store_name"] }}"  data-toggle="modal" data-target="#insert">
		<i class="fa fa-edit"></i> Edit
	</button>

					<a href="store/{{ $item["id_store"] }}" class="btn btn-info btn-sm" >
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


