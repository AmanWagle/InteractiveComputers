<template>
  <div class="reviews">
    <h3>Post your review</h3>
    <div>
      <form @submit.prevent="submitReview">
        <div class="form-group">
          <label for="exampleFormSelect">Rating</label>
          <select
            class="form-select form-control"
            id="exampleFormSelect"
            aria-label="Default select example"
            name="rating"
            v-model="review.rating"
          >
            <option value="" selected>Select your rating.</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Review summary</label>
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Review Summary"
            name="review_summary"
            v-model="review.review_summary"
          />
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Full Review</label>
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="3"
            name="full_review"
            v-model="review.review"
          ></textarea>
        </div>
        <button class="btn btn-primary">Submit Review</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ["product_id"],
  data() {
    return {
      review: {
        rating: "",
        review_summary: "",
        review: "",
      },
    };
  },

  mounted() {
    this.checkIfReviewExists();
  },

  methods: {
    async checkIfReviewExists() {
      let url = `/product/${this.product_id}/user-review`;
      let response = await axios.get(url);
      console.log(response.data.data);
    },

    async submitReview() {
      try {
        let url = `/product/${this.product_id}/review`;
        let response = await axios.post(url, this.review);
        if (response) {
          location.reload();
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>