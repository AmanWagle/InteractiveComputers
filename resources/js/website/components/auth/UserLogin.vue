<template>
  <div>
    <form @submit.prevent="loginUser">
      <div class="form-group">
        <label for="email">Email address *</label>
        <input
          type="email"
          v-model="user.email"
          class="form-control"
          id="email"
          name="email"
          required
        />
      </div>

      <div class="form-group">
        <label for="password">Password *</label>
        <input
          type="password"
          v-model="user.password"
          class="form-control"
          id="password"
          name="password"
          required
        />
      </div>

      <div class="form-footer">
        <button type="submit" class="btn btn-outline-primary-2">
          <span>LOG IN</span>
          <i class="icon-long-arrow-right"></i>
        </button>

        <div class="custom-control custom-checkbox">
          <input
            type="checkbox"
            class="custom-control-input"
            id="signin-remember"
          />
          <label class="custom-control-label" for="signin-remember"
            >Remember Me</label
          >
        </div>

        <a href="#" class="forgot-link">Forgot Your Password?</a>
      </div>
    </form>
    <!-- <div class="form-choice">
      <p class="text-center">or sign in with</p>
      <div class="row">
        <div class="col-sm-6">
          <a href="#" class="btn btn-login btn-g">
            <i class="icon-google"></i>
            Login With Google
          </a>
        </div>
        <div class="col-sm-6">
          <a href="#" class="btn btn-login btn-f">
            <i class="icon-facebook-f"></i>
            Login With Facebook
          </a>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },

  methods: {
    async loginUser() {
      try {
        let url = `/login`;
        let response = await axios.post(url, this.user);
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