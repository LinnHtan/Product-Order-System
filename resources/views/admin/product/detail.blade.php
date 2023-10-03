@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="">
                        <a href="{{ route('products#list') }}">
                            <button>
                                <i class="fa-solid fa-arrow-left fs-3 ms-4 mt-2"></i>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3 class="text-center title-2">Product Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">

                                <img class="img-thumbnail shadow-sm" src="{{ asset('storage/'.$product->image) }}"  />

                            </div>
                            <div class="col-6 offset-2">
                                <div class="my-2 btn bg-danger fs-5 text-white d-block w-50 text-center">{{$product->name }}</div>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-solid fa-clone me-4"></i>{{ $product->category_name }}</h4>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-solid fa-money-bill-1 me-4"></i>{{ $product->price }} kyats</h4>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-solid fa-eye me-4"></i>{{ $product->view_count }}</h4>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-regular fa-clock me-4"></i>{{ $product->waiting_time }} mins</h4>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-regular fa-calendar me-4"></i>{{ $product->created_at->format('j-F-y') }}</h4>
                                <h4 class="my-3 shadow-sm btn bg-dark text-white "><i class="fa-solid fa-file-signature me-4"></i> Detail</h4>
                                <h4>{{ $product->description }}</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 offset-5">
                                <a href="{{ route('products#edit',$product->id) }}">
                                    <button class="btn bg-dark text-white">
                                        <i class="fa-solid fa-file-pen me-3"></i>Edit Product
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


