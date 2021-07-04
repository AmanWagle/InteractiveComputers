@extends('admin.layouts.master')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Banners</h3>
                <p>Banners in <code>Interactive Computers</code> website.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.banner.index') }}">Banner</i></a></li>
                        <li class="breadcrumb-item active">Banner Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <banner-details :banner_id="{{ json_encode($id ?? '') }}"></banner-details>
@endsection