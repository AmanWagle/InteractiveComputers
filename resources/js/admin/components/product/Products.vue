<template>
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Products</h4>
            <a
              href="/admin/product/create"
              class="btn btn-primary btn-icon-split float-end"
            >
              <i class="fas fa-plus"></i>
              Add
            </a>
          </div>
          <div class="card-body">
            <!-- table striped -->
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>TAGS</th>
                    <th>FEATURED</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(product, index) in products" :key="product.id">
                    <td width="5%">
                      <b>{{ index + 1 }}</b>
                    </td>
                    <td>
                      <img
                        v-if="product.product_images"
                        height="90px"
                        :src="`/storage/images/uploads/${product.product_images_array[0]}`"
                      />
                      <img
                        v-else
                        height="90px"
                        src="/storage/images/static/empty-product-image.jpg"
                      />
                    </td>
                    <td>
                      <b>{{ product.name }}</b>
                    </td>
                    <td>
                      <span
                        v-if="product.status"
                        class="badge rounded-pill bg-success"
                        >Active</span
                      >
                      <span
                        v-if="product.is_featured"
                        class="badge rounded-pill bg-secondary"
                        >Featured</span
                      >
                    </td>
                    <td>
                      <div class="form-check-glow form-switch">
                        <input
                          class="form-check-input form-check-primary"
                          type="checkbox"
                          name="is_featured"
                          id="brand-is-featured"
                          v-model="product.is_featured"
                        />
                      </div>
                    </td>
                    <td>
                      <button
                        @click="editProduct(product.id)"
                        class="btn btn-secondary btn-circle rounded-circle"
                      >
                        <i class="fas fa-edit"></i>
                      </button>
                      <button
                        @click="deleteProduct(product)"
                        class="btn btn-danger btn-circle rounded-circle"
                      >
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      products: [],
    };
  },

  mounted() {
    this.getAllProducts();
  },

  methods: {
    async getAllProducts() {
      let response = await axios.get(`/admin/product/get-all`);
      this.products = response.data.data;
    },

    editProduct(product_id) {
      location.href = `/admin/product/${product_id}/edit`;
    },

    deleteProduct(product) {
      this.$swal({
        title: "Are you sure?",
        text: "You can't revert  your action",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes Delete it!",
        cancelButtonText: "No, Keep it!",
        showCloseButton: true,
      }).then((result) => {
        if (result.value) {
          axios.delete(`/admin/product/${product.id}`).then((response) => {
            if (response.data.success == true) {
              this.$swal(
                "Deleted",
                "You successfully deleted this file",
                "success"
              );
            }
            this.getAllProducts();
          });
        }
      });
    },
  },
};
</script>
