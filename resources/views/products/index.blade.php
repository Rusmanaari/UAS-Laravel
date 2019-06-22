@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="text-light">Sort By :</label>
                <select id="order_field" class="form-control">
                    <option value="" disabled selected>Urutkan</option>
                    <option value="best_seller">Best seller</option>
                    <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                    <option value="terbaru">Terbaru</option>
                </select>
            </div>
        </div>
        <div class="offset-sm-5">
            <div class="form-group">
                <label class="mr-sm-2 text-light">Category</label>
                <select class="custom-select mr-sm-2" id="category_field">
                    <option disabled selected>Choose category...</option>
                    <option value="osprey">Osprey</option>
                    <option value="eiger">Eiger</option>
                    <option value="consina">Consina</option>
                    <option value="deuter">Deuter</option>
                    <option value="gregori">Gregori</option>
                    <option value="uncategorized">Uncategorized</option>
                </select>
            </div>
        </div>
    </div> 
    <div id="product-list">
     @foreach($products as $idx => $product)
     @if ($idx == 0 || $idx % 4 == 0)
    <div class="row mt-4">
        @endif

        <div class="col">
            <div class="card">
                <br>
                <div class="text-center">
                    <a href="{{ route('products.show', $product->id) }}"> 
                    <image src="{{ asset('/images/' . $product->image_url) }}" class="img-thumbnail img-fluid" style="width: 150px; height: 200px;"></image>
                </a>
                </div>
                    <div class="card-body text-center"> 
                        <h5 class="card-title">
                            <a class="nav-link text-dark" href="{{ route('products.show', $product->id) }}">
                                {{ $product->name }}
                            </a>
                            <hr>
                        </h5>
                        <p class="card-text">
                           <a class="nav-link text-dark font-weight-bold" href="{{ route('products.show', $product->id) }}">
                           $ {{ $product->price }}
                       </a>
                        </p>
                    </a>
                        <a href="{{ route('carts.add', $product->id) }}" class="btn btn-success btn-sm "><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
            @if ($idx > 0 && $idx % 4 == 3)
        </div>
        @endif
    @endforeach
</div>
<?php
$product = App\Models\Product::paginate(3);
?><br>
{{ $product->links() }}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#order_field').change(function(){
            // window.location.href = '/?order_by=' + $(this).val();
            $.ajax({
                type: 'GET', 
                url: '/products',
                data: {
                    order_by: $(this).val(),
                },
                dataType: 'json',
                success: function(data) {
                    var products = '';
                    $.each(data, function(idx, product) {
                        if(idx == 0 || idx % 4 == 0) {
                            products += '<div class="row mt-4">';
                        }
                        products += '<div class="col">' +
                        '<div class="card">' +
                        '<br>' +
                        '<div class="text-center">' +
                        '<img src="/images/' + product.image_url + '" class="img-thumbnail img-fluid" style="width: 150px; height: 200px;" alt="">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' +
                        '<a class="nav-link text-dark" href="/products/' + product.id + '">' +
                        product.name +
                        '</a>' +
                        '<hr>' +
                        '</h5>' +
                        '<p class="card-text">' +
                        product.price +
                        '</p>' +
                        '<a href="/card/add/' + product.id + '" class="btn btn-success">Buy</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                        if(idx > 0 && idx % 4 == 3) {
                            products += '</div>';
                        }
                    });
                    // update element
                    $('#product-list').html(products);
                },
                error: function(data) {
                    alert('Unable to handle request');
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#category_field').change(function(){
            // window.location.href = '/?order_by=' + $(this).val();
            $.ajax({
                type: 'GET', 
                url: '/products',
                data: {
                    order_by: $(this).val(),
                },
                dataType: 'json',
                success: function(data) {
                    var products = '';
                    $.each(data, function(idx, product) {
                        if(idx == 0 || idx % 4 == 0) {
                            products += '<div class="row mt-4">';
                        }
                        products += '<div class="col">' +
                        '<div class="card">' +
                        '<br>' +
                        '<div class="text-center">' +
                        '<img src="/images/' + product.image_url + '" class="img-thumbnail img-fluid" style="width: 150px; height: 200px;" alt="">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' +
                        '<a class="nav-link text-dark" href="/products/' + product.id + '">' +
                        product.name +
                        '</a>' +
                        '<hr>' +
                        '</h5>' +
                        '<p class="card-text">' +
                        product.price +
                        '</p>' +
                        '<a href="/card/add/' + product.id + '" class="btn btn-success">Buy</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                        if(idx > 0 && idx % 4 == 3) {
                            products += '</div>';
                        }
                    });
                    // update element
                    $('#product-list').html(products);
                },
                error: function(data) {
                    alert('Unable to handle request');
                }
            });
        });
    });
</script>
@endsection
