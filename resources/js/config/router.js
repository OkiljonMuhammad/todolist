import { createRouter, createWebHashHistory } from 'vue-router'

import LoginPage from '../vue/Authentication/Login/LoginPage.vue'
import RegisterPage from '../vue/Authentication/Register/RegisterPage.vue'
import HomePage from '../vue/Home/HomePage.vue'
import TodoPage from '../vue/Todos/TodoPage.vue'
import DashboardPage from '../vue/Dashboard/DashboardPage.vue'

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
    path: '/dashboard',
    component: DashboardPage,
  },
  {
    path: '/todos',
    name: 'Todos',
    component: TodoPage,
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes,
})

export default router
