@extends('Layout.adminHome')
@section('contact')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-1">
            <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3">Back</button></a>
        </div>
    </div>
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Add List</h3>
                </div>
                <hr>
                <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Image</label>
                        <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" aria-required="true" aria-invalid="false" placeholder="Enter Image...">
                        @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                        @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Category</label>
                        <select name="category" id="" class="form-control">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $item )
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>

                            @endforeach

                        </select>
                        @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Price</label>
                        <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                        @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Description</label>
                       <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid

                       @enderror">{{ old('description') }}</textarea>
                        @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                        <input id="cc-pament" name="waitingTime" type="number" class="form-control @error('waitingTime') is-invalid @enderror" value="{{old('waitingTime')}}" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time..">
                        @error('waitingTime')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror
                    </div>


                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-secondary btn-block">
                            <i class="fa-solid fa-key"></i>
                             <span id="payment-button-amount" class="ms-2">Add</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>

                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection




