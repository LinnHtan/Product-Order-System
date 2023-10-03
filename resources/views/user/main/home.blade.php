@extends('user.layouts.main')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="my-2 mx-2 section-title position-relative text-uppercase"><span class=" m-3 ">Filter by price</span></h5>
            <div class="p-4 bg-light mb-30">
                <form>
                    <div class="px-3 py-2 mb-3  rounded  text-dark bg-warning d-flex align-items-center justify-content-between">

                        <label class="mt-2 " for="price-all"> <h5>Categories</h5> </label>
                        <span class="border badge font-weight-normal">{{ count($category) }}</span>
                    </div>
                    <hr>
                    <a href="{{ route('user#home') }}" class=" mb-2 form-control text-decoration-none " ><label  for="price-1"> <h6>All</h6> </label></a>
                    @foreach ($category as $c)
                    <div class="pt-1 mb-2 d-flex align-items-center justify-content-between">
                        <a href="{{ route('user#filter',$c->id) }}" class=" form-control text-decoration-none " ><label  for="price-1"> <h6>{{ $c->name }}</h6> </label></a>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->
            <div class="">
                <button class="btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>

        <div class="col-lg-9 col-md-8">
            <div class="pb-3 row">
                <div class="pb-1 col-12">
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div>
                            <a href="{{ route('user#cartDetailPage') }}">
                                <button type="button" class="btn btn-warning position-relative">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>Cart
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                      {{ count($cart) }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                            <a href="{{ route('user#history') }}" class="ms-3" >
                                <button type="button" class="btn btn-warning position-relative">
                                    <i class="fa-solid fa-clock-rotate-left me-2"></i>History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                      {{ count($history) }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control shadow-md" >
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="dataList">
                    @if (count($product) != 0)
                    @foreach ($product as $p)
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                         <div class="mb-4 product-item bg-light" id="myForm" >
                             <div class="overflow-hidden product-img position-relative">
                                 <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/'.$p->image) }}" alt="">
                                  <div class="product-action">
                                     <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                     <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetailPage',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>

                                 </div>
                             </div>
                             <div class="py-4 text-center">
                                 <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                 <div class="mt-2 d-flex align-items-center justify-content-center">
                                     <h5>{{ $p->price }} kyats</h5>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @endforeach
                    @else
                     <div class="">
                        <h2 class="bg-warning col-8 offset-2 text-center rounded text-dark py-3">There is no product!</h2>
                     </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
    $('#sortingOption').change(function(){
        $eventOption = $('#sortingOption').val();

        if($eventOption == 'asc'){
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/product/list',
                data : {'status' : 'asc'},
                dataType : 'json',
                success : function(response){
                    $list = '';
                    for($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                        <div class="mb-4 product-item bg-light" id="myForm" >
                            <div class="overflow-hidden product-img position-relative">
                                <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="py-4 text-center">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="mt-2 d-flex align-items-center justify-content-center">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                        `;
                    }
                    $('#dataList').html($list);
                }
               })
        }else if($eventOption == 'desc'){
            $.ajax({
                type : 'get',
                url : '/user/ajax/product/list',
                data : {'status' : 'desc'},
                dataType : 'json',
                success : function(response){
                    // console.log(response[0].name);
                    $list = '';
                    for($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                        <div class="mb-4 product-item bg-light" id="myForm" >
                            <div class="overflow-hidden product-img position-relative">
                                <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="py-4 text-center">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="mt-2 d-flex align-items-center justify-content-center">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                        `;
                    }
                    $('#dataList').html($list);
                }
               })
        }
    })
    })
</script>

@endsection




