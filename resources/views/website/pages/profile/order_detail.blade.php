@extends('website.layouts.master')

@section('content')
    <main class="main">
        <!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.profile.all-orders') }}">Order History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow" style="padding: 10px">
                                        <div class="card-body">
                                            <h5 class="card-title">Order Details</h5>
                                            <hr />
                                            <p><b>Payment Method: </b>{{ $order->payment_method }}</p>
                                            <p><b>Order Date: </b>{{ $order->created_at_format }}</p>
                                            <p><b>Total: </b> Rs. {{ $order->total }}</p>
                                            <p>
                                                <b>Status: </b>
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
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow" style="padding: 10px">
                                        <div class="card-body">
                                            <h5 class="card-title">Shipping Details</h5>
                                            <hr />
                                            <p><b>Name: </b>{{ $order->full_name }}</p>
                                            <p>
                                                <b>Phone Number:
                                                </b>{{ $order->phone_number }}<span>,&nbsp;{{ $order->secondary_phone_number }}</span>
                                            </p>
                                            <p><b>Province: </b>{{ $order->province }}</p>
                                            <p><b>District: </b>{{ $order->district }}</p>
                                            <p>
                                                <b>Address: </b>{{ $order->landmark . ', ' . $order->city }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-cart table-mobile mt-4">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($order->order_items as $item)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="#">
                                                                <img src="{{ $item->product->images_url[0] }}" />
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a
                                                                href="{{ route('product.detail', ['product' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                                        </h3>
                                                    </div>
                                                </td>
                                                <td class="price-col">
                                                    Rs.
                                                    {{ $item->product->discount ? $item->product->selling_price : $item->product->original_price }}
                                                </td>
                                                <td class="quantity-col">{{ $item->quantity }}</td>
                                                <td class="total-col">
                                                    Rs.
                                                    {{ $item->product->discount ? $item->product->selling_price * $item->quantity : $item->product->original_price * $item->quantity }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-success">
                                            <td colspan="3"><b style="margin-left: 10px">Total</b></td>
                                            <td>
                                                <b>Rs. {{ $order->total }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
