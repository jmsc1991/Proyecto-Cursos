<template>
    <fade-transition>
        <div v-if="video">
            <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(/template/images/big_image_1.jpg);">
                <div class="container">
                    <div class="row align-items-center site-hero-inner justify-content-center">
                        <div class="col-md-8 text-center">
                            <div class="mb-5">
                                <h1>{{ video.titulo }}</h1>

                                <p><a href="#video" class="btn btn-primary">Ver Video</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END section -->

            <section class="site-section">
                <div class="container">
                    <div class="col-12">
                        <p>{{ video.descripcion }}</p>
                        <hr>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe
                                    class="embed-responsive-item"
                                    id="video"
                                    :src="video.url"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media"
                                    allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                </div>
            </section>

            <section class="site-section">
                <div class="container">
                    <div class="col-12" v-if="!responder">
                        <h1>Comentarios:</h1>
                        <div class="card">
                            <div class="card-body" v-for="comentario in video.comentarios">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                        <p class="text-secondary text-center">{{ comentario.fecha.date }}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <a class="float-left" href="#"><strong>{{ comentario.usuario.name }}</strong></a>
                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{{ comentario.comentario }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!video.comentarios[0]">
                            <p>Aun no hay ningun comentario.</p>
                        </div>
                        <br>
                        <button class="btn btn-primary" v-on:click="responder = true">Nuevo Comentario</button>
                    </div>
                    <div class="col-12" v-if="responder">
                        <h3>Nuevo Comentario:</h3>
                        <div class="form-group">
                            <textarea
                                    class="form-control"
                                    id="respuesta"
                                    rows="5"
                                    v-model="newComent"
                            ></textarea>
                        </div>
                        <button class="btn btn-success" v-on:click="comentar">Enviar</button>
                        <button class="btn btn-danger" v-on:click="cancelar">Cancelar</button>
                    </div>
                </div>
            </section>
        </div>
    </fade-transition>
</template>

<script>
    import {FadeTransition} from 'vue2-transitions'

    import axios from 'axios';

    export default {
        props: ['id'],
        data() {
            return {
                video: null,
                responder: null,
                newComent: '',
            }
        },
        created() {
            this.getVideo();
        },
        methods: {
            getVideo: function() {
                axios.get('/data/videos/' + this.id).then(response => {
                    this.video = response.data.data;
                })
            },
            cancelar: function() {
                this.responder = null;
                this.newComent = '';
            },
            comentar: function() {
                axios.post('/data/comentario/' + this.id, {
                    comentario: this.newComent,
                }).then(response => {
                    this.getVideo();
                    this.cancelar();
                })
            }
        },
        components: {
            FadeTransition
        }
    }
</script>

<style scoped>

</style>