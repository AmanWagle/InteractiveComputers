<template>
  <section class="section">
    <div class="row">
      <div class="col-md-8 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Brand Details</h4>
          </div>
          <div class="card-body">
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="brand-name">Brand's Name</label>
                    <input
                      type="text"
                      id="brand-name"
                      class="form-control"
                      name="name"
                      placeholder="Brand Name"
                      v-model="brand.name"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="brand-description">Description</label>
                    <textarea
                      id="brand-description"
                      class="form-control"
                      placeholder="Description"
                      v-model="brand.description"
                    />
                  </div>
                </div>

                <div class="my-1 row">
                  <div class="col-12 col-md-6 form-group">
                    <div class="form-check-glow form-switch">
                      <input
                        class="form-check-input form-check-primary"
                        type="checkbox"
                        id="brand-status"
                        name="is_featured"
                        v-model="brand.status"
                      />&nbsp;
                      <label class="form-check-label" for="brand-status"
                        >Status</label
                      >
                    </div>
                  </div>

                  <div class="col-12 col-md-6 form-group">
                    <div class="form-check-glow form-switch">
                      <input
                        class="form-check-input form-check-primary"
                        type="checkbox"
                        name="is_featured"
                        id="brand-is-featured"
                        v-model="brand.is_featured"
                      />&nbsp;
                      <label class="form-check-label" for="brand-is-featured"
                        >Featured</label
                      >
                    </div>
                  </div>
                </div>

                <div class="row my-1">
                  <div class="col-md-5 col-12 form-group">
                    <label for="brand-logo">Brand's Logo</label>
                    <div class="col-sm-10">
                      <button
                        class="btn btn-secondary btn-sm"
                        @click="$refs.imageInput.click()"
                      >
                        <i class="bi bi-cloud-arrow-up-fill"></i>&nbsp; Upload
                        Logo
                      </button>
                      <input
                        ref="imageInput"
                        type="file"
                        id="brand-logo"
                        class="form-control d-none"
                        v-on:change="onImageUpload"
                      />
                    </div>
                  </div>

                  <div class="form-group col-md-7 col-12" v-if="image_preview">
                    <img
                      :src="image_preview"
                      class="img-thumbnail"
                      width="200px"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">SEO Section</h4>
          </div>
          <div class="card-body">
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-title">Meta Title</label>
                    <input
                      type="text"
                      id="meta-title"
                      class="form-control"
                      name="meta_title"
                      placeholder="Meta Title"
                      v-model="brand.meta_title"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-keywords">Meta Keywords</label>
                    <input
                      type="text"
                      id="meta-keywords"
                      class="form-control"
                      name="meta_keywords"
                      placeholder="Meta Keywords"
                      v-model="brand.meta_keywords"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="meta-description">Meta Description</label>
                    <textarea
                      id="meta-description"
                      class="form-control"
                      placeholder="Meta Description"
                      v-model="brand.meta_description"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary" @click="saveBrand">
          Submit
        </button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["brand_details"],
  data() {
    return {
      brand: {
        name: "",
        logo: "",
        description: "",
        status: true,
        is_featured: false,

        meta_title: "",
        meta_keywords: "",
        meta_description: "",
      },
      image_preview: "",
      errors: {},
    };
  },

  mounted() {
    if (this.brand_details) {
      this.brand = this.brand_details;
      this.image_preview = this.brand.logo_url;
    }
  },

  methods: {
    onImageUpload(e) {
      let image = e.target.files[0];
      this.brand.logo = image;
      this.image_preview = URL.createObjectURL(image);
    },

    async saveBrand() {
      try {
        let payload = this.convertObjectToFormData(this.brand);
        let url = `/admin/brand`;
        if(this.brand_details){
            url = `/admin/brand/${this.brand_details.id}`;
            payload.append("_method", "PATCH")
        }
        let response = await axios.post(url, payload);
        if (response.data.success) {
          location.href = `/admin/brand`;
        }
      } catch (error) {
        this.errors = errors.response.data.errors;
      }
    },
  },
};
</script>