@extends('Layout.adminHome')
@section('contact')

    <div class="container-fluid">
        @if (session('success'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show col-6 offset-3" role="alert">
                    <div class="text-black">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if (session('delete'))
            <div class="row">
                <div class="alert alert-danger alert-dismissible fade show col-6 offset-3" role="alert">
                    <div class="text-black">{{ session('delete') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if (session('update'))
            <div class="row">
                <div class="alert alert-info alert-dismissible fade show col-6 offset-3" role="alert">
                    <div class="text-black">{{ session('update') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool row">
                <div class="table-data__tool-left col-4">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List</h2>
                        <div class=""><i class="fa-solid fa-database me-1 fs-4 text-black"></i></div>

                    </div>
                </div>
                <div class=" col-4 mb-3">
                    <form action="{{ route('products#list') }}" method="get">
                        @csrf


                        <div class="input-group mb-3">
                            <button class="input-group-text" id="basic-addon1" type="submit"> <i
                                    class="fa-solid fa-magnifying-glass-minus mt-2 ml-6"></i> </button>
                            <input type="text" class="form-control"  name="searchData" value="{{ old('searchData') }}" placeholder="Search"
                               >
                        </div>





                    </form>
                </div>
                <div class="table-data__tool-right col-4">
                    <a href="{{ route('product#add') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add item
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    @if (count($products)!=0)
                    <div class="table-responsive table--no-card m-b-30">

                        <table class="table table-borderless table-striped table-earning">

                           <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>name</th>
                                <th class="text-right">price</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($products as $item )
                        <tbody>
                            <td>{{ $item->id }}</td>
                            <td class="col-3"><img src="{{ asset('storage/'.$item->image) }}" class="img-fluid " alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>
                            <a href="{{ route('product#seeMore',$item->id) }}"> <i class="fas fa-eye me-2 fs-5 text-dark"></i></a>
                             <a href="{{ route('product#delete',$item->id) }}"><i class="fas fa-trash me-2 fs-5 text-dark"></i></a>
                             <a href="{{ route('product#edit',$item->id) }}"><i class="fas fa-edit me-2 fs-5 text-dark"></i></a>

                            </td>
                         </tbody>
                        @endforeach

                        </table>

                    </div>
                    @else
                    <div class="text-danger" style="text-align: center">
                        <p>There is no Data</p>
                    </div>
                       @endif
                </div>

            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <div class="ms-6">
{{ $products->links() }}
    </div>
@endsection
