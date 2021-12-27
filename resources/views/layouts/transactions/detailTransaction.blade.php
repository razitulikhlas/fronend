@extends('layouts.main')
@section('container')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i>
               <b>Invoice #{{ $transaction["notransaksi"] }}</b>
                {{-- <small class="float-right">Date: 2/10/2014</small> --}}
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Nama Toko
              <address>
                <strong>{{ $store["store_name"] }}</strong><br>
                {{ $store["address"] }}<br>
                {{ $store["latitude"] }},{{ $store["longititude"] }}<br>
                Phone: {{ $store["phone"] }}<br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Customer
              <address>
                <strong>{{ $transaction["customer_name"] }}</strong><br>
                {{ $transaction["address_customer"] }}<br>
                {{ $transaction["latitude"] }},{{ $transaction["longitude"] }}<br>
                Phone: {{ $transaction["customer_phone"] }}<br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                @if ($driver != null)
                Driver
                <address>
                  <strong>{{ $driver["name"] }}</strong><br>
                  Plat kendaraan {{ $driver["plat"] }}<br>
                  Phone {{ $driver["phone"] }}<br>
                </address>
                @endif


            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($detailTransaction as $item )
                    <tr>
                        <td>{{ $item['count']}}</td>
                        <td>{{ $item['name_product'] }}</td>
                        <td>{{ $item['category']}}</td>
                        <td>Rp {{ number_format($item['price_product'] * $item['count'],'0',',','.') }}</td>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">

            </div>
            <!-- /.col -->
            <div class="col-6">
              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>Rp {{ number_format($totalTransaction,'0',',','.') }}</td>
                  </tr>
                  <tr>
                    <th>Biaya Driver</th>
                    <td>Rp {{ number_format($transaction["driver_price"],'0',',','.') }}</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>Rp {{ number_format($totalTransaction + $transaction["driver_price"],'0',',','.') }}</td>
                  </tr>
                </tbody></table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
              <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                Payment
              </button>
              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
              </button>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
@endsection
