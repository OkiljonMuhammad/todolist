import { createRouter, createWebHashHistory } from 'vue-router'

import LoginPage from '../vue/Authentication/Login/LoginPage.vue'
import RegisterPage from '../vue/Authentication/Register/RegisterPage.vue'
import HomePage from '../vue/Home/HomePage.vue'
import TodoPage from '../vue/Todos/TodoPage.vue'
import DashboardPage from '../vue/Dashboard/DashboardPage.vue'
import LogoutPage from '../vue/Authentication/Logout/LogoutPage.vue'

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
    path: '/logout',
    component: LogoutPage,
  },
  {
    path: '/home',
    component: HomePage,
  }, 
  {
    path: '/dashboard',
    component: DashboardPage,
    meta: {requiresAuth: true}
  },
  {
    path: '/todos',
    name: 'Todos',
    component: TodoPage,
    meta: {requiresAuth: true}
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token'); 
  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next('/login'); 
  } else {
    next();
  }
})
export default router
