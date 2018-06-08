import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        user: null,
        puedeVer: null,
        carrito: null,
    },
    mutations: {
        getUser: function (state) {
            axios.get('/data/user').then(response => {
                state.user = response.data;
            });
        },
        cerrarSesion: function (state) {
            state.user = null;
        },
        permiso: function (state, payload) {
            if (state.user) {
                axios.get('/data/user/puede/ver/' + payload).then(response => {
                    state.puedeVer = response.data;
                });
            }
        },
        getCarrito: function (state) {
            axios.get('/data/carrito').then(response => {
                state.carrito = response.data.data;
            })
        }
    },
    getters: {
        getUser: state => {
            return state.user;
        },
        getCarrito: state => {
            return state.carrito;
        }
    }
});