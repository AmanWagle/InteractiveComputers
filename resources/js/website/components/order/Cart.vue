<template>
  <main class="main">
    <div
      class="page-header text-center"
      style="background-image: url('assets/images/page-header-bg.jpg')"
    >
      <div class="container">
        <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
      </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Shop</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Shopping Cart
          </li>
        </ol>
      </div>
    </nav>

    <div class="page-content">
      <div class="cart">
        <div class="container">
          <div v-if="cart.cart_items.length" class="row">
            <div class="col-lg-9">
              <table class="table table-cart table-mobile">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="item in cart.cart_items" :key="item.id">
                    <td class="product-col">
                      <div class="product">
                        <figure class="product-media">
                          <a href="#">
                            <img
                              :src="item.product.images_url[0]"
                              alt="Product image"
                            />
                          </a>
                        </figure>

                        <h3 class="product-title">
                          <a href="#">{{ item.product.name }}</a>
                        </h3>
                      </div>
                    </td>

                    <td v-if="item.product.discount" class="price-col">
                      {{ `Rs. ` + item.product.selling_price }}
                    </td>
                    <td v-else class="price-col">
                      {{ `Rs. ` + item.product.original_price }}
                    </td>

                    <td class="quantity-col">
                      <div class="cart-product-quantity">
                        <input
                          type="number"
                          class="form-control"
                          :value="item.quantity"
                          min="1"
                          step="1"
                          data-decimals="0"
                          required
                        />
                      </div>
                    </td>
                    <td class="total-col">{{ `Rs. ` + item.total }}</td>
                    <td class="remove-col">
                      <button
                        @click="removeFromCart(item.id)"
                        class="btn-remove"
                      >
                        <i class="icon-close"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="cart-bottom">
                <button
                  @click="this.getActiveCartItems"
                  class="btn btn-outline-dark-2"
                >
                  <span>UPDATE CART</span><i class="icon-refresh"></i>
                </button>
              </div>
            </div>
            <aside class="col-lg-3">
              <div class="summary summary-cart">
                <h3 class="summary-title">Cart Total</h3>

                <table class="table table-summary">
                  <tbody>
                    <tr class="summary-subtotal">
                      <td>Subtotal:</td>
                      <td>{{ `Rs. ` + cart.total }}</td>
                    </tr>
                    <tr class="summary-total">
                      <td>Total:</td>
                      <td>{{ `Rs. ` + cart.total }}</td>
                    </tr>
                  </tbody>
                </table>

                <a href="/shop/checkout"
                  class="btn btn-outline-primary-2 btn-order btn-block"
                  >PROCEED TO CHECKOUT</a
                >
              </div>

              <a href="/" class="btn btn-outline-dark-2 btn-block mb-3"
                ><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i
              ></a>
            </aside>
          </div>
          <div v-else class="row">
            <div class="col-md-auto m-auto">
              <h3>EMPTY CART</h3>
              <h5>No product in cart.</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
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

    async removeFromCart(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to remove product from cart?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes Remove it!",
        cancelButtonText: "No, Keep it!",
        showCloseButton: true,
      }).then(async (result) => {
        if (result.value) {
          let response = await axios.delete(`/shop/cart-item/${id}`);
          if (response.data.success == true) {
            this.getActiveCartItems();
          }
        }
      });
    },
  },
};
</script>