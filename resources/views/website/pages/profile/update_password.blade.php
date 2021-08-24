@extends('website.layouts.master')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li class="breadcrumb-item active">Security</li>
                </ol>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                @include('website.partials.profile.profile-side')
                <div class="col-md-9">
                    <div class="card shadow">
                        <update-password></update-password>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
