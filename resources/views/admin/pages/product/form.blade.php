@extends('admin.layouts.master')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product Form</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.product.index') }}">Product</a></li>
                        <li class="breadcrumb-item active">Product Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <product-form :product_details="{{ json_encode($product ?? '') }}"></product-form>
@endsection
