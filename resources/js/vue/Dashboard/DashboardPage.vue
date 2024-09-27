<template>
   <router-link to="/todos">Todos</router-link> 
   <div class="logout">
      <button @click="logout">Logout</button>
    </div> 
</template>

<script>
  export default {
    name: 'DashboardPage',
    methods: {
      logout() {
        this.$store.dispatch('logoutUser');
        this.$router.push('/home');
      },
    },
  };
  </script>