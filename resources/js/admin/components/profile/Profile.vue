<template>
  <section class="section">
    <div class="row">
      <div class="col-md-3 col-12">
        <div class="card shadow">
          <div class="card-header">
            <div class="user-img col-12 d-flex justify-content-center">
              <img
                src="/storage/images/static/profileImage.jpg"
                class="img-thumbnail"
                style="max-height: 170px"
              />
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <h5 class="lead">
                <b>{{ this.admin_details.name }}</b>
              </h5>
              <p>{{ this.admin_details.email }}</p>
            </div>
            <div
              class="nav flex-column nav-pills"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <a
                class="nav-link active"
                id="v-pills-detail-tab"
                data-toggle="pill"
                href="#v-pills-detail"
                role="tab"
                aria-controls="v-pills-detail"
                aria-selected="true"
                >Profile Details</a
              >
              <a
                class="nav-link"
                id="v-pills-security-tab"
                data-toggle="pill"
                href="#v-pills-security"
                role="tab"
                aria-controls="v-pills-security"
                aria-selected="false"
                >Security</a
              >
            </div>
            <div class="col-sm-12 d-flex">
              <button
                @click="this.logout"
                type="submit"
                class="btn btn-secondary mt-3 mb-1"
              >
                <i class="icon-mid bi bi-box-arrow-left me-2"> </i>
                Logout
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9 col-12">
        <div class="tab-content" id="v-pills-tabContent">
          <div
            class="tab-pane fade show active"
            id="v-pills-detail"
            role="tabpanel"
            aria-labelledby="v-pills-detail-tab"
          >
            <div class="card shadow">
              <div class="card-header">
                <h4 class="card-title">Profile Details</h4>
              </div>
              <div class="card-body">
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
          </div>

          <div
            class="tab-pane fade"
            id="v-pills-security"
            role="tabpanel"
            aria-labelledby="v-pills-security-tab"
          >
            <div class="card shadow">
              <div class="card-header">
                <h4 class="card-title">Change Password</h4>
              </div>
              <div class="card-body">
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
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { renderServerErrors } from "../../utils";

export default {
  props: ["admin_details"],
  data() {
    return {
      details: {
        name: "",
        email: "",
      },
      security: {
        current_password: "",
        new_password: "",
        confirm_password: "",
      },
    };
  },

  mounted() {
    this.details = this.admin_details;
  },

  methods: {
    // async getProfileDetail() {
    //   let response = await axios.get()
    // }

    async updateProfile() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.details;
        let url = `/admin/profile`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },

    async updatePassword() {
      let result = await this.$validator.validateAll();
      if (!result) {
        return;
      }
      try {
        let payload = this.security;
        let url = `/admin/profile/update-password`;
        let response = await axios.put(url, payload);
        if (response.data.success) {
        }
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },

    async logout() {
      try {
        let url = `/admin/logout`;
        let response = await axios.post(url);
        location.reload();
      } catch (error) {
        renderServerErrors(this.errors, error);
      }
    },
  },
};
</script>
)