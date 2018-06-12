<template>
    <div v-if="user">
        <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(/template/images/big_image_1.jpg);">
            <div class="container">
                <div class="row align-items-center site-hero-inner justify-content-center">
                    <div class="col-md-8 text-center" v-if="user">
                        <div class="mb-5" v-if="user.vip == false">
                            <h1>Cursos y Video Tutoriales Online</h1>
                            <p class="lead">Hazte miembro VIP para tener acceso a todos nuestros cursos y videos de forma ilimitada</p>
                            <p><a href="#" class="btn btn-primary">Conseguir VIP</a></p>
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
                            <p><a href="#" class="btn btn-primary">Conseguir VIP</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">{{ user.name }}</h3>

                                <ul class="list-group list-group-unbordered mb-3" v-if="cursos">
                                    <li class="list-group-item">
                                        <b>Cursos</b> <a class="float-right">{{ cursos.length }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Subscripcion</b>
                                        <a class="float-right" v-if="user.vip != false">VIP</a>
                                        <a class="float-right" v-if="user.vip == false">Gratuita</a>
                                    </li>
                                    <li class="list-group-item" v-if="user.vip != false">
                                        <b>Dias restantes</b>
                                        <a class="float-right" v-if="user.vip != false">{{ user.vip }}</a>
                                        <a class="float-right" v-if="user.vip == false">0</a>
                                    </li>
                                    <li class="list-group-item" v-if="user.vip == false">
                                        <button class="btn btn-xs btn-primary">Comprar VIP</button>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-book mr-1"></i> Email</strong>

                                <p class="text-muted">
                                    {{ user.email }}
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div v-if="cursos">
                            <div class="card card-primary mt-3" v-if="cursos.length > 0">
                                <div class="card-header">
                                    <h3 class="card-title">Mis Cursos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div v-for="curso in cursos">
                                        <router-link :to="{ name: 'curso', params: { id: curso.id } }">
                                            <strong><i class="fa fa-play mr-1"></i> {{ curso.title }}</strong>

                                            <p class="text-muted">
                                                {{ curso.excerpt }}
                                            </p>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
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
        created () {
            this.getCursos();
        },
        methods: {
            getCursos: function() {
                axios.get('/data/user/cursos').then(response => {
                    this.cursos = response.data;
                })
            }
        },
        computed: {
            user () {
                return this.$store.getters.getUser;
            },
        }
    }
</script>

<style scoped>

</style>