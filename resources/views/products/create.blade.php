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
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Add Product
                    </h1>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file"  id="image" name="product_image" accept="image/*" onchange="previewImage();">
                        @error('product_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="proName">Product name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('proName') is-invalid @enderror" id="proName" name="proName" type="text" placeholder="" value="{{ old('proName') }}" autocomplete="off"/>
                            @error('proName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="categoryId">Product category <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('categoryId') is-invalid @enderror" id="categoryId" name="categoryId">
                                    <option selected="" disabled="">Select a category:</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('categoryId') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryId')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product unit) -->

                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (buying price) -->

                            <!-- Form Group (selling price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="sellingPrice">Selling price <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('sellingPrice') is-invalid @enderror" id="selling_price"
                                 name="sellingPrice" type="text" placeholder="" value="{{ old('sellingPrice') }}" autocomplete="off" />
                                @error('sellingPrice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (Product Code) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="productCode">Product Code <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('productCode') is-invalid @enderror" id="productCode"
                            name="productCode" type="text" placeholder="" value="{{ old('productCode') }}" autocomplete="off" />
                            @error('productCode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="brand">Product Brand <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('brand') is-invalid @enderror" id="brand"
                            name="brand" type="text" placeholder="" value="{{ old('brand') }}" autocomplete="off" />
                            @error('brand')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush





