@extends('website.layouts.master')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                @include('website.partials.profile.profile-side')
                <div class="col-md-9">
                    <div class="card shadow">
                        <update-profile :user_details="{{ json_encode($user_detail ?? '') }}"></update-profile>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
