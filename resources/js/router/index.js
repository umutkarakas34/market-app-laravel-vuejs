// router.js
import { createRouter, createWebHistory } from 'vue-router';
import ProductList from '../components/ProductList.vue';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Orders from '../components/Orders.vue';

const routes = [
    { path: '/', component: ProductList },
    { path: '/login', component: Login, meta: { requiresGuest: true } },
    { path: '/register', component: Register, meta: { requiresGuest: true } },
    { path: '/orders', component: Orders, meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isLoggedIn = !!localStorage.getItem('auth_token');

    if (to.meta.requiresAuth && !isLoggedIn) {
        next('/login'); // Giriş yapılmadıysa login sayfasına yönlendir
    } else if (to.meta.requiresGuest && isLoggedIn) {
        next('/'); // Giriş yapıldıysa ana sayfaya yönlendir
    } else {
        next(); // Normal olarak devam et
    }
});

export default router;
