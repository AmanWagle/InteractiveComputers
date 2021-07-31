<template>
  <div>
    <form @submit.prevent="registerUser">
      <div class="form-group">
        <label for="name">Name *</label>
        <input
          id="name"
          v-model="user.name"
          type="text"
          class="form-control"
          name="name"
          required
        />
      </div>

      <div class="form-group">
        <label for="email">Your email address *</label>
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

      <div class="form-group">
        <label for="password-confirm">Confirm Password *</label>
        <input
          type="password"
          v-model="user.password_confirmation"
          class="form-control"
          id="password-confirm"
          name="password-confirm"
          required
        />
      </div>

      <div class="form-footer">
        <button type="submit" class="btn btn-outline-primary-2">
          <span>SIGN UP</span>
          <i class="icon-long-arrow-right"></i>
        </button>

        <div class="custom-control custom-checkbox">
          <input
            type="checkbox"
            class="custom-control-input"
            id="register-policy"
            required
          />
          <label class="custom-control-label" for="register-policy"
            >I agree to the <a href="#">privacy policy</a> *</label
          >
        </div>
      </div>
    </form>
    <div class="form-choice">
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },

  methods: {
    async registerUser() {
      try {
        let url = `/register`;
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