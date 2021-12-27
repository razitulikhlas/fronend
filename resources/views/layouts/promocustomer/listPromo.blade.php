@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">PROMO YANG DI BERIKAN KE CUSTOMER</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >


        <table class="table table-bordered table-sm" id="example1">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="15%">NAMA CUSTOMER</th>
                    <th width="20%">NAMA PROMO</th>
                    <th width="20%">DESKRIPSI PROMO</th>
                    <th width="10%">DISKON PROMO</th>
                    <th width="15%">STATUS PROMO</th>
                    <th width="15%">EXPIRE</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['name']}}</td>
                    <td>{{ $item['promoName']}}</td>
                    <td>{{ $item['promoDescription']}}</td>
                    <td>Rp {{ number_format($item['promoPrice'],'0',',','.') }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>{{ $item['expired'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

<!-- /header -->
</div>




@endsection
