@extends('Layout.adminHome')
@section('contact')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-2">
            <a href="{{ route('products#list') }}"><i class="fa-solid fa-arrow-left text-black"></i></a>
        </div>
    </div>
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Edit Product</h3>
                </div>
                <hr>
                <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="row">
                    <div class="col-5">
                        <img src="{{ asset('storage/'.$data->image) }}" class="img-thumbnail"  alt="" >
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Image</label>
                            <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" aria-required="true" aria-invalid="false" placeholder="Enter Image...">
                            @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                    </div>
                    <div class="col-7">
                        <input type="hidden" name="pizzaId" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                            @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Category</label>
                            <select name="category" id="" class="form-control @error('category') is-invalid @enderror">
                            <option value="">Choose Item</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}" @if($data->category_id == $item->id) selected

                                @endif >{{ $item->category_name }}</option>
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
                            <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ $data->price }}" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                            @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Description</label>

                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description...">{{ $data->description }}</textarea>
                            @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                            <input id="cc-pament" name="waitingTime" type="text" class="form-control @error('waitingTime') is-invalid @enderror" value="{{$data->waiting_time}}" aria-required="true" aria-invalid="false" placeholder="Enter WaitingTime...">
                            @error('waitingTime')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">View Count</label>

                           <input type="text" class="form-control" disabled value="{{ $data->view_count }}">

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




