@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('admin/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{ $customer["name"] }}</h3>
          <p class="text-muted text-center">{{ $customer["level"] }}</p>
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
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

          <p class="text-muted">{{ $customer["address"] }}</p>

          <hr>
          <strong><i class="far fa-envelope mr-1"></i> Email</strong>

          <p class="text-muted">{{ $customer["email"] }}</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Transaction Customer</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

    <table class="table table-bordered table-sm" id="example1">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="15%">NO TRANSACTIONS</th>
                <th width="15%">HARGA PRODUCT</th>
                <th width="15%">HARGA DRIVER</th>
                <th width="15%">KODE VALIDASI</th>
                <th width="15%">STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['notransaksi']}}</td>
                <td>{{ $item['total_price']}}</td>
                <td>{{ $item['driver_price']}}</td>
                <td>{{ $item['kode_validasi'] }}</td>
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
                        <a href="{{URL::to('/transaksi/'.$item["notransaksi"])}}" class="btn btn-info btn-sm" >
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
    <!-- /.col -->
  </div>
@endsection
