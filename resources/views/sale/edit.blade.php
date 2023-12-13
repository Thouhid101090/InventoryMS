@extends('layouts.app')

@push('page-styles')
 {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto ">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-cart-outline me-2"></i>
                        <b>Update Sale</b>
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <form action="" method="POST" >
        @csrf
        @method('PATCH')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="purchaseDate">Purchase Date<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('purchaseDate') is-invalid @enderror" id="purchaseDate"
                            name="proName" type="datetime" placeholder="" value="{{ old('purchaseDate') }}" />
                            @error('purchaseDate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="supplierId">Supplier<span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('categoryId') is-invalid @enderror" id="categoryId" name="categoryId">
                                    <option selected="" disabled="">Select a supplier:</option>
                                    @foreach ($purchase as $p)
                                    <option value="{{ $p->id }}" @if(old('supplierId') == $p->id) selected="selected" @endif>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplierId')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                        </div>

                        {{-- <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="productId">Product<span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('productId') is-invalid @enderror"
                                 id="productId" name="productId">
                                    <option selected="" disabled="">Select a Product:</option>
                                    @foreach ($product as $p)
                                    <option value="{{ $p->id }}" @if(old('productId') == $p->id)
                                        selected="selected" @endif>{{ $p->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('productId')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                        </div> --}}
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">


                            <!-- Form Group (Purchase No ) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="purchaseNo">Purchase No<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('sellingPrice') is-invalid @enderror" id="purchaseNo"
                                 name="purchaseNo" type="text" placeholder="" value="{{ old('purchaseNo') }}" autocomplete="off" />
                                @error('purchaseNo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group ( Status) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="">
                                <option value="1" @if(old('status')==1) selected @endif>Completed</option>
                                <option value="0" @if(old('status')==0) selected @endif>Panding</option>
                            </select>

                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="subAmount">Sub Amount<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('subAmount') is-invalid @enderror" id="brand"
                            name="subAmount" type="number" placeholder="" value="{{ old('subAmount') }}" autocomplete="off" />
                            @error('subAmount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="discount">Discount<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('discount') is-invalid @enderror" id="brand"
                            name="discount" type="text" placeholder="" value="{{ old('discount') }}" autocomplete="off" />
                            @error('discount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="total">Total<span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid"  id="brand"
                            name="total" type="text" placeholder="" value="{{ old('total') }}" autocomplete="off" />

                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('purchase.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
    <!-- Your HTML code -->

<script>
    // Get references to the input elements
    var subAmountInput = document.getElementById('subAmount');
    var discountInput = document.getElementById('discount');
    var totalInput = document.getElementById('total');

    // Add event listeners to subAmount and discount inputs
    subAmountInput.addEventListener('input', updateTotal);
    discountInput.addEventListener('input', updateTotal);

    // Function to update the total based on subAmount and discount
    function updateTotal() {
        // Parse the values as floats (assuming they are numeric)
        var subAmount = parseFloat(subAmountInput.value) || 0;
        var discount = parseFloat(discountInput.value) || 0;

        // Calculate the total
        var total = subAmount - discount;

        // Update the total input value
        totalInput.value = total.toFixed(2); // Adjust decimal places as needed
    }
</script>

@endpush
