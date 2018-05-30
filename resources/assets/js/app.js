import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './components/Layout'
import Home from './components/Home'
import Curso from './components/Curso'
import Video from './components/Video'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/curso/:id',
            name: 'curso',
            component: Curso,
            props: true
        },
        {
            path: '/curso/video/:id',
            name: 'video',
            component: Video,
            props: true
        }

    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});