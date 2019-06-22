@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center text-light">
        <div class="col">
            <div class="row">
                <div class="col">
            <h2>
                <span class="badge badge-primary">Address</span>
            </h2>
            <p>
                {{ $order->shipping_address }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>
                <span class="badge badge-primary">Zip Code</span>
            </h2>
            <p>
                {{ $order->zip_code }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>
                <span class="badge badge-primary">Subtotal</span>
            </h2>
            <p>
                $ {{ $order->total_price }}
            </p>
        </div>
    </div>
</div>
</div>
<div class="row justify-content-center text-light">
    <div class="col">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItem as $orderItem)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <img src="{{ asset('/images/'.$orderItem->product->images->first()->image_src) }}" width="100" height="100" class="image-responsive">
                        </div>
                        <div  class="col-sm-9">
                            <a href="{{ route('products.show', ['id' => $orderItem->product->id]) }}">
                                <h4 class="nomargin">{{ $orderItem->product->name }}</h4>
                            </a>
                        </div>
                    </div>
                    </td>
                    <td data-th="Price">
                       $ {{ $orderItem->price }}
                    </td>
                    <td data-th="Quantity">
                        {{ $orderItem->quantity }}
                    </td>
                    <td data-th="Subtotal" class="text-center">
                       $ {{ $orderItem->price * $orderItem->quantity }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection

                
