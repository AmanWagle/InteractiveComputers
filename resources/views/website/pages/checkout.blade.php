@extends('website.layouts.master')

@inject('cart_helper', 'App\Helpers\CartHelper')

@php
$active_cart = $cart_helper->getActiveCart();

$total = 0;
foreach ($active_cart->cart_items as $cart_item) {
    if ($cart_item->product->discount) {
        $item_total = $cart_item->quantity * $cart_item->product->selling_price;
    } else {
        $item_total = $cart_item->quantity * $cart_item->product->original_price;
    }
    $total = $total + $item_total;
}
@endphp

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
            <!-- End .container -->
        </nav>
        <!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <form action="{{ route('checkout.place-order') }}" method="POST" id="form_process_order">

                    <div class="container">
                        <div class="row">
                            @csrf
                            <div class="col-lg-9">
                                <div>
                                    <h2 class="checkout-title">Billing Details</h2>
                                    <!-- End .checkout-title -->

                                    <label>Full Name *</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                                        required />

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Phone Number *</label>
                                            <input type="number" class="form-control" name="phone_number"
                                                placeholder="Phone Number" required />
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Secondary Phone Number</label>
                                            <input type="number" name="secondary_phone_number" required
                                                class="form-control" placeholder="Secondary Phone Number" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Province *</label>
                                            <input type="text" name="province" class="form-control" placeholder="Province"
                                                required />
                                        </div>

                                        <div class="col-sm-6">
                                            <label>District *</label>
                                            <input type="text" name="district" class="form-control" placeholder="District"
                                                required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>City *</label>
                                            <input type="text" class="form-control" name="city" placeholder="City"
                                                required />
                                        </div>
                                        <!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Landmark *</label>
                                            <input type="text" name="landmark" class="form-control" required
                                                placeholder="Landmark" />
                                        </div>
                                        <!-- End .col-sm-6 -->
                                    </div>
                                    <!-- End .row -->

                                    <label>Order Notes</label>
                                    <textarea class="form-control" rows="2"
                                        placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div>


                                <!-- Cart item detail list -->
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
                                        @foreach ($active_cart->cart_items as $item)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="/product/{{ $item->product->slug }}">
                                                                <img src="{{ $item->product->images_url[0] }}"
                                                                    alt="Product image" />
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a
                                                                href="/product/{{ $item->product->slug }}">{{ $item->product->name }}</a>
                                                        </h3>
                                                    </div>
                                                </td>
                                                <td class="quantity-col">
                                                    Rs.
                                                    {{ $item->product->discount ? $item->product->selling_price : $item->product->original_price }}
                                                </td>

                                                <td class="quantity-col">{{ $item->quantity }}</td>
                                                <td class="total-col">Rs. {{ $total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Order Side Bar -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3>

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($active_cart->cart_items as $item)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="/product/{{ $item->product->slug }}">{{ $item->product->name }}</a>
                                                    </td>
                                                    <td>Rs. {{ $total }}</td>
                                                </tr>
                                            @endforeach

                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>Rs. {{ $active_cart->total }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping:</td>
                                                <td>Free shipping</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>Rs. {{ $total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="accordion-summary mt-2" id="accordion-payment">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                value="cash_on_delivery" id="cash_on_delivery" checked />
                                            <label class="form-check-label" for="cash_on_delivery">
                                                <img class="d-flex m-auto" width="50%" src="/images/cod.png"
                                                    alt="Cash On Delivery" />
                                            </label>
                                        </div>
                                        <br />
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" value="esewa"
                                                id="esewa" />
                                            <label class="form-check-label" for="esewa">
                                                <img class="d-flex m-auto" width="50%" src="/images/eSewa.png"
                                                    alt="eSewa" />
                                            </label>
                                        </div>
                                    </div>

                                    <a id="btn-place-order" href="javascript:void(0)"
                                        class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </a>
                                </div>
                            </aside>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@push('script')
    <script>
        $('#btn-place-order').click(async function(e) {
            let payment_method = $('[name=payment_method]:checked').val();

            let form = $('#form_process_order')
            let formData = form.serialize();

            //for cash on delivery
            if (payment_method === 'cash_on_delivery') {

                console.log(formData);

                form.submit();
            }
            //for esewa 
            else if (payment_method === 'esewa') {
                let response = await axios.post('/checkout/process-order', formData)
                if (response.data.success === true) {

                    var order = response.data.data;

                    var path = "https://uat.esewa.com.np/epay/main";
                    var params = {
                        amt: order.total,
                        psc: 0,
                        pdc: 0,
                        txAmt: 0,
                        tAmt: order.total,
                        pid: "ICW." + order.id,
                        scd: "EPAYTEST",
                        su: "http://localhost:8000/checkout/payment-verify?q=su",
                        fu: "http://localhost:8000/checkout/payment-verify?q=fu"
                    }

                    post(path, params);

                    function post(path, params) {
                        var form_esewa = document.createElement("form");
                        form_esewa.setAttribute("method", "POST");
                        form_esewa.setAttribute("action", path);

                        for (var key in params) {
                            var hiddenField = document.createElement("input");
                            hiddenField.setAttribute("type", "hidden");
                            hiddenField.setAttribute("name", key);
                            hiddenField.setAttribute("value", params[key]);
                            form_esewa.appendChild(hiddenField);
                        }

                        document.body.appendChild(form_esewa);
                        form_esewa.submit();
                    }

                }
            }
        })
    </script>
@endpush
