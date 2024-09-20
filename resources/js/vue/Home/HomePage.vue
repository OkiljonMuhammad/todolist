<template>
    <div class="home-page">
      <!-- Navigation Bar -->
      <nav class="navbar">
        <ul>
          <li><router-link to="/login">Login</router-link></li>
          <li><router-link to="/register">Register</router-link></li>
          <li><router-link to="/dashboard">Dashboard</router-link></li>
        </ul>
      </nav>
  
      <!-- Main Content Section -->
      <main class="content">
        <h1>Welcome to the Home Page</h1>
        <p>Explore the app by navigating to different pages.</p>
  
        <!-- Quick Action Buttons -->
        <div class="action-buttons">
          <router-link to="/login" class="btn">Log in</router-link>
          <router-link to="/register" class="btn">Sign up</router-link>
          <router-link to="/dashboard" class="btn">View Dashboard</router-link>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  export default {
    name: 'HomePage',
  }
  </script>
  
  <style scoped>
  .home-page {
    font-family: Arial, sans-serif;
    padding: 20px;
    text-align: center;
  }
  
  .navbar {
    background-color: #333;
    padding: 10px;
  }
  
  .navbar ul {
    list-style: none;
    padding: 0;
  }
  
  .navbar ul li {
    display: inline;
    margin: 0 15px;
  }
  
  .navbar ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
  }
  
  .navbar ul li a:hover {
    text-decoration: underline;
  }
  
  .content {
    margin-top: 50px;
  }
  
  .action-buttons {
    margin-top: 20px;
  }
  
  .btn {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }
  
  .btn:hover {
    background-color: #0056b3;
  }
  </style>
  
  