@extends('website.layouts.master')

@section('content')
    @include('website.partials.home.home-banner')

    <div class="mb-4"></div>

    @include('website.partials.home.home-offer-banner-first')

    <div class="mb-3"></div>

    @include('website.partials.home.home-products')

    <div class="mb-3"></div>

    @include('website.partials.home.home-offer-banner-second')

    <div class="mb-1"></div>

    @include('website.partials.home.home-brands')

    <div class="mb-3"></div>

    @include('website.partials.home.home-featured-categories')

    <div class="mb-3"></div>

    @include('website.partials.home.home-latest-products')
@endsection
