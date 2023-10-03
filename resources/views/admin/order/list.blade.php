@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <div class="col-5 offset-7">
                        @if(session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                    </div>
                    <div class="col-5 offset-7">
                        @if(session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                    </div>
                    <div class="row mb-2">
                        <div class="col-3 ">
                            <h4><i class="fa-solid fa-database me-4"></i> {{ count($order) }}  </h4>
                        </div>
                        <div class=" col-3 ">

                            <h5 class="text-secondary ">Search Key : <span class="text-danger"> {{ request('searchKey') }}</span></h5>
                        </div>
                        <div class="col-4 ">
                            <form action="{{ route('order#listPage') }}" method="get">
                                @csrf
                                <div class=" d-flex">
                                    <input type="text"  name="searchKey" class=" shadow-sm form-control col-6 offset-9" placeholder="Search...">
                                    <button type="submit" class=" col-2 btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('order#changeStatus') }}" method="post">
                        @csrf
                        <div class="my-3  shadow-sm d-flex">
                            <label class="mt-1 me-2"> <strong>Order Status</strong> </label>
                            <select name="orderStatus" id="orderStatus" class="form-control  col-2 me-2" >
                                <option class="text-center"  value="">All</option>
                                <option class="text-center" @if(request('orderStatus' ) == '0') selected @endif value="0" >Pending</option>
                                <option class="text-center"  @if(request('orderStatus')  == '1') selected @endif  value="1">Accept</option>
                                <option class="text-center" @if(request('orderStatus')  == '2') selected @endif value="2" >Reject</option>
                            </select>
                            <button type="submit" class="btn bg-dark text-white me-2"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>

                        </div>
                    </form>

                    @if(count($order) != 0)
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">

                               @foreach ($order as $o)
                               <tr class="tr-shodow">
                                <input type="hidden" class="orderId" value="{{ $o->id }}" >
                                <td>{{ $o->user_id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td> <a href="{{ route('order#listInfo',$o->order_code) }}" class="text-decoration-none">
                                    {{ $o->order_code }}
                                </a> </td>
                                <td class="amount">{{ $o->total_price }}</td>
                                <td>{{ $o->created_at->format('d-M-y') }}</td>
                                <td>
                                <select name="status" id="" class="form-control statusChange ">
                                    <option class="text-center" value="0"  @if ($o->status == 0 ) selected @endif>Pending</option>
                                    <option class="text-center" value="1" @if ($o->status == 1 ) selected @endif>Accept</option>
                                    <option class="text-center" value="2" @if ($o->status == 2 ) selected @endif>Reject</option>
                                </select>
                                </td>

                            </tr>
                               @endforeach

                        </tbody>
                    </table>
                    @else
                    <h2 class="text-white bg-danger text-center shadow-sm p-2">There is no order list!</h2>
                    @endif
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        $('#orderStatus').change(function(){
            $status = $('#orderStatus').val();

        })
        //change status
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();

            $data = {
                'status' : $currentStatus,
                'orderId' : $orderId
            };
           
            $.ajax({
                type : 'get',
                url : '/order/ajax/change/status',
                data : $data,
                dataType : 'json',
            })
            $('.pagination').hide();



        })
    })
</script>
@endsection




