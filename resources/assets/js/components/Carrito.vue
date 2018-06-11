<template>
    <div v-if="carrito">
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
        <!-- END section -->

        <section class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill">{{ carrito.productos.length }}</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed" v-for="item in carrito.productos">
                                <div>
                                    <h6 class="my-0">{{ item.titulo }}</h6>
                                    <a href="#" v-on:click.prevent="removeItem(item.id)">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </a>
                                </div>
                                <span class="text-muted">{{ item.precio }}€</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (EUR)</span>
                                <strong>{{ carrito.total }}€</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <form v-on:submit.prevent="comprar">
                            <h4 class="mb-3">Metodo de pago</h4>

                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" v-model="metodo" value="paypal" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">PayPal</label>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <PayPal
                v-if="finalizar"
                :amount="carrito.total"
                currency="EUR"
                :client="credentials"
                env="sandbox"
                v-on:payment-completed="completado"
        >
        </PayPal>
    </div>

</template>

<script>
    import axios from 'axios';

    import PayPal from 'vue-paypal-checkout'

    export default {
        data() {
            return {
                metodo: '',
                credentials: {
                    sandbox: 'AY5xySETsU2bI4SkCJsAwdeupNgMVgSDWiI9NeM_-Yy6C9DRtCLm0BYYKk1P0IRcy1kC__VOo5CEUF3n',
                },
                finalizar: false,
            }
        },
        watch: {
            '$route' (to, from) {
                this.$store.commit('getCarrito');
            }
        },
        created() {
            this.$store.commit('getCarrito');
        },
        computed: {
            carrito() {
                return this.$store.getters.getCarrito;
            }
        },
        methods: {
            removeItem: function(id) {
                axios.get('/data/carrito/remove/' + id).then(response => {
                    this.$store.commit('getCarrito');
                })
            },
            comprar: function() {
                if (! this.metodo) {
                    toastr.error('Selecciona un metodo de pago.')
                } else if (this.metodo == 'paypal') {
                    this.finalizar = true;
                }
            },
            completado: function() {
                axios.get('/data/carrito/comprar').then(response => {
                    toastr.success('completadooooo')
                })
            }
        },
        components: {
            PayPal
        }
    }
</script>

<style scoped>

</style>