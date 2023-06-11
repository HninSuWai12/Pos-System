@extends('Layout.adminHome')
@section('contact')
<div class="container-fluid">
    <div class="row">
<div class="col-3">




</div>
<div class="col-lg-6 ">
    <div class="card">
        <div class="card-body ">
            <div class="card-title">
                <a href="{{ route('admin#list') }}" class=""><i class="fa-solid fa-arrow-left text-black"></i></a>
                <h3 class="text-center title-2">Account Info</h3>
            </div>
            <hr>
            <div class="row ">
                <div class="col-4 offset-1 ">
                    @if(Auth::user()->image == null)
            <img src="{{ asset('images/blank-profile-picture-973460__340.webp') }}" class="img-thumbnail img-fluid" alt="">
            @else
            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail  w-30 h-35" alt="">
               @endif
               <div>
               <a href="{{ route('info#editInfo') }}">
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    <i class="fa-solid fa-key"></i>
                     <span id="payment-button-amount" class="ms-2">Change Info</span>
                    <span id="payment-button-sending" style="display:none;">Sending…</span>

                </button></a>
            </div>
                </div>
                <div class="col-4 offset-1">
                   <h4 class="mt-3"><i class="fa-solid fa-id-card-clip me-2"></i>{{ Auth::user()->name }}</h4>
                   <h4 class="mt-3"><i class="fa-regular fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                   <h4 class="mt-3"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                   <h4 class="mt-3"><i class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}</h4>
                   <h4 class="mt-3"><i class="fa-solid fa-mars-stroke-up me-2"></i>{{ Auth::user()->gender }}</h4>

                </div>
            </div>
        </div>
    </div>
</div>
    </div>

</div>
@endsection
