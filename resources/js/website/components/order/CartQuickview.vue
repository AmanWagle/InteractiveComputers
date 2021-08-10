<template>
  <div class="dropdown cart-dropdown">
    <a
      href="#"
      class="dropdown-toggle"
      role="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      data-display="static"
    >
      <i class="icon-shopping-cart"></i>
      <span class="cart-count">{{
        cart.cart_items ? cart.cart_items.length : 0
      }}</span>
      <span class="cart-txt">Cart</span>
    </a>

    <div v-if="cart.cart_items" class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-cart-products">
        <div class="product" v-for="item in cart.cart_items" :key="item.id">
          <div class="product-cart-details">
            <h4 class="product-title">
              <a href="product.html">{{ item.product.name }}</a>
            </h4>

            <span class="cart-product-info">
              <span class="cart-product-qty">{{ item.quantity }}</span>
              x Rs.
              {{
                item.product.discount
                  ? item.product.selling_price
                  : item.product.original_price
              }}
            </span>
          </div>
          <!-- End .product-cart-details -->

          <figure class="product-image-container">
            <a href="product.html" class="product-image">
              <img :src="item.product.images_url[0]" alt="product" />
            </a>
          </figure>
          <button
            @click="removeFromCart(item.id)"
            class="btn-remove"
            title="Remove Product"
          >
            <i class="icon-close"></i>
          </button>
        </div>
      </div>

      <div class="dropdown-cart-total">
        <span>Total</span>

        <span class="cart-total-price">Rs. {{ cart.total }}</span>
      </div>

      <div class="dropdown-cart-action">
        <a href="/shop/cart" class="btn btn-primary">View Cart</a>
        <a href="checkout.html" class="btn btn-outline-primary-2"
          ><span>Checkout</span><i class="icon-long-arrow-right"></i
        ></a>
      </div>
    </div>

    <div v-else class="dropdown-menu dropdown-menu-right text-center">
      <h5>Cart is empty.</h5>
    </div>
  </div>
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
    let context = this;
    $(document).on("cart-updated", function () {
      context.getActiveCartItems();
    });
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