@extends('Layout.adminHome')
@section('contact')
<div class="container-fluid">
    <div class="row">
<div class="col-3">




</div>
<div class="col-lg-8">
    <div class="card">
        <div class="card-body ">
            <div class="card-title">
                <a href="{{ route('products#list') }}" class=""><i class="fa-solid fa-arrow-left text-black"></i></a>
                <h3 class="text-center title-2">Pizza Info</h3>
            </div>
            <hr>
            <div class="row ">
                <div class="col-4  ">


            <img src="{{ asset('storage/'.$data->image) }}" class="img-thumbnail  w-30 h-35" alt="">


                </div>
                <div class="col-6 ">
                   <button class="btn btn-danger col-8 "><h4 class="mt-3 text-center"><i class="fa-solid fa-id-card-clip me-2"></i>{{ $data->name }}</h4></button>
                   <div class="d-flex ">
                    <h4 class="mt-3 me-3  text-white bg-dark  p-2"><i class="fa-solid fa-money-check-dollar"></i>{{ $data->price }}kyats</h4>
                   <h4 class="mt-3 me-3  text-white bg-dark p-2"><i class="fa-solid fa-database"></i>{{ $data->category_name}}</h4>
                   <h4 class="mt-3 me-3  text-white bg-dark p-2"><i class="fa-sharp fa-regular fa-eye"></i>{{ $data->view_count }}</h4>
                   <h4 class="mt-3 me-3  text-white bg-dark p-2"><i class="fa-regular fa-clock"></i>{{ $data->waiting_time }}min</h4>
                   </div>
                   <i class="fa-solid fa-audio-description p-2 bg-black text-white mt-4"></i>Detail <br>
                   <span class="mt-3">{{$data->description }}</span>

                </div>
            </div>
        </div>
    </div>
</div>
    </div>

</div>
@endsection
