@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-2 offset-1 mb-3">
                <a href="{{ route('admin#detailPage') }}">
                    <button class=" fs-2"><i class="fa-solid fa-circle-left"></i></button>
                </a>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3 class="text-center title-2">Edit Account Info</h3>
                        </div>
                        @if (session('updateSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <hr>
                        <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 ">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->image == null)
                                                <img
                                                   class=" img-thumbnail"  src="{{ asset('image/' . (Auth::user()->gender == 'male' ? 'user.png' : 'girl.png')) }}" />
                                            @else
                                                <img class=" img-thumbnail" src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    alt="John Doe" />
                                            @endif
                                        </a>
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
                                        <input id="cc-pament" name="name" value="{{ old('name',Auth::user()->name) }}" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new name...">
                                        @error('name')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" value="{{ old('email',Auth::user()->email) }}" type="email"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your email...">
                                        @error('email')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" value="{{ old('phone',Auth::user()->phone) }}" type="number"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone...">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" value="{{ old('gender',Auth::user()->gender) }}" class="form-control @error('gender') is-invalid @enderror" id="">
                                            <option value="">Choose option</option>
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif class="form-control">Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif class="form-control">Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" value="" id="" class="form-control @error('address') is-invalid @enderror" >{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" value="{{ old('role',Auth::user()->role) }}" type="text"  class="form-control " aria-required="true" aria-invalid="false" disabled >
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


