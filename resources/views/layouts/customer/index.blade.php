@extends('layouts.main')
@section('container')

@if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
      {{ session('loginError') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" >
      {{ session('success') }}
    </div>
@endif

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Data Customer</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

    <table class="table table-bordered table-sm" id="example1">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="15%">IMAGE</th>
                <th width="15%">NAMA</th>
                <th width="10%">PHONE</th>
                <th width="15%">EMAIL</th>
                <th width="15%">ADDRESS</th>
                <th width="10%">LEVEL</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ env('BASE_URL_IMAGE'). $item['image'] }}" class=" elevation-2" style="width: 80px" >
                </td>
                <td>{{ $item['name']}}</td>
                <td>{{ $item['phone']}}</td>
                <td>{{ $item['email']}}</td>
                <td>{{ $item['address'] }}</td>
                <td>{{ $item['level'] }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" id="edit" class="btn btn-warning btn-sm position-relative" data-id={{ $item["id"] }} data-name="{{ $item["name"] }}"  data-address="{{ $item["address"] }}" data-phone="{{ $item["phone"] }}" data-email="{{ $item["email"] }}" data-level="{{ $item["level"] }}"  data-toggle="modal" data-target="#insert">
                            <i class="fa fa-edit"></i> Edit
                        </button>

                        <a href="customer/{{ $item["id"] }}" class="btn btn-info btn-sm" >
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
              <label for="name">NAMA</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Nama Customer" required>
            </div>
            <div class="form-group">
              <label for="phone">NO HP</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="No Handphone" required>
            </div>
            <div class="form-group">
              <label for="email">EMAIl</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="address">ADDRESS</label>
              <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
            </div>

            <div class="form-group">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-select" aria-label="Default select example">
                <option value="Silver" >Silver</option>
                <option value="Gold">Gold</option>
                <option value="Platinum">Platinum</option>
              </select>
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
    const name = $(this).data('name');
    const address = $(this).data('address');
    const phone = $(this).data('phone');
    const email = $(this).data('email');
    const level = $(this).data('level');


    $("#name").val(name);
    $("#address").val(address);
    $("#phone").val(phone);
    $("#level").val(level);
    $("#email").val(email);
    $('#level').val(level);
    $('#formEdit').attr('action','/customer/'+$(this).data('id'));
	})
});
</script>
@endsection


