import { createRouter, createWebHashHistory } from 'vue-router'

// Import your components
import LoginPage from '../vue/Authentication/Login/LoginPage.vue'
import RegisterPage from '../vue/Authentication/Register/RegisterPage.vue'
import HomePage from '../vue/Home/HomePage.vue'
import TodoPage from '../vue/Todos/TodoPage.vue'

// Define routes
const routes = [
  {
    path: '/login',
    component: LoginPage,
  },
  {
    path: '/register',
    component: RegisterPage,
  },
  {
    path: '/home',
    component: HomePage,
  },
  {
    path: '/todos',
    name: 'Todos',
    component: TodoPage,
  }
]

// Create the router instance
const router = createRouter({
  history: createWebHashHistory(),
  routes,
})

export default router
