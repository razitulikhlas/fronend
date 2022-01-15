@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <img src="{{ env('BASE_URL_IMAGE'). $store['photo_store'] }}" class="img-fluid" alt="...">
        <div class="card-body box-profile">
          <h3 class="profile-username text-center">Razitul Ikhlas</h3>
          <p class="text-muted text-center">Rp {{ number_format( $store['saldo'],'0',',','.') }}</p>
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
            <p class="text-muted">{{ $store["owner_name"] }}</p>
            <hr>

            <strong><i class="fas fa-star mr-1"></i>Rating</strong>
            <p class="text-muted">{{ $store["rating"] }}</p>
            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i>Lokasi</strong>
            <p class="text-muted">{{ $store["address"] }}</p>
            <hr>
            <strong><i class="fas fa-map-pin mr-1"></i>Latitude</strong>
            <p class="text-muted">{{ $store["latitude"] }}</p>
            <hr>
            <strong><i class="fas fa-map-pin mr-1"></i>Longitude</strong>
            <p class="text-muted">{{ $store["longititude"] }}</p>
            <hr>

            <strong><i class="far fa-envelope mr-1"></i>Email</strong>
            <p class="text-muted">{{ $store["email"] }}</p>

            <hr>
            <strong><i class="far fa-address-book mr-1"></i>PHONE</strong>
            <p class="text-muted">{{ $store["phone"] }}</p>

            <hr>
            <strong><i class="far fa-id-card mr-1"></i>KTP</strong>
            <img src="{{ env('BASE_URL_IMAGE'). $store['photo_ktp'] }}" class="img-thumbnail" alt="...">
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
            @foreach ($product as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ env('BASE_URL_IMAGE'). $item['image1'] }}" class=" elevation-2" style="width: 80px" >
                </td>
                <td>{{ $item['name_product']}}</td>
                <td>{{ $item['category']}}</td>
                <td>{{ $item['description']}}</td>
                <td>Rp {{ number_format( $item['price_promo'],'0',',','.') }}</td>
                <td>Rp {{ number_format( $item['price'],'0',',','.') }}</td>
                <td>{{ $item['status_delete'] }}</td>
                <td>
                  <div class="btn-group">
                    <a href="" class="btn btn-info btn-sm" >
                        <i class="fa fa-eye"></i> Detail
                    </a>
                  </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
          Featured
        </div>
        <div id='maps' style='width: 400px; height: 300px;'></div>
    </div>
@endsection

<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />


<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoicmF6aXR1bGlraGxhcyIsImEiOiJja3kwM2RtcWUwNWVjMndtcDQxZzh3YzF6In0.-wd_XWClHYZgdGuwqpGNGg';
    const map = new mapboxgl.Map({
    container: 'maps', // container ID
    style: 'mapbox://styles/mapbox/streets-v11', // style URL
    center: [-74.5, 40], // starting position [lng, lat]
    zoom: 9 // starting zoom
    });
    </script>
