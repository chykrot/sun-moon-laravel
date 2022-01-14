window.Vue = require('vue').default;
import Router from 'vue-router'
import Login from '../components/Login.vue'
import Dashboard from '../components/Dashboard.vue'
import AuthService from '../services/auth'

window.Vue.use(Router)

export const constantRoutes = [
  {
    path: '/login',
    component: Login,
  },

  {
    path: '/',
    component: Dashboard,
  }
]


const createRouter = () => new Router({
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes,
  mode: 'history'
})

const router = createRouter()

router.beforeEach((to, from, next) => {

  if ( to.path === '/login' && AuthService.getAuth() ) {
    next('/')
  }

  next()
})

export function resetRouter() {
  const newRouter = createRouter()
  router.matcher = newRouter.matcher // reset router
}

export default router