@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Data {{ $title }} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#insert">
	 <i class="fa fa-plus"></i> Tambah Driver
	</button>
</p>

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th width="15%">NAMA</th>
			<th width="10%">EMAIL</th>
			<th width="7%">PHONE</th>
			<th width="5%">NOMOR STNK</th>
			<th width="10%">PLAT MOTOR</th>
			<th width="10%">NIK</th>
			<th width="5%">RATING</th>
			<th width="5%">SALDO</th>
			<th width="5%">STATUS</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($data as $item )
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $item['name_driver']}}</td>
			<td>{{ $item['email']}}</td>
			<td>{{ $item['phone']}}</td>
			<td>{{ $item['nomor_stnk']}}</td>
			<td>{{ $item['plat_kendaraan'] }}</td>
			<td>{{ $item['nik'] }}</td>
			<td>{{ $item['rating'] }}</td>
			<td>{{ number_format($item['saldo'],'0',',','.') }}</td>
			<td>
				@if ($item['status_delete'] == 1)
				<button type="button" class="btn btn-primary position-relative" value="{{ $item["id"] }}" data-id-driver={{ $item["id"] }} data-bs-toggle="modal"  data-bs-target="#nonAktif" id="Aktif">
					Aktif
				</button>
				@elseif ($item['status_delete'] == -1)
				<button type="button" class="btn btn-danger btn-sm position-relative" id="notAktif" data-id-driver={{ $item["id"] }}  data-bs-toggle="modal"  data-bs-target="#exampleModal">
					Banned
				</button>
				@else
				<button type="button" class="btn btn-warning btn-sm position-relative" id="notAktif" data-id-driver={{ $item["id"] }}  data-bs-toggle="modal"  data-bs-target="#exampleModal">
					Not Aktif
				</button>
				@endif
			</td>
			<td>
				<div class="btn-group">
          	<button type="button" id="edit" class="btn btn-warning btn-sm position-relative" data-driver-id={{ $item["id"] }} data-driver-name="{{ $item["name_driver"] }}" data-driver-email="{{ $item["email"] }}" data-driver-phone="{{ $item["phone"] }}" data-driver-stnk="{{ $item["nomor_stnk"] }}" data-driver-plat="{{ $item["plat_kendaraan"] }}" data-driver-nik="{{ $item["nik"] }}"  data-toggle="modal" data-target="#insert">
		<i class="fa fa-edit"></i> Edit
	</button>

					<a href="drivers/{{ $item["id"] }}" class="btn btn-info btn-sm" >
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
        <h5 class="modal-title" id="exampleModalLabel">Aktivasi Akun Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin mengaktifkan akun Driver?
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
        <h5 class="modal-title" id="exampleModalLabel">Aktivasi Akun Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin banned akun Driver?
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
        <h4 class="modal-title" id="exampleModalLabel">Tambah Driver</h4>
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
              <label for="name">NAMA DRIVER</label>
              <input type="text" name="nameDriver" class="form-control" id="nameDriver" placeholder="Nama Driver">
            </div>
            <div class="form-group">
              <label for="email">EMAIL</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="No Hand phone">
          </div>
          <div class="form-group">
            <label for="nohp">NO HP</label>
            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="No Hand phone">
          </div>
          <div class="form-group">
            <label for="nomorstnk">NOMOR STNK</label>
            <input type="text" class="form-control" id="nomorstnk" name="nomorstnk" placeholder="Nomor STNK">
          </div>
          <div class="form-group">
            <label for="platkendaraan">PLAT KENDARAAN</label>
            <input type="text" class="form-control" id="platkendaraan" name="nomor_kendaraan" placeholder="Plat Kendaraan">
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
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
		$('#formAktivasi').attr('action','/drivers/'+$(this).data('id-driver')+'/1')
	})
	$(document).on('click','#Aktif',function(){
		console.log();
		$('#formNotAktivasi').attr('action','/drivers/'+$(this).data('id-driver')+'/0')
	})

  $(document).on('click','#edit',function(){
    const name = $(this).data('driver-name');
    const email = $(this).data('driver-email');
    const phone = $(this).data('driver-phone');
    const stnk = $(this).data('driver-stnk');
    const plat = $(this).data('driver-plat');
    const nik = $(this).data('driver-nik');

    console.log(plat);
    $("#nameDriver").val(name);
    $("#email").val(email);
    $("#nohp").val(phone);
    $("#nomorstnk").val(stnk);
    $("#platkendaraan").val(plat);
    $("#nik").val(nik);
    $('#formEdit').attr('action','/drivers/'+$(this).data('driver-id'));
	})
});
</script>
@endsection


