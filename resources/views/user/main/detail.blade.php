@extends('user.layouts.main')
@section('content')
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId" >
        <input type="hidden" name="" value="{{ $product->id }}" id="productId" >
        <div class="my-2">
            <a href="{{ route('user#home') }}"><i class="fa-solid fs-3 text-dark  fa-arrow-left-long"></i></a>
        </div>
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class=" img-thumbnail" style="height: 400px; width:500px" src="{{ asset('storage/'.$product->image) }}" alt="Image">
                    </div>
            </div>
        </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $product->name }}</h3>
                <div class="d-flex mb-3">
                    <span class="pt-1"><i class="fa-solid fa-eye me-2"></i>{{ $product->view_count + 1 }}</span>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} Kyats</h3>
                <p class="mb-4">{{ $product->description }}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus " >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" id="orderCount" value="1">

                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus " >
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary px-3" id="addCartBtn" ><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
 <div class="container-fluid py-5">
    <h2 class="section-title position-relative text-center  text-uppercase mx-xl-5 mb-4"><span class="bg-dark rounded  my-4 p-2 text-warning ">You May Also Like</span></h2>
    <div class="row px-xl-5 mt-3">
        <div class="col">
            <div class="owl-carousel related-carousel">
            @foreach ($productList as $l)

                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" style="height: 200px" src="{{ asset('storage/'.$l->image) }}" alt="">
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{ $l->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $l->price }}</h5><h6 class="text-muted ml-2">
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>
        $(document).ready(function(){

           //increase view count
           $.ajax({
            type : 'get',
            url : '/user/ajax/increase/viewCount',
            data : {'productId' : $('#productId').val()} ,
            dataType : 'json',

           })


           //click add to cart
            $('#addCartBtn').click(function(){

                $source = {
                    'userId' : $('#userId').val(),
                    'productId' : $('#productId').val(),
                    'count' : $('#orderCount').val()
                };
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/addToCart',
                    data : $source ,
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href = "/user/homePage";
                        }
                    }
                   })
            })

    })
</script>
@endsection
