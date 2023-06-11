@extends('UserLayouts.master')
@section('contact')
@if (session('fail'))
<div class="row">
    <div class="alert alert-danger alert-dismissible fade show col-6 offset-3" role="alert">
        <div class="text-black">{{ session('fail') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<div class="container-fluid">
    <div class="row">

    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Password</h3>
                </div>
                <hr>
                <form action="{{ route('userInfo#changePassword',Auth::user()->id) }}" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                        <input id="cc-pament" name="oldPassword" type="text" class="form-control @error('oldPassword') is-invalid @enderror" value="{{ old('oldPassword') }}" aria-required="true" aria-invalid="false" placeholder="oldPassword...">
                        @error('oldPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                        <input id="cc-pament" name="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror" value="{{ old('newPassword') }}" aria-required="true" aria-invalid="false" placeholder="newPassword...">
                        @error('newPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                        <input id="cc-pament" name="confirmPassword" type="text" class="form-control @error('confirmPassword') is-invalid @enderror" value="{{ old('confirmPassword') }}" aria-required="true" aria-invalid="false" placeholder="confirmPassword...">
                        @error('confirmPassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>


                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-white btn-block">
                            <i class="fa-solid fa-key"></i>
                             <span id="payment-button-amount" class="ms-2">Change Password</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
