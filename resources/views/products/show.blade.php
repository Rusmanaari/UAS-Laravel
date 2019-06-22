@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
                
                @if(!$product->images()->get()->isEmpty())
                <div class="text-center">
                    <image src="{{ asset('/images/'.$product->images()->get()[0]->image_src) }}" class="img-thumbnail img-fluid" style="width: 200px; height: 300px;"></image>
                </div>
                @endif
            </div>
                <div class="col-md-9 text-light">
                    <h3>
                        {{ $product->name }}
                    </h3>
                        <?php
                        $total = 0;
                        $jumlah = 0;
                        $avg = 0;

                        foreach($reviews as $id => $review)
                        {
                            $total += $review->rating;
                        }

                        $jumlah = count($reviews->all());
                        
                        // echo $total."total bintang";
                        // echo $jumlah."jumlah data";
                        // echo "rata-rata = ".$avg;

                        $star = 1; 
                        if($jumlah<>0)
                        {
                            $avg = $total / $jumlah;
                            while($star <= 5)
                            {
                                while($star <= $avg)
                                {
                                    echo '<i class="fas fa-star fa-1x" style="color:yellow"></i>';
                                    $star++;
                                }
                                
                                while($star <= 5)
                                {
                                    echo '<i class="far fa-star fa-1x" style="color:yellow"></i>';
                                    $star++;
                                }
                            }
                        }

                        else
                        {
                            while($star <= 5)
                            {
                                echo '<i class="far fa-star fa-1x" style="color:yellow"></i>';
                                $star++;
                            }
                        }
                    ?>
                    <br><br>
                    <h4>
                       $ {{ $product->price }}
                    </h4>

                    <div class="mt-4">
                        <a class="btn btn-success btn-sm" href="{{route('user.orders.create')}}">Buy</a>
                        <a class="btn btn-dark btn-sm" href="{{ route('carts.add', ['id' => $product['id']]) }}">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i> Add To Cart</a>
                    </div>
                    <br>
                    <div class="mt-2">
                        <div class="row">
                            <h4><strong class="mr-2 ml-3">Share on :</strong></h4>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('products.show', ['id' => $product['id']]) }}" class="icn mr-3 social-button" target="_blank">
                                    <i class="fab fa-facebook-f fa-2x" ></i>
                                </a> 
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('products.show', ['id' => $product['id']]) }}" class="icn mr-3 social-button" target="_blank">
                                    <i class="fab fa-twitter fa-2x"></i>
                                </a> 
                                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('products.show', ['id' => $product['id']]) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="icn mr-3 social-button" target="_blank">
                                    <i class="fab fa-linkedin-in fa-2x"></i>
                                </a> 
                                <a href="https://wa.me/?text={{ route('products.show', ['id' => $product['id']]) }}" class="icn mr-3 social-button" target="_blank">
                                    <i class="fab fa-whatsapp fa-2x"></i>
                                </a>
                            </div>
                        </div>
                     <div class="mt-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link bg-warning text-dark" href="#description" role="tab" data-toggle="tab">Deskripsi</a>
                            </li>
                            <li class="nav-item ml-3">
                                <a class="nav-link bg-warning text-dark" href="#review" role="tab" data-toggle="tab">Review</a>
                            </li>
                        </ul>

                        <!-- Tab panel -->
                        <div class="tab-content mt-2">
                            <div role="tabpanel" class="tab-pane fade in active show" id="description">
                                {!! $product->description !!}
                            </div>
                        
                             
                            <div role="tabpanel" class="tab-pane fade" id="review"><br>
                                @if(Auth::check())
                                <form method="POST" action="{{route('review.store')}}">
                                    Rating
                                    <br>
                                    <span class="star-rating star-5">
                                      <input type="radio" name="rating" value="1"><i></i>
                                      <input type="radio" name="rating" value="2"><i></i>
                                      <input type="radio" name="rating" value="3"><i></i>
                                      <input type="radio" name="rating" value="4"><i></i>
                                      <input type="radio" name="rating" value="5"><i></i>
                                    </span>
                                    <br>
                                    Deskripsi
                                   
                                    @csrf
                                    <input type="hidden" name="id_product" value="{{$product->id}}">
                                    
                                    <textarea type="number" class="form-control" rows="3" name="review" id="desc"></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-success">Review</button>
                                </form>
                                <br>
                                @else
                                    Login untuk menulis review
                                @endif
                                
    @foreach($reviews as $r)
        <div class="card text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                            <p class="text-secondary text-center">{{ Carbon\Carbon::parse($r->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                <a class="float-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$r->user->name}}</strong></a>
                                
                                <?php
                                    for($i=0; $i<$r->rating; $i++){
                                        echo "<span class='float-right'><i class='text-warning fa fa-star'></i></span>";
                                    }
                                ?>
                            </p>
                            <div class="clearfix"></div>
                                <br>
                                <p>{{ $r->review }}</p>
                                <p>
                                     <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                        <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                   </p>
                </div>
            </div>
           
<!--                 <div class="card card-inner">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                <p class="text-secondary text-center">15 Minutes Ago</p>
                            </div>
                            <div class="col-md-10">
                                <p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Doyok</strong></a></p>
                                <p>Aslina eta teh?</p>
                                <p>
                                    <a class="float-right btn btn-outline-primary ml-2">  <i class="fa fa-reply"></i> Reply</a>
                                    <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                               </p>
                            </div>
                        </div>
                    </div>
                </div> -->
        </div>
    @endforeach
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
