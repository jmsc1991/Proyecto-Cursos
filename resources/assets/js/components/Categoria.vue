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
                            <p><a href="#cursos" class="btn btn-primary">Cursos</a></p>
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

        <section class="site-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center">
                        <h2 id="cursos">Cursos</h2>
                        <p class="lead"></p>
                    </div>
                </div>
                <div class="row top-course mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5" v-for="curso in cursos">
                        <router-link :to="{ name: 'curso', params: { id: curso.id } }" class="course">
                            <img :src="curso.foto" alt="Image placeholder" v-if="curso.foto" class="img-fluid">
                            <img src="/template/images/img.png" alt="Image placeholder" v-if="!curso.foto">
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
                <div class="d-flex justify-content-center">
                    <paginate
                            :page-count="pageCount"
                            :page-range="5"
                            :margin-pages="0"
                            :click-handler="clickCallback"
                            :prev-text="'Anterior'"
                            :next-text="'Siguiente'"
                            :container-class="'pagination'"
                            :page-class="'page-item'"
                            :prev-link-class="'btn btn-secondary'"
                            :next-link-class="'btn btn-secondary'"
                            :page-link-class="'btn btn-secondary'"
                    >
                    </paginate>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['id'],
        data() {
            return {
                cursos: null,
                pageCount: 0,
            }
        },
        created () {
            this.getCursos();
        },
        watch: {
            '$route' (to, from) {
                this.getCursos();
            }
        },
        methods: {
            getCursos: function() {
                axios.get('/data/categoria/' + this.id).then(response => {
                    this.cursos = response.data.data;
                    this.pageCount = response.data.meta.last_page;
                })
            },
            clickCallback: function(pageNum)  {
                axios.get('/data/categoria/' + this.id + '?page=' + pageNum).then(response => {
                    this.cursos = response.data.data;
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

<style scoped>

</style>