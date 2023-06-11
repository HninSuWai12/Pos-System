@extends('UserLayouts.master')
@section('contact')
    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->

            <!--Shop Slider Start-->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="" for="price-all">All Category</label>
                            <span class="">{{ count($category) }}</span>
                        </div>
                        <a href="{{ route('user#user') }}" class="d-block text-decoration-none ms-4 text-dark">All</a>
                        @foreach ($category as $item)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                {{-- <input type="checkbox" class="custom-control-input" id="price-1"> --}}
                                <a href="{{ route('user#fliter', $item->id) }}" class="text-decoration-none text-dark">
                                    <label class="" for="price-1"
                                        class="">{{ $item->category_name }}</label></a>
                                {{--                 <span class="badge border font-weight-normal">150</span> --}}
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="{{ route('user#cart') }}">
                                <button type="button" class="btn btn-info position-relative">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">


                                      {{ count($cart) }}

                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                            <div class="ml-2">
                                {{--
                        <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle " data-toggle="dropdown">Sorting</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Ascending</a>
                            <a class="dropdown-item" href="#">Descending</a>

                        </div>
                    </div>
                        --}}
                                <div class="btn-group me-5">
                                    <select name="sortion" id="sortOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Desecnding</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="row" id="classList">
                        @foreach ($data as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:230px"
                                            src="{{ asset('storage/' . $item->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('user#detail', $item->id) }}"><i
                                                    class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="text-decoration-none text-truncate" href="">
                                            <h4>{{ $item->name }}</h4>
                                        </a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>20000 kyats</h5>
                                        </div>
                                        {{--
                        <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                    </div>
                                --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </span>


                </div>
            </div>
            <!-- Shop Product End -->



        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {


            $('#sortOption').change(function() {
                $eventOption = $('#sortOption').val();
                //console.log($eventOption);
                if ($eventOption == 'asc') {
                    //console.log('This is ascending');
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/pizzaList',


                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                    <div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
            <div class='product-item bg-light mb-4'>
                <div class='product-img position-relative overflow-hidden'>
                    <img class='img-fluid w-100' style='height:230px' src='{{ asset('storage/${response[$i].image }' ) }}' alt=''>
                    <div class='product-action'>
                        <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-shopping-cart'></i></a>
                        <a class='btn btn-outline-dark btn-square' href=''><i class='fa-solid fa-circle-info'></i></a>

                    </div>
                </div>
                <div class='text-center py-4'>
                    <a class='text-decoration-none text-truncate' href=''><h4>${response[$i].name }</h4></a>
                    <div class='d-flex align-items-center justify-content-center mt-2'>
                        <h5>${response[$i].price }</h5>
                    </div>

                </div>
            </div>
        </div>



                            `;
                            }
                            $('#classList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/pizzaList',

                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {

                             $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                    <div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
            <div class='product-item bg-light mb-4'>
                <div class='product-img position-relative overflow-hidden'>
                    <img class='img-fluid w-100' style='height:230px' src='{{ asset('storage/${response[$i].image }' ) }}' alt=''>
                    <div class='product-action'>
                        <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-shopping-cart'></i></a>
                        <a class='btn btn-outline-dark btn-square' href='{{ route('user#detail', $item->id) }}'><i class='fa-solid fa-circle-info'></i></a>

                    </div>
                </div>
                <div class='text-center py-4'>
                    <a class='text-decoration-none text-truncate' href=''><h4>${response[$i].name }</h4></a>
                    <div class='d-flex align-items-center justify-content-center mt-2'>
                        <h5>${response[$i].price }</h5>
                    </div>

                </div>
            </div>
        </div>



                            `;
                            }
                            $('#classList').html($list);

                        }
                    })
                }
            })
        });
    </script>
@endsection
