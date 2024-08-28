require('./bootstrap');
import { createApp } from 'vue';
import router from './router';

import Navbar from './components/Navbar.vue';
import ProductList from './components/ProductList.vue';
import Orders from './components/Orders.vue';
import Footer from './components/Footer.vue';

const app = createApp({});

app.component('navbar-component', Navbar);
app.component('product-list-component', ProductList);
app.component('order-component', Orders);
app.component('footer-component', Footer);

app.use(router);

app.mount('#app');
