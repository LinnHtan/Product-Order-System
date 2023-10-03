@extends('user.layouts.main')

@section('content')


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover  text-center mb-0" id="dataTable">
                <thead class="thead-dark ">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cart as $c)
                    <tr>
                        <td><img src="{{ asset('storage/'.$c->product_image) }}" class="img-thumbnail" style="width: 80px; height:80px"></td>
                        <td class="align-middle">{{ $c->product_name }} </td>
                        <input type="hidden" class="orderId" value="{{ $c->id }}">
                            <input type="hidden" class="productId" value="{{ $c->product_id }}" >
                            <input type="hidden" class="userId" value="{{ $c->user_id }}" >
                        <td class="align-middle" id="price" >{{ $c->product_price }} kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->qty }}" id="qty" >
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle col-2" id="total" >{{ $c->product_price*$c->qty }} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" id="btnRemove" ><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3 mt-1"><span class=" bg-dark text-white rounded p-1">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>SubtotalPrice</h6>
                        <h6 id="subTotal">{{ $totalPrice }} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice" >{{ $totalPrice + 3000 }} kyats</h5>
                    </div>
                    <button id="orderBtn" class="btn btn-block btn-warning font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Clear cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        //when + click
        $('.btn-minus').click(function(){
           $parentNode = $(this).parents("tr");
           $price = Number($parentNode.find('#price').text().replace("kyats",""));
           $qty = $parentNode.find('#qty').val();
           $total = $price*$qty;
           $parentNode.find('#total').html(`${$total} kyats`);
           summaryCalculation();

        })
         //when + click
        $('.btn-plus').click(function(){
               $parentNode = $(this).parents("tr");
               $price = Number($parentNode.find('#price').text().replace("kyats",""));
               $qty = $parentNode.find('#qty').val();
               $total = $price*$qty;
               $parentNode.find('#total').html(`${$total} kyats`);
                summaryCalculation();

        })


        function summaryCalculation(){
            $totalPrice = 0;
               $('#dataTable tbody tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace("kyats",""));
               });

               $("#subTotal").html(`${$totalPrice} kyats`)
               $("#finalPrice").html(`${$totalPrice+3000} kyats`)
        }
        $('#orderBtn').click(function(){
            $orderList = [];
            $random = Math.floor(Math.random() * 100001);
            $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id' : $(row).find('.userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace('kyats','')),
                    'order_code' : 'O-CODE '+$random
                });
               });
               $.ajax({
                type : 'get',
                url : '/user/ajax/order',
                data : Object.assign({}, $orderList) ,
                dataType : 'json',
                success : function(response){
                    if(response.status == "success"){
                        window.location.href = "/user/homePage";
                    }
                 }
               })

        });



    })
    //to clear cart
    $('#clearBtn').click(function(){
        $('#dataTable tbody tr').remove();
        $('#subTotal').html("0 kyats");
        $('#finalPrice').html("3000 kyats");

        //to delete in database
        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/clear/cart',
            dataType : 'json',
            success : function(response){
                if(response.status == "success"){
                    window.location.href = "http://127.0.0.1:8000/user/homePage";
                }
             }
           })

    })

    //when cross + delete btn click
    $('.btnRemove').click(function(){
        $parentNode = $(this).parents("tr");
        $productId = $parentNode.find(".productId").val();
        $orderId = $parentNode.find(".orderId").val();

        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/clear/current/product',
            data : {'productId' : $productId , 'orderId' : $orderId},
            dataType : 'json',
           })
        $parentNode.remove();
        $totalPrice = 0;
           $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace("kyats",""));
           });

           $("#subTotal").html(`${$totalPrice} kyats`)
           $("#finalPrice").html(`${$totalPrice+3000} kyats`)

    });
</script>
@endsection


