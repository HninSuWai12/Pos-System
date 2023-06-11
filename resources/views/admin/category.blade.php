@extends('Layout.adminHome')
@section('contact')

    <div class="container-fluid">
        @if (session('category'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show col-6 offset-3" role="alert">
                    <div class="text-black">{{ session('category') }}</div>
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
                        <h2 class="title-1">Category List</h2>
                        <div class=""><i class="fa-solid fa-database me-1 fs-4 text-black"></i>{{ $categories->total() }}</div>

                    </div>
                </div>
                <div class=" col-4 mb-3">
                    <form action="{{ route('admin#list') }}" method="get">
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
                    <a href="{{ route('admin#addCategory') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add item
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2 ml-6">
                @if (count($categories) != 0)
                    <table class="table table-data2 " style="margin-left: 200px ; width:900px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>

                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="tr-shadow">

                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <span class="block-email">{{ $item->category_name }}</span>
                                    </td>

                                    <td>{{ $item->created_at }}</td>

                                    <td>
                                        <div class="table-data-feature">

                                            <a href="{{ route('admin#delete', $item->id) }}">
                                                <button class="item btn btn-info " data-toggle="tooltip"
                                                    data-placement="top" title="Delete">
                                                    <i class=" fas fa-trash"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#edit', $item->id) }}">
                                                <button class="item btn btn-danger " style="margin-left: 30px"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit "></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                            @endforeach
                            </tr>

                        </tbody>
                    @else
                        <div class="text-secondary" style="text-align: center">
                            <p>There is no Data</p>
                        </div>
                @endif
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <div class="ms-6">
        {{ $categories->links() }}
    </div>
@endsection
