<template>
    <div>
        <header role="banner">
            <nav class="navbar navbar-expand-md navbar-dark bg-light">
                <div class="container">
                    <router-link :to="{ name: 'home'}" class="navbar-brand absolute">Cursos DAW</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <router-link :to="{ name: 'home'}" class="nav-link">Inicio</router-link>
                            </li>
                            <li class="nav-item dropdown">
                                <router-link :to="{ name: 'cursos'}" class="nav-link">Cursos Online</router-link>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown05">
                                    <div v-for="categoria in categorias">
                                        <router-link class="dropdown-item" :to="{name: 'categoria', params: { id: categoria.id } }" v-if="categorias">{{ categoria.nombre }}</router-link>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'about'}">Acerca De</router-link>
                            </li>
                        </ul>
                        <ul class="navbar-nav absolute-right">
                            <li class="nav-item" v-if="! user">
                                <a href="/login" class="nav-link">Entrar</a>
                            </li>
                            <li class="nav-item" v-if="!user">
                                <a href="/register" class="nav-link">Registrarse</a>
                            </li>

                            <li class="nav-item dropdown" v-if="user && carrito">
                                <a class="nav-link dropdown-toggle" id="dropdown07"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-shopping-cart"></i><span class="badge badge-light">{{ carrito.productos.length }}</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdown07" v-if="carrito.productos.length > 0">

                                    <p class="dropdown-item" v-for="item in carrito.productos">
                                        <a href="#" v-on:click.prevent="removeItem(item.id)">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a> -- {{ item.titulo }} / {{ item.precio }}€
                                    </p>

                                    <p class="dropdown-item">Total: {{ carrito.total }}€</p>

                                    <router-link class="dropdown-item" :to="{name: 'carrito'}">Ver Carrito</router-link>
                                </div>

                                <div class="dropdown-menu" aria-labelledby="dropdown07" v-if="carrito.productos.length == 0">
                                    <p class="dropdown-item">
                                        El carrito esta vacio.
                                    </p>

                                </div>
                            </li>

                            <li class="nav-item dropdown" v-if="user">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ user.email }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown06">
                                    <router-link :to="{name: 'perfil'}" class="dropdown-item">Mis Cursos</router-link>
                                    <a class="dropdown-item" href="#" v-on:click.prevent="cerrarSesion">Cerrar Sesion</a>
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </header>
        <!-- END header -->
        <fade-transition>
            <router-view></router-view>
        </fade-transition>

        <footer class="site-footer" style="background-image: url(/template/images/big_image_3.jpg);">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-4">
                        <h3>Acerca de nosotros</h3>
                        <p> Cursos DAW es una web desarrollada por Alvaro y Jose, dedicada a la gestión de Cursos y Videos online. Realizada como proyecto de final de curso de DAW</p>
                    </div>
                    <div class="col-md-6 ml-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="list-unstyled">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Teachers</a></li>
                                    <li><a href="#">Courses</a></li>
                                    <li><a href="#">Categories</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END footer -->

        <!-- loader -->
    </div>
</template>

<script>
    import axios from 'axios';

    import {FadeTransition} from 'vue2-transitions'

    export default {
        data() {
            return {
                categorias: null,
            }
        },
        watch: {
            '$route' (to, from) {
                this.$store.commit('getUser');
                this.getCategorias();
            }
        },
        created() {
            this.$store.commit('getUser');
            this.getCategorias();
        },
        methods: {
            getCategorias: function() {
                axios.get('/data/categorias').then(response => {
                    this.categorias = response.data.data;
                })
            },
            cerrarSesion: function() {
                axios.post('/logout').then(response => {
                    this.$store.commit('cerrarSesion');-
                    this.$router.push('/');
                });
            },
            removeItem: function(id) {
                axios.get('/data/carrito/remove/' + id).then(response => {
                    this.$store.commit('getCarrito');
                })
            }
        },
        components: {
            FadeTransition
        },
        computed: {
            user () {
                return this.$store.getters.getUser;
            },
            carrito() {
                return this.$store.getters.getCarrito;
            }
        }
    }
</script>

<style>
    .fa-shopping-cart {
        font-size: 30px;
    }

</style>