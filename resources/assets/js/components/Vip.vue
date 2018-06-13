<template>
    <div v-if="user">
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
                            <span class="badge badge-secondary badge-pill">1</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Subscripcion VIP / 1 mes</h6>
                                </div>
                                <span class="text-muted">10€</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (EUR)</span>
                                <strong>10€</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-3">Metodo de pago</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" v-model="metodo" value="paypal" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button v-if="metodo == ''" class="btn btn-primary btn-lg btn-block">Finalizar Compra</button>
                        <PayPal
                                v-if="metodo == 'paypal'"
                                amount="10"
                                currency="EUR"
                                :button-style="myStyle"
                                :client="credentials"
                                env="sandbox"
                                v-on:payment-completed="completado"
                        >
                        </PayPal>
                    </div>
                </div>
            </div>
        </section>
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
                myStyle: {
                    label: 'checkout',
                    size:  'responsive',
                    shape: 'pill',
                    color: 'gold'
                },
            }
        },
        computed: {
            user() {
                return this.$store.getters.getUser;
            }
        },
        methods: {
            completado: function() {
                axios.get('/data/carrito/comprar/vip').then(response => {
                    this.$router.push({ path: '/' })
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