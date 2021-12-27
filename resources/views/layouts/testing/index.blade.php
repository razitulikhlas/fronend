@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <img src="{{ asset('admin/dist/img/boxed-bg.png') }}" class="img-fluid" alt="...">
        <div class="card-body box-profile">
          <h3 class="profile-username text-center">Razitul Ikhlas</h3>
          <p class="text-muted text-center">Saldo</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <strong><i class="fas fa-home mr-1"></i>Nama</strong>
            <p class="text-muted">Razitul Ikhlas</p>
            <hr>

            <strong><i class="fas fa-star mr-1"></i>Rating</strong>
            <p class="text-muted">Razitul Ikhlas</p>
            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i>Lokasi</strong>
            <p class="text-muted">Jalan padang 4 no 424 siteba</p>
            <hr>
            <strong><i class="fas fa-map-pin mr-1"></i>Latitude</strong>
            <p class="text-muted">170.58</p>
            <hr>
            <strong><i class="fas fa-map-pin mr-1"></i>Longitude</strong>
            <p class="text-muted">170.58</p>
            <hr>

            <strong><i class="far fa-envelope mr-1"></i>Email</strong>
            <p class="text-muted">razituli@gmail.com</p>

            <hr>
            <strong><i class="far fa-address-book mr-1"></i>PHONE</strong>
            <p class="text-muted">82169146904</p>

            <hr>
            <strong><i class="far fa-id-card mr-1"></i>KTP</strong>
            <img src="{{ asset('admin/dist/img/boxed-bg.jpg') }}" class="img-thumbnail" alt="...">
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

    <table class="table table-bordered table-sm" id="example1">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="10%">Image</th>
                <th width="15%">Name</th>
                <th width="10%">Category</th>
                <th width="15%">Description</th>
                <th width="15%">Harga Promo</th>
                <th width="15%">Harga Normal</th>
                <th width="15%">Status</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
    </div>
    <!-- /.col -->
  </div>
@endsection
