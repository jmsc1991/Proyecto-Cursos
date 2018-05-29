<template>
    <fade-transition>
        <div>
            <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(/template/images/big_image_1.jpg);">
                <div class="container">
                    <div class="row align-items-center site-hero-inner justify-content-center">
                        <div class="col-md-8 text-center">
                            <div class="mb-5">
                                <h1>Cursos y Video Tutoriales Online</h1>
                                <p class="lead">Hazte miembro VIP para tener acceso a todos nuestros cursos y videos de forma ilimitada</p>
                                <p><a href="#" class="btn btn-primary">Conseguir VIP</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="site-section">
                <div class="container">
                    <section class="school-features text-dark d-flex">
                        <div class="inner">
                            <div class="media d-block feature">
                                <div class="icon"><span class="flaticon-video-call"></span></div>
                                <div class="media-body">
                                    <h3 class="mt-0">Instructores Expertos</h3>
                                    <p>Aprenda de una forma sencilla con los mejores Profesores Online.</p>
                                </div>
                            </div>

                            <div class="media d-block feature">
                                <div class="icon"><span class="flaticon-student"></span></div>
                                <div class="media-body">
                                    <h3 class="mt-0">Aprende en cualquier parte del mundo</h3>
                                    <p>Podras aprender con nuestros cursos online en cualquier parte del mundo.</p>
                                </div>
                            </div>

                            <div class="media d-block feature">
                                <div class="icon"><span class="flaticon-video-player-1"></span></div>
                                <div class="media-body">
                                    <h3 class="mt-0">Videos creativos y practicos</h3>
                                    <p>Con nuestros cursos aprenderas de una forma creatica y practica.</p>
                                </div>
                            </div>


                            <div class="media d-block feature">
                                <div class="icon"><span class="flaticon-audiobook"></span></div>
                                <div class="media-body">
                                    <h3 class="mt-0">Audio learning</h3>
                                    <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati, voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            <!-- END section -->

            <section class="site-section bg-light">
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-7 text-center">
                            <h2>Top Cursos</h2>
                            <p class="lead">Una lista de nuestros mejores cursos y video tutoriales.</p>
                        </div>
                    </div>
                    <div class="row top-course">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12" v-for="curso in cursos">
                            <router-link :to="{ name: 'curso', params: { id: curso.id } }" class="course">
                                <img :src="curso.foto" alt="Image placeholder" v-if="curso.foto">
                                <img src="template/images/img.png" alt="Image placeholder" v-if="!curso.foto">
                                <h2>{{ curso.titulo }}</h2>
                                <p>{{ curso.categoria }}</p>
                                <h2>{{ curso.precio }}€</h2>
                            </router-link>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </fade-transition>
</template>

<script>
    import axios from 'axios';

    import {FadeTransition} from 'vue2-transitions'

    export default {
        data() {
            return {
                cursos: null,
            }
        },
        created() {
            this.getCursos();
        },
        methods: {
            getCursos: function() {
                axios.get('data/cursos/top').then(response => {
                    this.cursos = response.data.data;
                }).catch(error => {

                })
            }
        },
        components: {
            FadeTransition
        }
    }
</script>