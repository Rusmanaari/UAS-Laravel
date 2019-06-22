@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center text-light">
		<div class="col">
			<h2>Add Address</h2>
			<br>
			@if(count($errors))
			<div class="form-group">
				<div class="alert-danger alert">
					<ul>
						@foreach($errors->all() as $error)
						<li>(($error))</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
		<br>
		<form action="{{route ('user.orders.store')}}" method="POST">
			@csrf
			<div class="form-group">
				<label>Address</label>
				<textarea name="shipping_address" class="form-control" rows="3" placeholder="Address"></textarea>
			</div>
			<div class="form-group">
				<label>Zip Code</label>
				<input type="number" name="zip_code" class="form-control" placeholder="Zip Code">
			</div>
			<button type="submit" class="btn btn-primary btn-sm">Save</button>
		</form>
	</div>	
	</div>
</div>
@endsection