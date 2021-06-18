<template>
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Brands</h4>
            <a
              href="/admin/brand/create"
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
                    <th>LOGO</th>
                    <th>NAME</th>
                    <th>TAGS</th>
                    <th>FEATURED</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(brand, index) in brands" :key="brand.id">
                    <td width="5%">
                      <b>{{ index + 1 }}</b>
                    </td>
                    <td width="20%">
                      <img
                        height="70px"
                        :src="`/storage/images/uploads/${brand.logo}`"
                      />
                    </td>
                    <td width="25%">
                      <b>{{ brand.name }}</b>
                    </td>
                    <td width="15%">
                      <span
                        v-if="brand.status"
                        class="badge rounded-pill bg-success"
                        >Active</span
                      >
                      <span
                        v-if="brand.is_featured"
                        class="badge rounded-pill bg-secondary"
                        >Featured</span
                      >
                    </td>
                    <td width="10%">
                      <div class="form-check-glow form-switch">
                        <input
                          class="form-check-input form-check-primary"
                          type="checkbox"
                          name="is_featured"
                          id="brand-is-featured"
                          v-model="brand.is_featured"
                          @change="toogleIsFeatured(brand)"
                        />
                      </div>
                    </td>
                    <td width="20%">
                      <button
                        @click="editBrand(brand.id)"
                        class="btn btn-secondary btn-circle rounded-circle"
                      >
                        <i class="fas fa-edit"></i>
                      </button>
                      <button
                        @click="deleteBrand(brand)"
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
      brands: [],
    };
  },

  mounted() {
    this.getAllBrands();
  },

  methods: {
    editBrand(brand_id) {
      location.href = `/admin/brand/${brand_id}/edit`;
    },

    async getAllBrands() {
      let response = await axios.get(`/admin/brand/get-all`);
      this.brands = response.data.data;
    },

    deleteBrand(brand) {
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
          axios.delete(`/admin/brand/${brand.id}`).then((response) => {
            if (response.data.success == true) {
              this.$swal(
                "Deleted",
                "You successfully deleted this file",
                "success"
              );
            }
            this.getAllBrands();
          });
        }
      });
    },

    async toogleIsFeatured(brand) {
      try {
        let payload = {
          is_featured: brand.is_featured,
        };
        let url = `/admin/brand/${brand.id}/toggle-is_featured`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
          this.notify(response.data.message, "Success", "success");
        }
      } catch (error) {
        this.errors = errors.response.data.errors;
        this.notify("Check Validation Errors", "Error", "success");
      }
    },
  },
};
</script>
