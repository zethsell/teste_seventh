import {createRouter, createWebHistory} from 'vue-router'
import Login from '../views/Public/Login.vue'
import Registration from '../views/Public/Registration.vue'
import Home from '../views/Private/Home.vue'
import AccessLog from '../views/Private/AccessLog.vue'
import UserIndex from '../views/Private/Users/Index.vue'
import UserCreate from '../views/Private/Users/Create.vue'
import UserEdit from '../views/Private/Users/Edit.vue'

const routes = [
    /*
    * Public Pages
     */
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/registration',
        name: 'Registration',
        component: Registration
    },
    /**
     * Protected Pages
     */
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/access_logs',
        name: 'AccessLog',
        component: AccessLog
    },
    {
        path: '/users',
        name: 'UserIndex',
        component: UserIndex
    },
    {
        path: '/user/new',
        name: 'UserCreate',
        component: UserCreate
    },
    {
        path: '/user/:id/edit',
        name: 'UserEdit',
        component: UserEdit
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

router.beforeEach((to, from, next) => {
    const publicPages = ['/login', '/registration'];
    const admPages = ['/access_logs'];

    const authRequired = !publicPages.includes(to.path);
    const admRequired = admPages.includes(to.path);
    const loggedIn = JSON.parse(localStorage.getItem('user'));

    console.log(loggedIn)
    if (authRequired && !loggedIn) {
        next({name: 'Login'});
    } else {
        if (admRequired && !loggedIn.admin) {
            next({name: 'Home'});
        } else {
            next();
        }
    }
});

export default router
