<template>

    <div v-if="curso">
        <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(/template/images/big_image_1.jpg);">
            <div class="container">
                <div class="row align-items-center site-hero-inner justify-content-center">
                    <div class="col-md-12">
                        <div class="mb-5">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h1 class="mb-0">{{ curso.titulo }}</h1>
                                    <p>By {{ curso.autor }}</p>
                                    <p class="lead mb-5">{{ curso.extracto }}</p>

                                    <p v-if="puedeVer"><a href="#series" class="btn btn-primary mr-2">Start Series</a></p>

                                    <p v-if="!puedeVer">
                                        <button class="btn btn-success" v-if="user" v-on:click="add(curso.id)">{{ curso.precio }}€ - Añadir al Carrito</button>
                                        <a href="/login" class="btn btn-success" v-if="!user">{{ curso.precio }}€ - Añadir al Carrito</a>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <img :src="curso.foto" alt="Image placeholder" v-if="curso.foto" class="img-fluid">
                                    <img src="/template/images/img.png" alt="Image placeholder" v-if="!curso.foto" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END section -->

        <section class="site-section">
            <div class="container">
                <div class="col-12">
                    <h1>¿Qué aprenderé?</h1>
                    <p>{{ curso.aprenderas }}</p>
                </div>
            </div>
        </section>

        <section class="site-section">
            <div class="container">
                <div class="col-12">
                    <h1>Requisitos:</h1>
                    <p>{{ curso.requisitos }}</p>
                </div>
            </div>
        </section>

        <section class="site-section episodes" id="series">
            <div class="container">
                <div class="row bg-light align-items-center p-4 episode" v-for="(video, index) in curso.videos">
                    <div class="col-md-3">
                        <span class="episode-number">{{ ++index }}</span>
                    </div>
                    <div class="col-md-9" v-if="video.free == 1">
                        <p class="meta">Episode {{ index }} / Video Gratuito</p>
                        <h2><router-link :to="{ name: 'video', params: { id: video.id } }">{{ video.titulo }}</router-link></h2>
                        <p>{{ video.descripcion }}</p>
                    </div>

                    <div class="col-md-9" v-if="video.free == 0 && !puedeVer">
                        <p class="meta">Episode {{ index }} / Este Video es privado, compra el curso o hazte VIP para poder verlo</p>
                        <h2>{{ video.titulo }}</h2>
                        <p>{{ video.descripcion }}</p>
                    </div>

                    <div class="col-md-9" v-if="video.free == 0 && puedeVer">
                        <p class="meta">Episode {{ index }}</p>
                        <h2><router-link :to="{ name: 'video', params: { id: video.id } }">{{ video.titulo }}</router-link></h2>
                        <p>{{ video.descripcion }}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- END section -->
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['id'],
        data() {
            return {
                curso: null,
                puedeVer: null,
            }
        },
        created() {
            this.getCurso();
            this.permiso();
        },
        methods: {
            getCurso: function() {
                axios.get('/data/cursos/ver/' + this.id).then(response => {
                    this.curso = response.data.data;
                })
            },
            permiso: function() {
                if (this.user) {
                    axios.get('/data/user/puede/ver/' + this.id).then(response => {
                        this.puedeVer = response.data;
                    });
                }
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

<style scoped>

</style>