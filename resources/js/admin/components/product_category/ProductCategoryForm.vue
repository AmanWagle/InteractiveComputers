<template>
  <section class="section">
    <div class="row">
      <div class="col-md-8 col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title">Category Details</h4>
          </div>
          <div class="card-body">
            <div class="form">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="category-name">Category's Name</label>
                    <input
                      type="text"
                      id="category-name"
                      class="form-control"
                      name="name"
                      placeholder="Category Name"
                      v-model="category.name"
                    />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="category-parent">Parent Category</label>
                    <select
                      class="form-select"
                      id="category-parent"
                      v-model="category.parent_id"
                    >
                      <option value="" disabled hidden>Select Parent Category...</option>
                      <option
                        v-for="category in parent_categories"
                        v-bind:key="category.id"
                        v-bind:value="category.id"
                      >
                        {{ category.category_full_name }}
                      </option>
                    </select>
                    <p>
                      <small class="text-muted"
                        >Only if you want this category to be child of other category.</small
                      >
                    </p>
                  </div>
                </div>

                <div class="my-1 row">
                  <div class="col-12 col-md-6 form-group">
                    <div class="form-check-glow form-switch">
                      <input
                        class="form-check-input form-check-primary"
                        type="checkbox"
                        id="category-status"
                        name="is_featured"
                        v-model="category.status"
                      />&nbsp;
                      <label class="form-check-label" for="category-status"
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
                        id="category-is-featured"
                        v-model="category.is_featured"
                      />&nbsp;
                      <label class="form-check-label" for="category-is-featured"
                        >Featured</label
                      >
                    </div>
                  </div>
                </div>

                <div class="row my-1">
                  <div class="col-md-5 col-12 form-group">
                    <label for="category-icon">Category's Icon</label>
                    <div class="col-sm-10">
                      <button
                        class="btn btn-outline-primary"
                        @click="$refs.imageInput.click()"
                      >
                        <i class="bi bi-cloud-arrow-up-fill"></i>&nbsp; Upload
                        Icon
                      </button>
                      <input
                        ref="imageInput"
                        type="file"
                        id="category-icon"
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
        <div class="card shadow">
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
                      v-model="category.meta_title"
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
                      v-model="category.meta_keywords"
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
                      v-model="category.meta_description"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary shadow" @click="saveCategory">
          Submit
        </button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["category_details"],
  data() {
    return {
      parent_categories: [],
      category: {
        name: "",
        icon: "",
        parent_id: "",
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
    this.getCategories();

    if (this.category_details) {
      this.category = this.category_details;
      this.image_preview = this.category.icon_url;
    }
  },

  methods: {
    async getCategories() {
      let response = await axios.get("/admin/product-category/get-all");
      this.parent_categories = response.data.data;
    },

    onImageUpload(e) {
      let image = e.target.files[0];
      this.category.icon = image;
      this.image_preview = URL.createObjectURL(image);
    },

    async saveCategory() {
      try {
        let payload = this.convertObjectToFormData(this.category);
        let url = `/admin/product-category`;
        if (this.category_details) {
          url = `/admin/product-category/${this.category_details.id}`;
          payload.append("_method", "PATCH");
        }
        let response = await axios.post(url, payload);
        if (response.data.success) {
          location.href = `/admin/product-category`;
        }
      } catch (errors) {
        this.errors = errors.response.data.errors;
      }
    },
  },
};
</script>