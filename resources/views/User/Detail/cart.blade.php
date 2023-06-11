@extends('UserLayouts.master')
@section('contact')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="tableTotal">
                    <thead class="thead-dark">
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>

                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove </th>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $item)
                            <tr>
                                <td ><img src="{{ asset('storage/'.$item->product_image) }}" alt="" class=" img-thumbnail"
                                     style="100px"></td>
                                <td class="align-middle"> {{ $item->product_name }}</td>
                                <td class="align-middle" id="price">{{ $item->product_price }}Kyats</td>

                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" id="btnminus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $item->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-2" id="total">{{ $item->product_price * $item->qty }}Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 >Sub Total</h6>
                            <h6 id="subTotal">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalShipping">{{ $totalPrice + 3000 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $nodeParent = $(this).parents("tr");
                $price = Number($nodeParent.find('#price').html().replace("Kyats", ""));
                $qty = $nodeParent.find('#qty').val();
                $total = $price * $qty;

                $nodeParent.find('#total').html($total + "Kyats");
                $totalPrice=0
                $('#tableTotal tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats" , ""));

                })
                $('#subTotal').html(`${$totalPrice}Kyats`);
                $('#totalShipping').html($totalPrice+3000 + "Kyats");

            })
            $('.btn-minus').click(function() {
                $nodeParent = $(this).parents("tr");
                $price = Number($nodeParent.find('#price').html().replace("Kyats", ""));
                $qty = $nodeParent.find('#qty').val();
                $total = $price * $qty;
                $nodeParent.find('#total').html($total + "Kyats");
                $totalPrice=0
                $('#tableTotal tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats" , ""));


                })
                $('#subTotal').html($totalPrice + "Kyats");
                $('#totalShipping').html($totalPrice+3000 + "Kyats");



            })
            $('.btnRemove').click(function() {
                $nodeParent = $(this).parents("tr");
                $nodeParent.remove();
            })
        })
    </script>
@endsection
