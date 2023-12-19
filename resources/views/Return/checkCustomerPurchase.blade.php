@extends('layouts.app')

@section('content')
<header class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-undo-variant me-2"></i>
                        Return Product Check From Customer
                    </h2>
                </div>

            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>

    {{-- @include('partials.session') --}}
</header>
<div class="container  mt-n10">
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">

                    <form action="" method="post">
                        @csrf
                        <div class="form-group col-md-6 offset-md-3">
                            <label for="item_search">Reference Number:</label>
                            <input type="text" id="item_search" class="form-control border-primary p-4"
                                placeholder="Enter Reference Number">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_id">Customer:</label>
                                    <input type="text" id="customer_id" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product">Product:</label>
                                    <select id="product" class="form-control" onchange="check_data(this)">
                                        <option value="">Select Product</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sales_date">Sales Date:</label>
                                    <input type="text" id="sales_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_quantity">Quentity</label>
                                    <input type="text" id="total_quantity" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_quantity">Unit Price</label>
                                    <input type="text" id="unit_price" readonly class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_quantity">Total Price</label>
                                    <input type="text" id="total" class="form-control">
                                </div>

                            </div>
                        </div>




                        <button type="button" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {


            $('#total_quantity').on('input', function () {
                var selectedProductQty = $('#product').find('option:selected').data('qty');
                var returnedQty = parseInt($(this).val()) || 0;

                if (returnedQty > selectedProductQty) {
                    alert('Cannot return more quantity than purchased.');
                    $(this).val(selectedProductQty);
                }

                updateTotal();
            });

            function updateTotal() {
                var unitPrice = parseFloat($('#unit_price').val()) || 0;
                var returnedQty = parseInt($('#total_quantity').val()) || 0;

                var total = unitPrice * returnedQty;
                $('#total').val(total.toFixed(2));
            }
        });



    $(function() {
    $("#item_search").autocomplete({

        source: function(request, response) {
            $.ajax({
                url: "{{ route('autocomplete.customer') }}",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            $.ajax({
                url: "{{ route('get.data.customer') }}",
                data: {
                    reference_no: ui.item.value
                },
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Populate data from the sale
                        $('#customer_id').val(data.customer_id);
                        $('#sales_date').val(data.sales_date);
                        let product=`<option value="" key="">Select Product</option>`;
                        for (var pro of data.products){
                            product+=`<option data-price="${pro.unit_price}" data-qty="${pro.quantity}" value="${pro.quantity}" key="">${pro.product_name}</option>`;
                        }
                        $('#product').html(product);
                        console.log(data);

                    }
                }
            });
        }
    });
});
function check_data(e){
    unit_price=$(e).find('option:selected').data('price')
    $('#unit_price').val(unit_price);
    qty=$(e).find('option:selected').data('qty')

}

</script>
@endpush
@endsection
