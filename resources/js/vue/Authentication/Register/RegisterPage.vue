<template>
  <div class="login-register">
    <router-link to="/home">Home</router-link>
    <h1>Register</h1>
    <form @submit.prevent="register">
      <div>
        <label for="name">Name:</label>
        <input type="text" v-model="name" required />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <div>
        <label for="password">Password Confirm:</label>
        <input type="password" v-model="password_confirmation" required />
      </div>
      <button type="submit">Register</button>
    </form>
    <p>
      Already have an account? <router-link to="/login">Login</router-link>
    </p>
  </div>
</template>
  
  <script>
  export default {
    name: 'RegisterPage',
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }
    },
    methods: {
      async register() {
        try {
          await this.$store.dispatch('registerUser', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          });
          this.$router.push('/dashboard');
        } catch (error) {
          alert("Error during registration");
        }
    }
  }
}
  </script>