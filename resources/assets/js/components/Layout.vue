<template>
    <div>
        <header role="banner">
            <nav class="navbar navbar-expand-md navbar-dark bg-light">
                <div class="container">
                    <a class="navbar-brand absolute" href="#">Cursos DAW</a>
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
                                    <a class="dropdown-item" href="#" v-if="categorias" v-for="categoria in categorias">{{ categoria.nombre }}</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Acerca De</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacto</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav absolute-right">
                            <li class="nav-item" v-if="!user">
                                <a href="/login" class="nav-link">Entrar</a>
                            </li>
                            <li class="nav-item" v-if="!user">
                                <a href="#" class="nav-link">Registrarse</a>
                            </li>

                            <li class="nav-item dropdown" v-if="user">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ user.email }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown06">
                                    <a class="dropdown-item" href="#">Mis Cursos</a>
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
                user: null,
                categorias: null,
            }
        },
        created() {
            this.getUser();
            this.getCategorias();
        },
        methods: {
            getUser: function() {
                axios.get('/data/user').then(response => {
                    this.user = response.data;
                })
            },
            getCategorias: function() {
                axios.get('/data/categorias').then(response => {
                    this.categorias = response.data.data;
                })
            },
            cerrarSesion: function() {
                axios.post('/logout').then(response => {
                    this.user = null;
                    this.$router.push('/');
                });
            }
        },
        components: {
            FadeTransition
        }
    }
</script>