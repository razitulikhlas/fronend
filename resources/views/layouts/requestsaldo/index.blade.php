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
<div class="row">
    <div class="col-md-6 col-sm-6 col-12">
        <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Store</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

    <table class="table table-bordered table-sm" id="example1">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="20%">NAMA BANK</th>
                <th width="20%">NAMA REKENING</th>
                <th width="20%">type</th>
                <th width="15%">SALDO</th>
                <th width="10%">Status</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($store as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>
                    <img src="{{ env('BASE_URL_IMAGE'). $item['image'] }}" class=" elevation-2" style="width: 80px" >
                </td> --}}
                <td>{{ $item['namabank']}}</td>
                <td>{{ $item['nama']}}</td>
                @if ($item['type'] == 'deposit')
                <td> <span class="badge rounded-pill bg-primary">{{ $item['type']}}</span></td>
                @else
                <td> <span class="badge rounded-pill bg-success">{{ $item['type']}}</span></td>
                @endif

                <td>Rp {{ number_format($item['saldo'],'0',',','.') }}</td>
                @if ($item['status'] == 'pending')
                <td> <span class="badge rounded-pill bg-warning">{{ $item['status']}}</span></td>
                @elseif($item['status'] == 'failed')
                <td> <span class="badge rounded-pill bg-danger">{{ $item['status']}}</span></td>
                @else
                <td> <span class="badge rounded-pill bg-success">{{ $item['status']}}</span></td>
                @endif
                <td>
                    <div class="btn-group">
                        <button type="button" id="edit" class="btn btn-info btn-sm position-relative" data-image="{{ $item["image"] }}" data-category="store" data-id="{{ $item['id'] }}" data-title="{{ $item['type'] }}" data-type="{{ $item['type'] }}" data-id="{{ $item['id'] }}" data-namebank="{{ $item['namabank'] }}"  data-name="{{ $item['nama'] }}" data-norek="{{ $item['norek'] }}" data-saldo="{{ $item['saldo'] }}" data-status="{{ $item['status'] }}"  data-toggle="modal" data-target="#insert">
                            <i class="fa fa-eye"></i>Detail
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /header -->
</div>
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-6 col-12">
        <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">Driver</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >

    <table class="table table-bordered table-sm" id="example2">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="20%">NAMA BANK</th>
                <th width="20%">NAMA REKENING</th>
                <th width="20%">type</th>
                <th width="15%">SALDO</th>
                <th width="10%">Status</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($driver as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>
                    <img src="{{ env('BASE_URL_IMAGE'). $item['image'] }}" class=" elevation-2" style="width: 80px" >
                </td> --}}
                <td>{{ $item['namabank']}}</td>
                <td>{{ $item['nama']}}</td>
                @if ($item['type'] == 'deposit')
                <td> <span class="badge rounded-pill bg-primary">{{ $item['type']}}</span></td>
                @else
                <td> <span class="badge rounded-pill bg-success">{{ $item['type']}}</span></td>
                @endif

                <td>Rp {{ number_format($item['saldo'],'0',',','.') }}</td>
                @if ($item['status'] == 'pending')
                <td> <span class="badge rounded-pill bg-warning">{{ $item['status']}}</span></td>
                @elseif($item['status'] == 'failed')
                <td> <span class="badge rounded-pill bg-danger">{{ $item['status']}}</span></td>
                @else
                <td> <span class="badge rounded-pill bg-success">{{ $item['status']}}</span></td>
                @endif
                <td>
                    <div class="btn-group">
                      <button type="button" data-image="{{ $item['image'] }}" id="edit" class="btn btn-info btn-sm position-relative" data-category="driver" data-id="{{ $item["id"] }}" data-title="{{ $item['type'] }}" data-type="{{ $item["type"] }}" data-id={{ $item["id"] }} data-namebank="{{ $item["namabank"] }}"  data-name="{{ $item["nama"] }}" data-norek="{{ $item["norek"] }}" data-saldo="{{ $item["saldo"] }}" data-status="{{ $item["status"] }}"  data-toggle="modal" data-target="#insert">
                        <i class="fa fa-eye"></i>Detail
                    </button>

                        {{-- <a href="customer/{{ $item['id'] }}" class="btn btn-info btn-sm" >
                                <i class="fa fa-eye"></i> Detail
                            </a> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /header -->
</div>
    </div>

    <!-- /.col -->
  </div>


  <div class="modal fade bd-example-modal-xl" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel" id="titleModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="formEdit" action="" method="post" >
                @method('put')
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" name="category" id="category" placeholder="Kode Dokter">
                </div>
                <div class="form-group">
                    <label for="namebank">NAMA BANK</label>
                    <input type="text" name="namebank" disabled class="form-control" id="namebank" placeholder="Nama Bank">
                </div>
                <div class="form-group">
                    <label for="name">NAMA REKENING</label>
                    <input type="text" class="form-control" disabled id="name" name="name" placeholder="Nama Rekening">
                </div>
                <div class="form-group">
                <label for="norek">NO REKENING</label>
                <input type="text" class="form-control" disabled id="norek" name="nohp" placeholder="No Rekening">
                </div>
                <div class="form-group">
                <label for="type">TYPE</label>
                <input type="text" class="form-control" disabled id="type" name="type" placeholder="Type">
                </div>
                <div class="form-group">
                <label for="saldo">SALDO</label>
                <input type="text" class="form-control" disabled id="saldo" name="saldo" placeholder="saldo">
                </div>
                <div class="form-group">
                <label id="tvImg" for="platkendaraan">IMAGE</label>
                <br>
                {{-- <img src="{{ asset('admin/dist/img/boxed-bg.jpg') }}" class="img-thumbnail" alt="..."> --}}
                <img id="imgTransaksi" src=""  style="width: 400px,height:400px"  alt="...">
                </div>
            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btnProses" class="btn btn-primary">Terima</button>
            <a id="btnCancel" href="" class="btn btn-danger" >Cancel</a>

            </form>
            </div>
        </div>
    </div>
</div>


<script>
$(function() {
  $(document).on('click','#edit',function(){
       const namebank = $(this).data('namebank');
        const name = $(this).data('name');
        const norek = $(this).data('norek');
        const saldo = $(this).data('saldo');
        const status = $(this).data('status');
        const type = $(this).data('type');
        const title = $(this).data('title');
        const id = $(this).data('id');
        const category = $(this).data('category');
        const base_url =  $(this).data('image');

        if(type != 'deposit'){
            $('#imgTransaksi').hide()
            $('#tvImg').hide()
        }else{
            $('#imgTransaksi').show()
            $('#tvImg').show()
        }

        console.log("base "+base_url);

         $("#btnProses").show();
         $("#btnCancel").show();

        if(status == "success"){
            $("#btnProses").hide();
            $("#btnCancel").hide();
        }
        $("#namebank").val(namebank);
        $("#name").val(name);
        $("#norek").val(norek);
        $("#saldo").val(saldo);
        $("#status").val(status);
        $("#type").val(type);
        $("#category").val(category);
        $("#titlemodal").text("Proses "+title);
        $('#imgTransaksi').attr('src',"http://34.221.228.202:8081/images/"+base_url);
        $('#formEdit').attr('action','/request/'+$(this).data('id')+'/success/'+category);
        $('#btnCancel').attr('href','/request/'+$(this).data('id')+'/failed/'+category);
	})

});
</script>
@endsection


