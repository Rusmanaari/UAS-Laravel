@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center text-dark">
		<div class="col">
			<div class="card">
                <div class="card-header text-center text-light" style="background-color:#FF8C00">List Orders</div>
			<!-- <div>
				<br>
				<a href="{{ url('products') }}" class="btn btn-primary"> Add Product</a>
			</div> -->
			<br>
			<div class="table-responsive">
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<th>No</th>
							<th>Subtotal</th>
							<th>Status</th>
							<th>Zip Code</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $order)
						<tr>
							<td>{{ $order['id'] }}</td>
							<td>$ {{ $order['total_price'] }}</td>
							<td>{{ $order['status'] }}</td>
							<td>{{ $order['zip_code'] }}</td>
							<td>{{ $order['shipping_address'] }}</td>
							<td>
								<a href="{{ route('user.orders.show', ['id' => $order['id']]) }}">
									Show
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

					