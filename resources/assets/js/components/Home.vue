<template>
    <div>
        <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(/template/images/big_image_1.jpg);">
            <div class="container">
                <div class="row align-items-center site-hero-inner justify-content-center">
                    <div class="col-md-8 text-center" v-if="user">
                        <div class="mb-5" v-if="user.vip == false">
                            <h1>Cursos y Video Tutoriales Online</h1>
                            <p class="lead">Hazte miembro VIP para tener acceso a todos nuestros cursos y videos de forma ilimitada</p>
                            <p><router-link :to="{ name: 'vip' }" class="btn btn-primary">Conseguir VIP</router-link></p>
                        </div>
                        <div class="mb-5" v-if="user.vip != false">
                            <h1>Cursos y Video Tutoriales Online</h1>
                            <p class="lead">Haz click aquí para ver todos los cursos disponibles</p>
                            <p><router-link :to="{ name: 'cursos' }" class="btn btn-primary">Cursos</router-link></p>
                        </div>
                    </div>
                    <div class="col-md-8 text-center" v-if="!user">
                        <div class="mb-5">
                            <h1>Cursos y Video Tutoriales Online</h1>
                            <p class="lead">Hazte miembro VIP para tener acceso a todos nuestros cursos y videos de forma ilimitada</p>
                            <p><a href="/login" class="btn btn-primary">Conseguir VIP</a></p>
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
                        <div v-if="user">
                            <button v-if="user.vip == false" class="btn btn-success" v-on:click="add(curso.id)">Añadir al Carrito</button>
                            <router-link v-if="user.vip != false" class="btn btn btn-success" :to="{ name: 'curso', params: { id: curso.id } }">Ver Curso</router-link>
                        </div>
                        <div v-if="!user">
                            <a href="/login" class="btn btn-xs btn-success">Añadir al Carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                cursos: null,
            }
        },
        watch: {
            '$route' (to, from) {
                this.getCursos();
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
            },
            add: function(id) {
                if (this.user) {
                    axios.get('/data/carrito/add/' + id).then(response => {
                        console.log(response.data);
                        if (response.data == 'ok') {
                            this.$store.commit('getCarrito');
                            toastr.success('Curso añadido al carrito!')
                        } else if (response.data == 'repetido') {
                            toastr.error('Este curso ya se encuentra en tu carrito.')
                        }
                    })
                } else {
                    toastr.error('Tienes que estar registrado para poder comprar cursos.')
                }
            }
        },
        computed: {
            user () {
                return this.$store.getters.getUser;
            }
        }
    }
</script>