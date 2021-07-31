<template>
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="card-title d-inline-block">Product Reviews</h4>
          </div>
          <div class="card-body">
            <!-- table striped -->
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>PRODUCT NAME</th>
                    <th>USER NAME</th>
                    <th>RATING</th>
                    <th>REVIEW SUMMARY</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(product_review, index) in product_reviews"
                    :key="product_review.id"
                  >
                    <td>
                      <b>{{ index + 1 }}</b>
                    </td>
                    <td>
                      <b>{{ product_review.product.name }}</b>
                    </td>
                    <td>
                      <b>{{ product_review.user.name }}</b>
                    </td>
                    <td>
                      <p>{{ product_review.rating }}</p>
                    </td>
                    <td>
                      <p>{{ product_review.review_summary }}</p>
                    </td>
                    <td>
                      <div class="form-check-glow form-switch">
                        <input
                          class="form-check-input form-check-primary"
                          type="checkbox"
                          name="is_featured"
                          id="categroy-is-featured"
                          v-model="product_review.status"
                          @change="toogleStatus(product_review)"
                        />
                      </div>
                    </td>
                    <td width="10%">
                      <button
                        class="btn btn-secondary btn-circle rounded-circle"
                        @click="selectedReview(product_review)"
                      >
                        <i class="fas fa-search"></i>
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

    <!-- Modal for review details -->
    <div
      class="modal modal-borderless fade text-left"
      id="review-detail"
      tabindex="-1"
      aria-labelledby="myModalLabel17"
      style="display: none"
      aria-hidden="true"
    >
      <div
        class="
          modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg
        "
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel17">Review</h4>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div
            class="modal-body container"
            v-if="Object.keys(selected_review).length"
          >
            <div>
              <p class="row">
                <b class="col-md-3">Product Name: </b
                ><span class="col-md-9"
                  >{{ selected_review.product.name }}
                </span>
              </p>
              <p class="row">
                <b class="col-md-3">User: </b
                ><span class="col-md-9">{{ selected_review.user.name }}</span>
              </p>
              <p class="row">
                <b class="col-md-3">Rating: </b
                ><span class="col-md-9">{{ selected_review.rating }}</span>
              </p>
              <p class="row">
                <b class="col-md-3">Review Summary: </b
                ><span class="col-md-9">{{
                  selected_review.review_summary
                }}</span>
              </p>
              <p class="row">
                <b class="col-md-3">Review: </b
                ><span class="col-md-9">{{ selected_review.review }}</span>
              </p>
              <div class="row">
                <b class="col-md-3">Review: </b>
                <div class="form-check-glow form-switch col-md-9">
                  <input
                    class="form-check-input form-check-primary"
                    type="checkbox"
                    name="is_featured"
                    id="categroy-is-featured"
                    v-model="selected_review.status"
                    @change="toogleStatus(selected_review)"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary ml-1"
              data-bs-dismiss="modal"
            >
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
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
      product_reviews: [],
      selected_review: {},
    };
  },

  mounted() {
    this.getAllReviews();
  },

  methods: {
    async getAllReviews() {
      let response = await axios.get(`/admin/review/get-all`);
      this.product_reviews = response.data.data;
    },

    selectedReview(product_review) {
      this.selected_review = product_review;
      $("#review-detail").modal("show");
    },

    async toogleStatus(product_review) {
      try {
        let payload = {
          status: product_review.status,
        };
        let url = `/admin/review/${product_review.id}/toggle-status`;
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
