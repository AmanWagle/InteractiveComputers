@extends('admin.layouts.master')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product Categories</h3>
                <p>Categories avalible in <code>Interactive Computers</code>.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <admin-product-categories></admin-product-categories>
@endsection
