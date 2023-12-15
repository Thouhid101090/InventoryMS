
@extends('layouts.app')

@section('content')
    <header class="page-header page-header-dark">
        <div class="container-xl px-4">
            <div class="page-header-content my-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h2 class="page-header-title d-flex">
                            <i class="menu-icon mdi mdi-undo-variant me-2"></i>
                           Return Product Check
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

                <form>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="item_search">Reference Number:</label>
                        <input type="text" id="item_search" class="form-control border-primary p-4" placeholder="Enter Reference Number">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_id">Customer:</label>
                                <input type="text" id="customer_id" class="form-control" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product">Product:</label>
                                <input type="text" id="product" class="form-control" readonly>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sales_date">Sales Date:</label>
                                <input type="text" id="sales_date" class="form-control" readonly>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_quantity">Quentity</label>
                                <input type="text" id="total_quantity" class="form-control" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_quantity">Total</label>
                                <input type="text" id="total" class="form-control" readonly>
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
            $(function() {
                $("#item_search").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('autocomplete') }}",
                            data: {
                                term: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        $.ajax({
                            url: "{{ route('get.data') }}",
                            data: {
                                reference_no: ui.item.value
                            },
                            success: function(data) {
                                if (data.error) {
                                    alert(data.error);
                                } else {
                                    console.log(data);

                                    $('#customer_id').val(data.customer_id);
                                    // $('#product').val(data.sales_id);
                                    $('#sales_date').val(data.sales_date);
                                    $('#total_quantity').val(data.total_quantity);
                                    $('#total').val(data.total);

                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
