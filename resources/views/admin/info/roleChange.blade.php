@extends('Layout.adminHome')
@section('contact')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('info#infoPage') }}"><button class="btn bg-dark text-white my-3">Back</button></a>
        </div>
    </div>
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Role</h3>
                </div>
                <hr>
                <form action="{{ route('info#changeRole') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="row">
                    <div class="col-3">
                        @if ($data->image == null)
                        <img src="{{ asset('images/blank-profile-picture-973460__340.webp') }} " class="img-thumbnail img-fluid" alt="">
                        @else
                            <img src="{{ asset('storage/'.$data->image) }}" class="img-thumbnail "alt="">
                        @endif

                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ ($data->name) ,old('name')}}" aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>
                            @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Role</label>
                            <select name="role" id="" class="form-control @error('name') is-invalid @enderror">
                                <option value="">Select Role</option>
                                <option value="user" @if ($data->role == "user") selected

                                @endif>User</option>
                                <option value="admin" @if ($data->role=="admin") selected

                                @endif>Admin</option>
                            </select>
                            @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Email</label>
                            <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ ($data->email),old('email') }}" aria-required="true" aria-invalid="false" placeholder="Enter Email..."disabled>
                            @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Phone Number</label>
                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ ($data->phone),old( 'phone') }}" aria-required="true" aria-invalid="false" placeholder="Enter Phone Number..."disabled>
                            @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Address</label>
                            <input id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{  ($data->address),old('address') }}" aria-required="true" aria-invalid="false" placeholder="address..." disabled>
                            @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                            <select name="gender" id="" class="form-control @error('gender') is-invalid

                            @enderror" disabled>
                                <option value="" >Choose Option</option>
                                <option value="Female"  @if ($data->gender == "Female") selected

                                    @endif  >Female</option>
                                <option value="Male"  @if ($data->gender == "Male") selected

                                @endif >Male</option>
                            </select>
                            @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa-solid fa-key"></i>
                                 <span id="payment-button-amount" class="ms-2">Update Info</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>

                            </button>
                        </div>

                    </div>
                   </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection




