@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">
                    <button>
                        <i class="fa-solid fa-arrow-left fs-3 ms-2 mb-3" onclick="history.back()"></i>
                    </button>
                    <div class="card col-5">
                        <div class="card-title   mt-2">
                            <h3><i class="fa-solid me-2 ms-2  fa-circle-info"></i>Order Info</h3>
                        </div>
                      <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                            <div class="col"><strong>{{ strtoupper($orderList[0]->user_name) }}</strong></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                            <div class="col"><strong>{{ $orderList[0]->order_code }}</strong></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-calendar me-2"></i>Order Date</div>
                            <div class="col"><strong>{{ $orderList[0]->created_at->format('d-M-y') }}</strong></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col"><i class="fa-solid fa-money-bill-1-wave me-2"></i>Total Price</div>
                            <div class="col"><strong>{{ $order->total_price }}</strong></div>
                        </div>
                        <div class="d-flex ms-5 text-warning "><i class="fa-solid fs-4 fa-triangle-exclamation me-2"></i><h5>Delivery charges include!</h5></div>
                      </div>
                    </div>
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Image</th>
                                <th>User ID</th>
                                <th>Order ID</th>
                                <th>Quantity</th>
                                <th>Product Name</th>
                                <th>Amount</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>

                               @foreach ($orderList as $o)
                               <tr class="tr-shodow">
                                <td></td>
                                <td>
                                    <img class="img-thumbnail" style="height: 80px; width:100px" src="{{ asset('storage/'.$o->product_image) }}" alt="">
                                </td>
                                <td>{{ $o->user_id }}</td>
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->qty }}</td>
                                <td>{{ $o->product_name }}</td>
                                <td>{{ $o->total }}</td>
                                <td>{{ $o->created_at->format('d-M-y') }}</td>
                            </tr>
                               @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection





