<template>
    <div class="logout">
      <h2>You have been logged out</h2>
      <p>Redirecting to home...</p>
    </div>
</template>
  
  <script>
  export default {
    name: 'LogoutPage',
    created() {
      this.logout();
    },
    methods: {
      logout() {
        this.$store.dispatch('logoutUser');
        this.$router.push('/home');
      },
    },
  };
  </script>
  