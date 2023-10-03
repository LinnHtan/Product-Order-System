@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="mb-3">
                    <a href="{{ route('admin#listPage') }}">
                        <button>
                            <i class="fa-solid fa-arrow-left fs-3 ms-4 mt-2"></i>
                        </button>
                    </a>
                </div>
                <div class="card">

                    <div class="card-body">

                        <div class="card-title mb-3">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                <div class="image">
                                    <a href="#">
                                        @if ($account->image == null)
                                            <img
                                               class=" img-thumbnail"  src="{{ asset('image/' . ($account->gender == 'male' ? 'user.png' : 'girl.png')) }}" />
                                        @else
                                            <img class=" img-thumbnail" src="{{ asset('storage/' .$account->image) }}"
                                                alt="John Doe" />
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 offset-2">
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-file-signature me-4"></i>{{ $account->name }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-envelope me-4"></i>{{ $account->email }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-phone me-4"></i>{{ $account->phone }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-mars-and-venus me-4"></i>{{ $account->gender }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-solid fa-location-dot me-4"></i>{{ $account->address }}</h4>
                                <h4 class="my-3 shadow-sm"><i class="fa-regular fa-calendar me-4"></i>{{ $account->created_at->format('j-F-y') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


