<template>
  <div class="card shadow" style="padding: 10px">
    <div class="card-body">
      <h5 class="card-title my-3">Account Info</h5>
      <div class="form">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="name">Name</label>
              <input
                v-model="details.name"
                type="text"
                id="name"
                class="form-control"
                name="name"
                placeholder="Name"
              />
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="email">Email</label>
              <input
                v-model="details.email"
                type="email"
                id="email"
                class="form-control"
                name="email"
                placeholder="Email"
              />
            </div>
          </div>
        </div>

        <div class="col-sm-12 d-flex justify-content-end">
          <button
            @click="this.updateProfile"
            type="submit"
            class="btn btn-primary mt-2 me-1 mb-1"
          >
            Update
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user_details"],
  data() {
    return {
      details: {
        name: "",
        email: "",
      },
    };
  },

  mounted() {
    this.details = this.user_details;
  },

  methods: {
    async updateProfile() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.details;
        let url = `/profile`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
          this.$swal({
            icon: "success",
            title: "Success.",
            text: "Details Updated Successfully.",
          });
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },
  },
};
</script>