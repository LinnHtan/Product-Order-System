@extends('user.layouts.main')

@section('title','Category List Page')

@section('content')


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        @if (session('changeSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('changeSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <hr>
                        <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="mb-1 control-label">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password"  class=" @if(session('notMatch')) is-invalid @endif form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter old name...">
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                                @if (session('notMatch'))
                                <div class="invalid-feedback">
                                    {{ session('notMatch') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="mb-1 control-label">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new name...">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="mb-1 control-label">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password"  class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter confirm name...">
                                @error('confirmPassword')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-white btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    <i class="fa-solid fa-key"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


