import Vue from 'vue'
import VueRouter from 'vue-router'
import Paginate from 'vuejs-paginate'

Vue.use(VueRouter);

import App from './components/Layout'
import Home from './components/Home'
import Curso from './components/Curso'
import Video from './components/Video'
import Cursos from './components/Cursos'

Vue.component('paginate', Paginate)

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
        },
        {
            path: '/cursos',
            name: 'cursos',
            component: Cursos,
            props: true
        }

    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});