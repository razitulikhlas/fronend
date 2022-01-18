@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ isset($data['customer']) ? $data['customer'] : 0}}</h3>
          <p>Customer</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="/customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ isset($data['store']) ? $data['store'] : 0 }}</h3>

          <p>Store</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/store" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{isset($data['driver']) ? $data['driver'] : 0  }}</h3>

          <p>Driver</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/drivers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ isset($data['benefit']) ? $data['benefit'] : 0  }}</h3>

          <p>Keuntungan</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/benefit" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Total transaksi di tahun {{ date("Y") }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="barChart"  width="1000" height="300" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

      </div>

      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Jumlah transaksi di tahun {{ date("Y") }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="chartKeuntungan"  width="1000" height="300" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
      </div>

      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Keuntungan di tahun {{ date('Y') }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="chartBenefit"  width="1000" height="300" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

      </div>
 </div>


  <script>

    $(function () {
      var areaChartDataPrice = {
        labels  : {!! json_encode($month) !!},
        datasets: [
          {
            label               : 'Total transaksi perbulan',
            backgroundColor     : 'rgba(72,61,139,1)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : {!! json_encode($price) !!}
          },
        ]
      }

      var areaChartDataTotal = {
        labels  : {!! json_encode($month) !!},
        datasets: [
          {
            label               : 'Jumlah transaksi perbulan',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : {!! json_encode($totalTransaction) !!}
          },
        ]
      }

      var areaChartBenefit = {
        labels  : {!! json_encode($monthBenefit) !!},
        datasets: [
          {
            label               : 'Jumlah transaksi perbulan',
            backgroundColor     : 'rgba( 72, 209, 204, 1)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : {!! json_encode($priceBenefit) !!}
          },
        ]
      }


      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }


      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartDataPrice)
      var temp0 = areaChartDataPrice.datasets[0]
    //   var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp0
    //   barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

      var barChartCanvas = $('#chartKeuntungan').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartDataTotal)
      var temp0 = areaChartDataTotal.datasets[0]
    //   var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp0
    //   barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

      var barChartCanvas = $('#chartBenefit').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartBenefit)
      var temp0 = areaChartBenefit.datasets[0]
    //   var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp0
    //   barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

    })
  </script>

@endsection
