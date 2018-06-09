import Vue from 'vue'
import VueRouter from 'vue-router'
import Paginate from 'vuejs-paginate'
import Vuex from 'vuex'
import { store } from './Store'



Vue.use(Vuex)

Vue.use(VueRouter);

import axios from 'axios';

import App from './components/Layout'
import Home from './components/Home'
import Curso from './components/Curso'
import Video from './components/Video'
import Cursos from './components/Cursos'
import Categoria from './components/Categoria'
import About from './components/About'

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
        },
        {
            path: '/categoria/:id',
            name: 'categoria',
            component: Categoria,
            props: true
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
    ],
});

const app = new Vue({
    el: '#app',
    store: store,
    render: h => h(App),
    router,
});