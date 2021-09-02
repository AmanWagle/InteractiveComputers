<template>
  <main class="main">
    <div
      class="page-header text-center"
      style="background-image: url('assets/images/page-header-bg.jpg')"
    >
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
        <div class="container">
          <div class="row">
            <div class="col-lg-9">
              <div>
                <h2 class="checkout-title">Billing Details</h2>
                <!-- End .checkout-title -->

                <label>Full Name *</label>
                <input
                  v-model="shipping_details.full_name"
                  type="text"
                  class="form-control"
                  name="full_name"
                  placeholder="Full Name"
                  v-validate="'required'"
                />
                <span
                  class="text-danger text-sm"
                  v-if="errors.has('full_name')"
                  >{{ errors.first("full_name") }}</span
                >

                <div class="row">
                  <div class="col-sm-6">
                    <label>Phone Number *</label>
                    <input
                      v-model="shipping_details.phone_number"
                      type="number"
                      class="form-control"
                      name="phone_number"
                      placeholder="Phone Number"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('phone_number')"
                      >{{ errors.first("phone_number") }}</span
                    >
                  </div>

                  <div class="col-sm-6">
                    <label>Secondary Phone Number</label>
                    <input
                      v-model="shipping_details.secondary_phone_number"
                      type="number"
                      class="form-control"
                      placeholder="Secondary Phone Number"
                    />
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label>Province *</label>
                    <input
                      v-model="shipping_details.province"
                      type="text"
                      name="province"
                      class="form-control"
                      placeholder="Province"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('province')"
                      >{{ errors.first("province") }}</span
                    >
                  </div>

                  <div class="col-sm-6">
                    <label>District *</label>
                    <input
                      v-model="shipping_details.district"
                      type="text"
                      name="district"
                      class="form-control"
                      placeholder="District"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('district')"
                      >{{ errors.first("district") }}</span
                    >
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label>City *</label>
                    <input
                      v-model="shipping_details.city"
                      type="text"
                      class="form-control"
                      name="city"
                      placeholder="City"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('city')"
                      >{{ errors.first("city") }}</span
                    >
                  </div>
                  <!-- End .col-sm-6 -->

                  <div class="col-sm-6">
                    <label>Landmark *</label>
                    <input
                      v-model="shipping_details.landmark"
                      type="text"
                      name="landmark"
                      class="form-control"
                      v-validate="'required'"
                      placeholder="Landmark"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('landmark')"
                      >{{ errors.first("landmark") }}</span
                    >
                  </div>
                  <!-- End .col-sm-6 -->
                </div>
                <!-- End .row -->

                <label>Order Notes</label>
                <textarea
                  v-model="shipping_details.order_note"
                  class="form-control"
                  rows="2"
                  placeholder="Notes about your order, e.g. special notes for delivery"
                ></textarea>
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
                  <tr v-for="item in cart.cart_items" :key="item.id">
                    <td class="product-col">
                      <div class="product">
                        <figure class="product-media">
                          <a :href="`/product/` + item.product.slug">
                            <img
                              :src="item.product.images_url[0]"
                              alt="Product image"
                            />
                          </a>
                        </figure>

                        <h3 class="product-title">
                          <a :href="`/product/` + item.product.slug">{{
                            item.product.name
                          }}</a>
                        </h3>
                      </div>
                    </td>
                    <td v-if="item.product.discount" class="price-col">
                      {{ `Rs. ` + item.product.selling_price }}
                    </td>
                    <td v-else class="price-col">
                      {{ `Rs. ` + item.product.original_price }}
                    </td>
                    <td class="quantity-col">{{ item.quantity }}</td>
                    <td class="total-col">{{ `Rs. ` + item.total }}</td>
                  </tr>
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
                    <tr v-for="item in cart.cart_items" :key="item.id">
                      <td>
                        <a href="#">{{ item.product.name }}</a>
                      </td>
                      <td>{{ `Rs. ` + item.total }}</td>
                    </tr>

                    <tr class="summary-subtotal">
                      <td>Subtotal:</td>
                      <td>{{ `Rs. ` + cart.total }}</td>
                    </tr>
                    <tr>
                      <td>Shipping:</td>
                      <td>Free shipping</td>
                    </tr>
                    <tr class="summary-total">
                      <td>Total:</td>
                      <td>{{ `Rs. ` + cart.total }}</td>
                    </tr>
                  </tbody>
                </table>

                <div class="accordion-summary mt-2" id="accordion-payment">
                  <div class="form-check">
                    <input
                      v-model="shipping_details.payment_method"
                      class="form-check-input"
                      type="radio"
                      name="payment_method"
                      value="cash_on_delivery"
                      id="cash_on_delivery"
                    />
                    <label class="form-check-label" for="cash_on_delivery">
                      <img
                        class="d-flex m-auto"
                        width="50%"
                        src="/storage/images/static/cod.png"
                        alt="Cash On Delivery"
                      />
                    </label>
                  </div>
                  <br />
                  <div class="form-check">
                    <input
                      v-model="shipping_details.payment_method"
                      class="form-check-input"
                      type="radio"
                      name="payment_method"
                      value="esewa"
                      id="esewa"
                      disabled
                    />
                    <label class="form-check-label" for="esewa">
                      <img
                        class="d-flex m-auto"
                        width="50%"
                        src="/storage/images/static/eSewa.png"
                        alt="eSewa"
                      />
                    </label>
                  </div>
                </div>

                <button
                  type="submit"
                  class="btn btn-outline-primary-2 btn-order btn-block"
                  @click="placeOrder"
                >
                  <span class="btn-text">Place Order</span>
                  <span class="btn-hover-text">Proceed to Checkout</span>
                </button>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { renderServerErrors } from "../../utils";
export default {
  data() {
    return {
      shipping_details: {
        full_name: "",
        phone_number: "",
        secondary_phone_number: "",
        province: "",
        district: "",
        city: "",
        landmark: "",
        order_note: "",
        payment_method: "cash_on_delivery",
      },
      cart: {},
    };
  },

  mounted() {
    this.getActiveCartItems();
  },

  methods: {
    async getActiveCartItems() {
      try {
        let response = await axios.get(`/shop/cart-items`);
        this.cart = response.data;
      } catch (e) {}
    },

    async placeOrder() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.shipping_details;
        let url = `/checkout`;
        let response = await axios.post(url, payload);
        if (response.data.success) {
          this.$swal({
            icon: "success",
            title: "Success",
            text: "Order Placed Successfully. We will get back to you soon.",
          }).then(async (result) => {
            location.href = `/`;
          });
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },
  },
};
</script>