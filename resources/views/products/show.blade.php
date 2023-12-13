@extends('layouts.app')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark">
    <div class="container-xl px-4">
        <div class="page-header-content my-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h2 class="page-header-title d-flex">
                        <i class="menu-icon mdi mdi-package-variant-closed me-2"></i>
                        <b> Product Details</b>
                    </h2>
                </div>
            </div>

            {{-- @include('partials._breadcrumbs') --}}
        </div>
    </div>
</header>

<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-4">
            <!-- Product image card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Product Image</div>
                <div class="card-body text-center">
                    <!-- Product image -->
                    <img class="img-account-profile mb-2" src="{{ asset('public/uploads/productImage/'.$product->product_image)}}" alt="" id="image-preview" />
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- BEGIN: Product Code -->
            <div class="card mb-4">
                <div class="card-header">
                    Product Code
                </div>
                <div class="card-body">
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (type of product category) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Product code</label>
                            <div class="form-control form-control-solid">{{ $product->product_code  }}</div>
                        </div>
                        <!-- Form Group (type of product unit) -->
                        <div class="col-md-6 align-middle">
                            <label class="small mb-1">Barcode</label>
                            <div class="mt-1">
                              {!! $barcode !!}
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product Code -->

            <!-- BEGIN: Product Information -->
            <div class="card mb-4">
                <div class="card-header">
                    Product Information
                </div>
                <div class="card-body">
                    <!-- Form Group (product name) -->
                    <div class="mb-3">
                        <label class="small mb-1">Product name</label>
                        <div class="form-control form-control-solid">
                            {{$product->product_name }}</div>
                    </div>
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (type of product category) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Product category</label>
                            <div class="form-control form-control-solid">{{ $product->category->name  }}</div>
                        </div>
                        <!-- Form Group (type of product unit) -->

                    </div>
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (buying price) -->

                        <!-- Form Group (selling price) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Selling price</label>
                            <div class="form-control form-control-solid">{{ $product->selling_price  }}</div>
                        </div>
                    </div>
                    <!-- Form Group (stock) -->
                    {{-- <div class="mb-3">
                        <label class="small mb-1">Stock</label>
                        <div class="form-control form-control-solid">{{ $product->stock  }}</div>
                    </div> --}}

                    <!-- Submit button -->
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
            <!-- END: Product Information -->
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush
