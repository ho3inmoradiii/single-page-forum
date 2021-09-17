import Vue from 'vue'
import VueRouter from 'vue-router'
import TheLogin from '../components/login/TheLogin';

Vue.use(VueRouter)

const routes = [
    { path: '/login', component: TheLogin },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;


