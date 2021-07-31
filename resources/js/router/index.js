// import App from '../App.vue'
import Base from '../views/base/Base'
// import Login from '../components/auth/Login'
// import Register from '../components/auth/Register'
// import Logout from '../components/auth/Logout'

const routes = [
    { path: '/', name: 'home',  component: Base, props: (route) => ({ query: route, file: 'Home.vue' }) },
    { path: '/api_key', name: 'api-key',  component: Base, props: (route) => ({ query: route, file: 'ApiKey.vue' }) },
    { path: '/subscribers', name: 'subscribers',  component: Base, props: (route) => ({ query: route, file: 'Subscribers.vue' }) },
    // {path: '/register', name: 'register',  component: Register, meta: { requiresVisitor: true } },
    // {path: '/logout', name: 'logout',  component: Logout, meta: { requiresAuth: true } }
]

export default routes