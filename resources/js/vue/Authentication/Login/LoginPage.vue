<template>
  <div class="login-register">
    <router-link to="/home">Home</router-link>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <p>
      Don't have an account? <router-link to="/register">Register</router-link>
    </p>
  </div>
</template>
  
  <script>
  export default {
    name: 'LoginPage',
    data() {
      return {
        email: '',
        password: '',
      }
    },
    methods: {
      async login() {
        try {
          await this.$store.dispatch('loginUser', {
            email: this.email,
            password: this.password,
          });
          this.$router.push('/dashboard');
        } catch (error) {
          alert("Invalid credentials");
        }
    }
  }
}
  </script>