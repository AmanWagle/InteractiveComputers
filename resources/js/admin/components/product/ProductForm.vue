<template>
  <section class="section">
    <div class="row">
      <div id="accordion-product">
        <div class="card col-12 shadow">
          <div class="card-header">
            <a
              type="button"
              data-toggle="collapse"
              data-target="#collapseDetails"
              aria-expanded="true"
              aria-controls="collapseDetails"
            >
              <div class="d-flex align-items-center">
                <div class="avatar bg-primary me-3">
                  <span class="avatar-content"><b>1</b></span>
                </div>
                <div class="flex-1 overflow-hidden">
                  <h4 class="card-title">Product Details</h4>
                  <p class="text-muted text-truncate mb-0">
                    Fill all information below.
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div
            class="collapse show"
            id="collapseDetails"
            data-parent="#accordion-product"
          >
            <div class="card-body">
              <div class="form-group">
                <label for="name">Product Name</label>
                <input
                  v-model="product.name"
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Product Name"
                  v-validate="'required'"
                />
                <span class="text-danger text-sm" v-if="errors.has('name')">{{
                  errors.first("name")
                }}</span>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="productCode">Product Code</label>
                  <input
                    v-model="product.product_code"
                    type="text"
                    class="form-control"
                    name="productCode"
                    id="productCode"
                    placeholder="Product Code"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-if="errors.has('productCode')"
                    >{{ errors.first("productCode") }}</span
                  >
                </div>
                <div class="form-group col-md-6">
                  <label for="stock">Stock</label>
                  <input
                    v-model="product.stock"
                    type="number"
                    class="form-control"
                    name="stock"
                    id="stock"
                    placeholder="Stock"
                    v-validate="'required'"
                  />
                  <span
                    class="text-danger text-sm"
                    v-if="errors.has('stock')"
                    >{{ errors.first("stock") }}</span
                  >
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="categories">Product Categories</label>
                  <select
                    class="form-select"
                    name="category"
                    v-model="product.category_id"
                  >
                    <option value="" disabled hidden>Select...</option>
                    <option
                      v-for="category in categories"
                      v-bind:key="category.id"
                      v-bind:value="category.id"
                    >
                      {{ category.category_full_name }}
                    </option>
                  </select>
                  <span
                    class="text-danger text-sm"
                    v-if="errors.has('category')"
                    >{{ errors.first("category") }}</span
                  >
                </div>
                <div class="form-group col-md-6">
                  <label for="brand">Brand</label>
                  <select
                    class="form-select"
                    name="brand"
                    v-model="product.brand_id"
                  >
                    <option value="" disabled hidden>Select...</option>
                    <option
                      v-for="brand in brands"
                      v-bind:key="brand.id"
                      v-bind:value="brand.id"
                    >
                      {{ brand.name }}
                    </option>
                  </select>
                  <span
                    class="text-danger text-sm"
                    v-if="errors.has('brand')"
                    >{{ errors.first("brand") }}</span
                  >
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-5">
                  <label for="inputOriginalPrice">Original Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rs.</div>
                    </div>
                    <input
                      v-model="product.original_price"
                      type="number"
                      class="form-control"
                      id="inputOriginalPrice"
                      name="original_price"
                      placeholder="Original Price"
                      v-validate="'required'"
                    />
                    <span
                      class="text-danger text-sm"
                      v-if="errors.has('original_price')"
                      >{{ errors.first("original_price") }}</span
                    >
                  </div>
                </div>

                <div class="form-group col-md-2 my-2 d-flex align-items-center">
                  <div class="form-switch form-check-glow d-flex">
                    <input
                      class="form-check-input form-check-primary"
                      type="checkbox"
                      id="product-discount"
                      name="is_featured"
                      v-model="product.discount"
                    />&nbsp;
                    <label class="form-check-label" for="product-discount"
                      >Discount</label
                    >
                  </div>
                </div>

                <div v-if="product.discount" class="form-group col-md-5">
                  <label for="inputPrice">Selling Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rs.</div>
                    </div>
                    <input
                      v-model="product.selling_price"
                      type="number"
                      class="form-control"
                      id="inputPrice"
                      placeholder="Selling Price"
                    />
                  </div>
                </div>
              </div>

              <div class="my-2 row">
                <div class="col-12 col-md-6 form-group">
                  <div class="form-check-glow form-switch">
                    <input
                      class="form-check-input form-check-primary"
                      type="checkbox"
                      id="brand-status"
                      name="is_featured"
                      v-model="product.status"
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
                      v-model="product.is_featured"
                    />&nbsp;
                    <label class="form-check-label" for="brand-is-featured"
                      >Featured</label
                    >
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="shortDesc">Short Description</label>
                <input
                  v-model="product.short_description"
                  type="text"
                  class="form-control"
                  id="shortDesc"
                  placeholder="Short Description"
                  name="short_description"
                  v-validate="'required'"
                />
                <span
                  class="text-danger text-sm"
                  v-if="errors.has('short_description')"
                  >{{ errors.first("short_description") }}</span
                >
              </div>

              <div class="form-group">
                <label for="desc">Description</label>
                <textarea
                  v-model="product.description"
                  class="form-control"
                  id="desc"
                  placeholder="Description"
                  rows="6"
                  name="description"
                  v-validate="'required'"
                />
                <span
                  class="text-danger text-sm"
                  v-if="errors.has('description')"
                  >{{ errors.first("description") }}</span
                >
              </div>
            </div>
          </div>
        </div>

        <div class="card col-12 shadow">
          <div class="card-header">
            <a
              type="button"
              data-toggle="collapse"
              data-target="#collapseImages"
              aria-expanded="false"
              aria-controls="collapseImages"
            >
              <div class="d-flex align-items-center">
                <div class="avatar bg-primary me-3">
                  <span class="avatar-content"><b>2</b></span>
                </div>
                <div class="flex-1 overflow-hidden">
                  <h4 class="card-title">Product Images</h4>
                  <p class="text-muted text-truncate mb-0">
                    Fill all information below.
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div
            class="collapse"
            id="collapseImages"
            data-parent="#accordion-product"
          >
            <div class="card-body">
              <div class="col-md-12 form-group">
                <button
                  class="btn btn-outline-primary"
                  @click="$refs.imageInput.click()"
                >
                  <i class="bi bi-cloud-arrow-up-fill"></i>&nbsp; Upload Image</button
                >&nbsp;
                <label
                  v-if="this.product_details.product_images"
                  class="text-muted"
                >
                  *Existing images will be replaced if you choose to upload new
                  images.
                </label>
                <div class="input-group mb-3">
                  <input
                    ref="imageInput"
                    type="file"
                    class="d-none form-control"
                    multiple
                    accept="image/*"
                    name="product_images"
                    v-on:change="onImageUpload"
                  />
                  <span
                    class="text-danger text-sm"
                    v-if="errors.has('product_images')"
                    >{{ errors.first("product_images") }}</span
                  >
                </div>
              </div>

              <div class="col-12">
                <div class="row" v-if="image_previews.length">
                  <div
                    class="col-md-2 col-6 my-2 input-image-container"
                    v-for="(item, index) in image_previews"
                    :key="index"
                  >
                    <img :src="item" class="img-thumbnail" width="100%" />
                    <button
                      class="btn btn-sm btn-danger rounded-circle"
                      @click="onImageRemove(index)"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card col-12 shadow">
          <div class="card-header">
            <a
              type="button"
              data-toggle="collapse"
              data-target="#collapseSpecification"
              aria-expanded="false"
              aria-controls="collapseSpecification"
            >
              <div class="d-flex align-items-center">
                <div class="avatar bg-primary me-3">
                  <span class="avatar-content"><b>3</b></span>
                </div>
                <div class="flex-1 overflow-hidden">
                  <h4 class="card-title">Specifications</h4>
                  <p class="text-muted text-truncate mb-0">
                    Fill all information below.
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div
            class="collapse"
            id="collapseSpecification"
            data-parent="#accordion-product"
          >
            <div class="card-body">
              <div
                v-for="(index, key) in specification_count"
                :key="key"
                class="row"
              >
                <div class="form-group col-md-3">
                  <input
                    type="text"
                    v-model="specifications[key].variable"
                    class="form-control"
                    id="variable"
                    placeholder="Variable"
                  />
                </div>
                <div
                  class="
                    col-md-1
                    d-flex
                    align-items-center
                    justify-content-center
                  "
                >
                  <span>
                    <i class="fas fa-arrow-right fa-2x text-primary"></i>
                  </span>
                </div>
                <div class="form-group col-md-7">
                  <input
                    type="text"
                    v-model="specifications[key].value"
                    class="form-control"
                    id="value"
                    placeholder="Value"
                  />
                </div>
                <div
                  class="
                    col-md-1
                    d-flex
                    align-items-center
                    justify-content-center
                  "
                >
                  <button
                    class="btn btn-danger btn-circle rounded-circle"
                    @click="removeSpecification(key)"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="col-12 text-center mt-2">
                <button
                  class="btn btn-success btn-circle rounded-circle"
                  @click="addSpecification()"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card col-12 shadow">
          <div class="card-header">
            <a
              type="button"
              data-toggle="collapse"
              data-target="#collapseSeo"
              aria-expanded="false"
              aria-controls="collapseSeo"
            >
              <div class="d-flex align-items-center">
                <div class="avatar bg-primary me-3">
                  <span class="avatar-content"><b>4</b></span>
                </div>
                <div class="flex-1 overflow-hidden">
                  <h4 class="card-title">SEO Section</h4>
                  <p class="text-muted text-truncate mb-0">
                    Fill all information below.
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div
            class="collapse"
            id="collapseSeo"
            data-parent="#accordion-product"
          >
            <div class="card-body">
              <div class="form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="meta-title">Meta Title</label>
                      <input
                        type="text"
                        id="meta-title"
                        class="form-control"
                        name="meta_title"
                        placeholder="Meta Title"
                        v-model="product.meta_title"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="meta-keywords">Meta Keywords</label>
                      <input
                        type="text"
                        id="meta-keywords"
                        class="form-control"
                        name="meta_keywords"
                        placeholder="Meta Keywords"
                        v-model="product.meta_keywords"
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
                        v-model="product.meta_description"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button @click="saveProduct" class="btn btn-primary shadow mb-3">
          Submit
        </button>
      </div>
    </div>
  </section>
</template>

<script>
import { renderServerErrors } from "../../utils";
export default {
  props: ["product_details"],
  data() {
    return {
      product: {
        name: "",
        product_code: "",
        stock: "",
        short_description: "",
        description: "",
        category_id: "",
        brand_id: "",
        original_price: "",
        discount: false,
        selling_price: "",
        status: true,
        is_featured: false,

        meta_title: "",
        meta_keywords: "",
        meta_description: "",
      },
      specifications: [{}],
      specification_count: 1,

      product_images: [],
      image_previews: [],

      categories: [],
      brands: [],
    };
  },

  mounted() {
    this.getCategories();
    this.getBrands();

    if (this.product_details) {
      this.product = this.product_details;
      this.image_previews = this.product_details.images_url;
      this.specifications = this.product_details.specifications_array;
      this.specification_count =
        this.product_details.specifications_array.length;
    }
  },

  methods: {
    onImageUpload(e) {
      if (this.product_details) {
        if (!this.product_images.length) {
          this.image_previews = [];
        }
      }
      let images = e.target.files;
      Array.from(images).forEach((image) => {
        if (this.product_images.length < 6) {
          this.product_images.push(image);
          let image_url = URL.createObjectURL(image);
          this.image_previews.push(image_url);
        } else {
          console.log("Max Limit reached!");
        }
      });
    },

    addSpecification() {
      this.specifications.push({});
      this.specification_count++;
    },

    removeSpecification(key) {
      this.specifications.splice(key, 1);
      this.specification_count--;
    },

    onImageRemove(index) {
      console.log(index);
      this.product_images.splice(index, 1);
      this.image_previews.splice(index, 1);
    },

    async getCategories() {
      let response = await axios.get("/admin/product-category/get-all");
      this.categories = response.data.data;
    },

    async getBrands() {
      let response = await axios.get("/admin/brand/get-all");
      this.brands = response.data.data;
    },

    async filterSpecification() {},

    async saveProduct() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.convertObjectToFormData(this.product);

        //for specifications
        if (this.specifications) {
          var filtered_specs = this.specifications.filter(
            (obj) =>
              !(
                obj &&
                Object.keys(obj).length === 0 &&
                obj.constructor === Object
              )
          );
          payload.append("specifications", JSON.stringify(filtered_specs));
        }

        this.product_images.forEach(function (image) {
          payload.append("product_image[]", image);
        });
        let url = `/admin/product`;

        if (this.product_details) {
          url = `/admin/product/${this.product_details.id}`;
          payload.append("_method", "PATCH");
        }

        let response = await axios.post(url, payload);
        if (response.data.success) {
          location.href = "/admin/product";
        }
      } catch (errors) {
        renderServerErrors(this.errors, error);
        this.notify("Check Validation Errors", "Error", "error");
      }
    },
  },
};
</script>
