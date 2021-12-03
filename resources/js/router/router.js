import Vue from 'vue'
import VueRouter from 'vue-router'
import TheLogin from '../components/login/TheLogin';
import Parallex from '../components/Parallex';
import TheSignup from '../components/login/TheSignup';
import TheForum from '../components/forum/TheForum';
import TheLogout from '../components/login/TheLogout';
import QuestionDetail from "../components/forum/QuestionDetail";
import CreateQuestion from "../components/forum/CreateQuestion";
import CreateCategory from "../components/category/CreateCategory";

Vue.use(VueRouter)

const routes = [
    { name:'Login', path: '/login', component: TheLogin },
    { name:'home', path: '/', component: Parallex },
    { name:'Signup', path: '/signup', component: TheSignup },
    { name:'Logout', path: '/logout', component: TheLogout },
    { name:'Forum', path: '/forum', component: TheForum },
    { path: '/question/:questionSlug', component: QuestionDetail, props:true },
    { path: '/ask', component: CreateQuestion },
    { path: '/category', component: CreateCategory },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

export default router;


