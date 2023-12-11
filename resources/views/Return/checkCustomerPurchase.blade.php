<!-- Add this to your Blade view -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
               <!-- Add this to your Blade view -->
<form>
    <div class="form-group">
        <label for="item_search">Reference Number:</label>
        <input type="text" id="item_search" class="form-control" placeholder="Enter Reference Number">
    </div>
    <div class="form-group">
        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="sales_date">Sales Date:</label>
        <input type="text" id="sales_date" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="total_quantity">Quentity</label>
        <input type="text" id="total_quantity" class="form-control" readonly>
    </div>

    <button type="button" class="btn btn-primary">Submit</button>
</form>

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
                        // Use the data to populate your form or perform any other actions
                        console.log(data);

                        // Example: Populate form fields based on retrieved data
                        $('#customer_id').val(data.customer_id);
                        $('#sales_date').val(data.sales_date);
                        $('#total_quantity').val(data.total_quantity);
                       
                    }
                }
            });
        }                });
            });
        </script>
    @endpush
@endsection
