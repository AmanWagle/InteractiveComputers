<template>
  <div class="card shadow" style="padding: 10px">
    <div class="card-body">
      <h5 class="card-title my-3">Security</h5>
      <div class="form">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input
                v-model="security.current_password"
                type="password"
                id="current_password"
                class="form-control"
                name="current_password"
                placeholder="Current Password"
              />
              <span
                class="text-danger text-sm"
                v-if="errors.has('current_password')"
                >{{ errors.first("current_password") }}</span
              >
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input
                v-model="security.new_password"
                type="password"
                id="new_password"
                class="form-control"
                name="new_password"
                placeholder="New Password"
              />
              <span
                class="text-danger text-sm"
                v-if="errors.has('new_password')"
                >{{ errors.first("new_password") }}</span
              >
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input
                v-model="security.confirm_password"
                type="password"
                id="confirm_password"
                class="form-control"
                name="confirm_password"
                placeholder="Confirm Password"
              />
              <span
                class="text-danger text-sm"
                v-if="errors.has('confirm_password')"
                >{{ errors.first("confirm_password") }}</span
              >
            </div>
          </div>
        </div>

        <div class="col-sm-12 d-flex justify-content-end">
          <button
            @click="this.updatePassword"
            type="submit"
            class="btn btn-primary mt-2 me-1 mb-1"
          >
            Update Password
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
      security: {
        current_password: "",
        new_password: "",
        confirm_password: "",
      },
    };
  },

  mounted() {
    this.details = this.user_details;
  },

  methods: {
    async updatePassword() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.security;
        let url = `/profile/update-password`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
          this.$swal({
            icon: "success",
            title: "Success.",
            text: "Password Updated Successfully.",
          }).then((result) => {
            if (result.value) {
              location.reload();
            }
          });
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },
  },
};
</script>