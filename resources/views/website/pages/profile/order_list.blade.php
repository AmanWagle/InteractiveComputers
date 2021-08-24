@extends('website.layouts.master')

@section('content')
    <main class="main">
        <!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order History</li>
                </ol>
            </div>
            <!-- End .container -->
        </nav>
        <!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="row">
                        @include('website.partials.profile.profile-side')
                        <div class="col-md-9">
                            <div class="card shadow" style="padding: 10px">
                                <div class="card-body">
                                    <h5 class="card-title m-3">Order History</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>ORDER ID</th>
                                                    <th>NUM OF ITEMS</th>
                                                    <th>TOTAL</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>
                                                            <b>{{ $loop->index + 1 }}</b>
                                                        </td>
                                                        <td>
                                                            <b>{{ $order->id }}</b>
                                                        </td>
                                                        <td>{{ count($order->order_items) }}</td>
                                                        <td>{{ 'Rs. ' . $order->total }}</td>
                                                        <td>
                                                            @switch($order->status)
                                                                @case('pending')
                                                                    <span
                                                                        class="badge rounded-pill bg-warning text-white">{{ $order->status }}</span>
                                                                @break

                                                                @case('confirmed')
                                                                    <span
                                                                        class="badge rounded-pill bg-info text-white">{{ $order->status }}</span>
                                                                @break

                                                                @case('cancel')
                                                                    <span
                                                                        class="badge rounded-pill bg-danger text-white">{{ $order->status }}</span>
                                                                @break

                                                                @case('completed')
                                                                    <span
                                                                        class="badge rounded-pill bg-primary text-white">{{ $order->status }}</span>
                                                                @break

                                                                @default
                                                                    <span
                                                                        class="badge rounded-pill bg-primary text-white">{{ $order->status }}</span>

                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <a href="/profile/orders/{{ $order->id }}"><b><i
                                                                        class="icon-search"></i></b></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
