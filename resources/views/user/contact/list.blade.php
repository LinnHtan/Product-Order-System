@extends('user.layouts.main')
@section('content')


    <div class="container ">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    @if(session('sendSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>{{ session('sendSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <div class="card-title">
                        <h3 class="text-center title-2">Contact With Us</h3>
                    </div>
                    <hr>
                    <form action="{{ route('contact#contactAdmin') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your name...">
                            @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Email</label>
                            <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your email...">
                            @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Message</label>
                           <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" placeholder="Enter your message..."></textarea>
                            @error('message')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                <span id="payment-button-amount">Send</span>
                                <i class="fa-solid fa-circle-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

