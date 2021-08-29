<template>
  <div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Shop</a></li>
        </ol>
      </div>
    </nav>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <aside class="col-lg-3 order-lg-first">
            <div class="sidebar sidebar-shop">
              <div class="widget widget-categories">
                <h3 class="widget-title">Categories</h3>
                <category-tree
                  :data="product_categories"
                  :options="treeOptions"
                  v-if="!category_loading"
                >
                  <span class="tree-text" slot-scope="{ node }">
                    <template>
                      <a :href="`/shop?category=${node.id}`" class="text-black">
                        <img
                          v-if="node.data.icon_url"
                          :src="node.data.icon_url"
                          alt
                          width="25px"
                          style="
                            display: inline-block;
                            margin-right: 5px;
                            position: relative;
                          "
                        />
                        {{ node.text }}
                      </a>
                    </template>
                  </span>
                </category-tree>
              </div>

              <!-- End .widget -->

              <div class="widget widget-collapsible">
                <h3 class="widget-title">
                  <a
                    data-toggle="collapse"
                    href="#widget-4"
                    role="button"
                    aria-expanded="true"
                    aria-controls="widget-4"
                  >
                    Brands
                  </a>
                </h3>
                <div class="collapse show" id="widget-4">
                  <div class="widget-body">
                    <div class="filter-items">
                      <div
                        v-for="brand in brands"
                        :key="brand.id"
                        class="filter-item"
                      >
                        <div class="custom-control custom-radio">
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="brandRadio"
                            @change="onBrandChange(brand.slug)"
                            :id="brand.id"
                          />
                          <label class="custom-control-label" :for="brand.id">
                            <img
                              v-if="brand.logo_url"
                              :src="brand.logo_url"
                              alt
                              width="25px"
                              style="
                                display: inline-block;
                                margin-right: 5px;
                                position: relative;
                              "
                            />
                            {{ brand.name }}</label
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Price collapse -->
              <div class="widget widget-collapsible">
                <h3 class="widget-title">
                  <a
                    data-toggle="collapse"
                    href="#widget-5"
                    role="button"
                    aria-expanded="true"
                    aria-controls="widget-5"
                  >
                    Price
                  </a>
                </h3>

                <div class="collapse show" id="widget-5">
                  <div class="widget-body">
                    <div class="filter-price">
                      <div class="filter-price-text">
                        Price Range:
                        <span id="filter-price-range"
                          >Rs. {{ min_price }} - Rs. {{ max_price }}</span
                        >
                      </div>
                      <vue-slider
                        :min="min_price"
                        :max="max_price"
                        @drag-end="onPriceSliderDrag"
                        v-model="url_params.price_range"
                      ></vue-slider>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </aside>

          <div class="col-lg-9">
            <!-- Top toolbox -->
            <div class="toolbox">
              <div class="toolbox-left">
                <div class="toolbox-info">
                  Showing
                  <span>
                    {{
                      this.products.from +
                      ` to ` +
                      this.products.to +
                      ` of ` +
                      this.products.total
                    }}
                  </span>
                  Results
                </div>
              </div>

              <div class="toolbox-right">
                <div class="toolbox-sort">
                  <label for="sortby">Sort by:</label>
                  <div class="select-custom">
                    <select
                      v-model="sort_by"
                      name="sortby"
                      id="sortby"
                      @change="sortByOnChange"
                      class="form-control"
                    >
                      <option
                        v-for="(option, key) in sort_options"
                        :value="option.value"
                        :label="option.label"
                        :key="key"
                      ></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="products mb-3">
              <div class="row justify-content-center">
                <!-- For each product -->
                <div
                  v-for="product in products.data"
                  :key="product.id"
                  class="col-6 col-md-4 col-lg-4 col-xl-3"
                >
                  <div class="product product-7 text-center">
                    <figure class="product-media product--image-wrapper">
                      <span
                        v-if="product.discount"
                        class="product-label label-sale"
                        >Sale</span
                      >
                      <a :href="`/product/${product.slug}`">
                        <img
                          :src="product.images_url[0]"
                          alt="Product image"
                          class="product-image"
                        />
                      </a>

                      <!-- <div class="product-action-vertical">
                        <a
                          href="popup/quickView.html"
                          class="btn-product-icon btn-quickview"
                          title="Quick view"
                          ><span>Quick view</span></a
                        >
                      </div>

                      <div class="product-action">
                        <a
                          href="#"
                          class="btn-product btn-cart"
                          title="Add to cart"
                          ><span>add to cart</span></a
                        >
                      </div> -->
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                      <div class="product-cat">
                        <a :href="`/shop?category=` + product.category.slug">{{
                          product.category.name
                        }}</a>
                      </div>
                      <h3 class="product-title">
                        <a :href="`/product/${product.slug}`">{{
                          product.name
                        }}</a>
                      </h3>

                      <div class="product-price">
                        <span class="new-price"
                          >Rs.
                          {{
                            product.discount
                              ? product.selling_price
                              : product.original_price
                          }}</span
                        >
                        <span v-if="product.discount" class="old-price"
                          >Was {{ product.original_price }}</span
                        >
                      </div>
                      <div class="ratings-container">
                        <div class="ratings">
                          <div
                            class="ratings-val"
                            :style="{
                              width: (product.average_rating / 5) * 100 + `%`,
                            }"
                          ></div>
                        </div>
                        <span class="ratings-text"
                          >( {{ product.reviews.length }} Reviews )</span
                        >
                      </div>
                    </div>
                    <!-- End .product-body -->
                  </div>
                  <!-- End .product -->
                </div>
              </div>
            </div>
            <!-- pagination -->
            <advanced-laravel-vue-paginate
              :data="products"
              @paginateTo="fetchProducts"
              useStyle="bootstrap"
            />
          </div>
          <!-- End .col-lg-9 -->
        </div>
        <!-- End .row -->
      </div>
      <!-- End .container -->
    </div>
    <!-- End .page-content -->
  </div>
</template>

<script>
import LiquorTree from "liquor-tree";
import VueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";
import AdvancedLaravelVuePaginate from "advanced-laravel-vue-paginate";
import "advanced-laravel-vue-paginate/dist/advanced-laravel-vue-paginate.css";

export default {
  data() {
    return {
      product_categories: [],
      options: {
        checkbox: true,
      },
      treeOptions: {
        propertyNames: {
          text: "name",
          data: "icon_url_obj",
          id: "slug",
        },
      },
      category_loading: true,
      fetch_side_bar: true,
      url_params: {},
      products: {},
      brands: [],
      min_price: "",
      max_price: "",
      sort_by: "none",
      sort_options: [
        { label: "Sorting Items", value: "none" },
        { label: "Price Low to High", value: "low_to_high" },
        { label: "Price High to Low", value: "high_to_low" },
        { label: "A to Z", value: "a_to_z" },
        { label: "Z to A", value: "z_to_a" },
      ],
    };
  },

  components: {
    "category-tree": LiquorTree,
    "vue-slider": VueSlider,
    "advanced-laravel-vue-paginate": AdvancedLaravelVuePaginate,
  },

  mounted() {
    this.getUrlParameter();
    this.getProductCategories();
  },

  methods: {
    sortByOnChange(event) {
      this.$set(this.url_params, "filter", event.target.value);
      this.fetchProducts();
    },

    async getProductCategories() {
      try {
        let response = await axios.get(`/shop/get-categories`);
        this.product_categories = response.data.data;
      } catch (e) {
      } finally {
        this.category_loading = false;
      }
    },

    async getUrlParameter() {
      const urlSearchParams = new URLSearchParams(window.location.search);
      const params = Object.fromEntries(urlSearchParams.entries());
      this.url_params = params;

      this.fetchProducts();
    },

    async fetchProducts(page = 1) {
      try {
        this.url_params.fetch_side_bar = this.fetch_side_bar;
        let response = await axios.get(`/shop/get-products?page=` + page, {
          params: this.url_params,
        });
        this.products = response.data.products;
        if (response.data.sidebar) {
          this.brands = response.data.sidebar.brands;
          this.min_price = response.data.sidebar.min_price;
          this.max_price = response.data.sidebar.max_price;
          this.url_params.price_range = [
            response.data.sidebar.min_price,
            response.data.sidebar.max_price,
          ];
        }
      } catch (e) {
      } finally {
        this.fetch_side_bar = false;
        this.url_params.fetch_side_bar = false;
      }
    },

    async onBrandChange(brand_slug) {
      this.$set(this.url_params, "brand", brand_slug);
      this.fetchProducts();
    },

    async onPriceSliderDrag() {
      this.fetchProducts();
    },
  },
};
</script>