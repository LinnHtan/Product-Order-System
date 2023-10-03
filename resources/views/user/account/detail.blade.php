@extends('user.layouts.main')

@section('content')

<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-7 offset-3">
                <div class="card">
                    @if (session('updateSuccess'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>{{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 offset-1">
                                <div class="image">
                                    <a href="#">
                                        @if (Auth::user()->image == null)
                                            <img
                                               class=" img-thumbnail" style="height: 200px; width:350px"  src="{{ asset('image/' . (Auth::user()->gender == 'male' ? 'user.png' : 'girl.png')) }}" />
                                        @else
                                            <img class=" img-thumbnail" style="height: 200px; width:350px" src="{{ asset('storage/' . Auth::user()->image) }}"
                                                alt="John Doe" />
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-5 offset-1">
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-file-signature me-4"></i>{{ Auth::user()->name }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-envelope me-4"></i>{{ Auth::user()->email }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-phone me-4"></i>{{ Auth::user()->phone }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-mars-and-venus me-4"></i>{{ Auth::user()->gender }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-location-dot me-4"></i>{{ Auth::user()->address }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-regular fa-calendar me-4"></i>{{ Auth::user()->created_at->format('j-F-y') }}</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 offset-5">
                                <a href="{{ route('user#profileChangePage') }}">
                                    <button class="btn bg-dark text-white">
                                        <i class="fa-solid fa-file-pen me-3"></i>Edit Profile
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


