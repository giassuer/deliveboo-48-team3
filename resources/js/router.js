import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home.vue';
import About from './pages/About.vue';
import WorkWithUs from './pages/WorkWithUs.vue';
import NotFound from './pages/NotFound.vue';
import Categories from './pages/Categories.vue';


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/chi-siamo",
            name: "chi-siamo",
            component: About
        },
        {
            path: "/lavora-con-noi",
            name: "lavora-con-noi",
            component: WorkWithUs
        },
        // {
        //     path: "/restaurants/:slug",
        //     name: "restaurant.details",
        //     component: RestaurantDetail
        // },
        // {
        //     path: "/latest-news",
        //     name: "latest-news",
        //     component: LatestNews
        // },
        
        // {
        //     path: "/tags/:slug",
        //     name: "tag-details",
        //     component: TagDetails
        // },
        {
            path: "/categories",
            name: "categories",
            component: Categories
        },
        {
            path: "/*",
            name: "not-found",
            component: NotFound
        },
    ]
});

export default router;