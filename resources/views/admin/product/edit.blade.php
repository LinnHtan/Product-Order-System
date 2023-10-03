@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-2 offset-1 mb-3">
                <a href="{{ route('products#list') }}">
                    <button class=" fs-2"><i class="fa-solid fa-circle-left"></i></button>
                </a>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3 class="text-center title-2">Edit Product Info</h3>
                        </div>
                        @if (session('updateSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <hr>
                        <form action="{{ route('products#update',$product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 ">
                                    <div class="">

                                        <img class="img-thumbnail shadow-sm" style="width:300px" src="{{ asset('storage/'.$product->image) }}"  />


                                    </div>
                                    <div class="mt-3 shadow-sm">
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row  mt-3">
                                        <div class="">
                                            <button class="btn bg-dark text-white col-12">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Update
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 offset-1">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" value="{{ old('name',$product->name) }}" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new name...">
                                        @error('name')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="description" value="" id="" class="form-control @error('description') is-invalid @enderror" >{{ old('description',$product->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="category" value="{{ old('category',$product->category_id) }}" class="form-control @error('category') is-invalid @enderror" id="">
                                            <option value="">Choose option</option>
                                            @foreach ($category as $c)
                                            <option value="{{ $c->id }}" @if ($product->category_id == $c->id) selected @endif >{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" value="{{ old('price',$product->price) }}" type="number"  class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone...">
                                        @error('price')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="waitingTime" value="{{ old('waitingTime',$product->waiting_time) }}" type="text"  class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new name...">
                                        @error('waitingTime')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="view_count" disabled value="{{ old('phone', $product->view_count) }}" type="number"  class="form-control @error('view_count') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone...">

                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                        <input id="cc-pament" name="created_at" value="{{ $product->created_at->format('j-F-y') }}" disabled type="text"  class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter your phone...">

                                    </div>


                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


