<template>
  <div>
    <div
      class="page-header text-center"
      style="background-image: url('assets/images/page-header-bg.jpg')"
    >
      <div class="container">
        <h1 class="page-title">Grid 3 Columns<span>Shop</span></h1>
      </div>
      <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Shop</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Grid 3 Columns
          </li>
        </ol>
      </div>
      <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
      <div class="container">
        <div class="row">
          <aside class="col-lg-3 order-lg-first">
            <div class="sidebar sidebar-shop">
              <div class="widget widget-clean">
                <label>Filters:</label>
                <a href="#" class="sidebar-filter-clear">Clean All</a>
              </div>
              <!-- End .widget widget-clean -->

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
                  Showing <span>9 of 56</span> Products
                </div>
              </div>

              <div class="toolbox-right">
                <div class="toolbox-sort">
                  <label for="sortby">Sort by:</label>
                  <div class="select-custom">
                    <select name="sortby" id="sortby" class="form-control">
                      <option value="popularity" selected="selected">
                        Most Popular
                      </option>
                      <option value="rating">Most Rated</option>
                      <option value="date">Date</option>
                    </select>
                  </div>
                </div>
                <!-- End .toolbox-sort -->
                <div class="toolbox-layout">
                  <a href="category-list.html" class="btn-layout">
                    <svg width="16" height="10">
                      <rect x="0" y="0" width="4" height="4" />
                      <rect x="6" y="0" width="10" height="4" />
                      <rect x="0" y="6" width="4" height="4" />
                      <rect x="6" y="6" width="10" height="4" />
                    </svg>
                  </a>

                  <a href="category-2cols.html" class="btn-layout">
                    <svg width="10" height="10">
                      <rect x="0" y="0" width="4" height="4" />
                      <rect x="6" y="0" width="4" height="4" />
                      <rect x="0" y="6" width="4" height="4" />
                      <rect x="6" y="6" width="4" height="4" />
                    </svg>
                  </a>

                  <a href="category.html" class="btn-layout active">
                    <svg width="16" height="10">
                      <rect x="0" y="0" width="4" height="4" />
                      <rect x="6" y="0" width="4" height="4" />
                      <rect x="12" y="0" width="4" height="4" />
                      <rect x="0" y="6" width="4" height="4" />
                      <rect x="6" y="6" width="4" height="4" />
                      <rect x="12" y="6" width="4" height="4" />
                    </svg>
                  </a>

                  <a href="category-4cols.html" class="btn-layout">
                    <svg width="22" height="10">
                      <rect x="0" y="0" width="4" height="4" />
                      <rect x="6" y="0" width="4" height="4" />
                      <rect x="12" y="0" width="4" height="4" />
                      <rect x="18" y="0" width="4" height="4" />
                      <rect x="0" y="6" width="4" height="4" />
                      <rect x="6" y="6" width="4" height="4" />
                      <rect x="12" y="6" width="4" height="4" />
                      <rect x="18" y="6" width="4" height="4" />
                    </svg>
                  </a>
                </div>
                <!-- End .toolbox-layout -->
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
                    <figure class="product-media">
                      <span
                        v-if="product.discount"
                        class="product-label label-sale"
                        >Sale</span
                      >
                      <a href="product.html">
                        <img
                          :src="product.images_url[0]"
                          alt="Product image"
                          class="product-image"
                        />
                      </a>

                      <div class="product-action-vertical">
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
                      </div>
                    </figure>
                    <!-- End .product-media -->

                    <div class="product-body">
                      <div class="product-cat">
                        <a href="#">{{ product.category.name }}</a>
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

            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a
                    class="page-link page-link-prev"
                    href="#"
                    aria-label="Previous"
                    tabindex="-1"
                    aria-disabled="true"
                  >
                    <span aria-hidden="true"
                      ><i class="icon-long-arrow-left"></i></span
                    >Prev
                  </a>
                </li>
                <li class="page-item active" aria-current="page">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item-total">of 6</li>
                <li class="page-item">
                  <a
                    class="page-link page-link-next"
                    href="#"
                    aria-label="Next"
                  >
                    Next
                    <span aria-hidden="true"
                      ><i class="icon-long-arrow-right"></i
                    ></span>
                  </a>
                </li>
              </ul>
            </nav>
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
    };
  },

  components: {
    "category-tree": LiquorTree,
    "vue-slider": VueSlider,
  },

  mounted() {
    this.getUrlParameter();
    this.getProductCategories();
  },

  methods: {
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