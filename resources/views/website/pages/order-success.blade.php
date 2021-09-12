@extends('website.layouts.master')

@section('content')

    <main class="main">
        <div class="page-content">
            <div class="container">
                <div class="d-flex flex-column justify-content-center align-items-center mt-5">
                    <img width="25%" src="/images/success.png" alt="not found image">
                    <h3>Success</h3>
                    <p style="font-size: 20px;">Order placed successfully. <span>#ICW.{{ $order_id }}</span></p>
                    <a href="/profile/orders/{{ $order_id }}" class="btn btn-primary mt-2">View Order Detail</a>
                </div>
            </div>
        </div>
    </main>

@endsection
