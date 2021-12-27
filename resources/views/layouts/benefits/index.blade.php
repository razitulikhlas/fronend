@extends('layouts.main')
@section('container')

 <div class="card">
            <div class="card-header" style="background-color: aqua">
              <h3 class="card-title">DATA {{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="background-color: #212529; color: white;" >


<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">NO</th>
			<th width="15%">NOTRANSAKSI</th>
			<th width="15%">KEUNTUNGAN</th>
            <th width="10%">TAX STORE</th>
            <th width="15%">TAX DRIVER</th>
			<th width="15%">DATE</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($data as $item )
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $item['notransaksi']}}</td>
			<td>{{ $item['totalBenefit']}}</td>
			<td>{{ $item['taxStore']}}</td>
			<td>{{ $item['taxDriver'] }}</td>
			<td>{{ $item['date'] }}</td>
			<td>
				<div class="btn-group">
					<a href="transaksi/{{ $item["notransaksi"] }}" class="btn btn-info btn-sm" >
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
    $('#formEdit').attr('action','/store/'+$(this).data('id'));
	})
});
</script>
@endsection
