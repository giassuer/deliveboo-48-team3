<template>
    <div class="banner">
        <div class="container-ms">
            <div class="row row-cols-1 row-cols-lg-2 align-items-center">
                <div class="col">
                    <div class="banner-text animate__animated animate__fadeInUp">
                    <h1>Il cibo 
                        <vue-typer
                            :text='["italiano","giapponese","fast food","messicano","che vuoi"]'
                            :repeat='Infinity'
                            :shuffle='false'
                            initial-action='typing'
                            :pre-type-delay='70'
                            :type-delay='70'
                            :pre-erase-delay='2000'
                            :erase-delay='100'
                            erase-style='backspace'
                            :erase-on-complete='false'
                            caret-animation='blink'
                        ></vue-typer>,<br>
                    <span class="ovunque">ovunque ti trovi</span>.</h1>

                    <p>Scegli tra un'ampia varietà di piatti e ristoranti,<br>
                    provvederemo alla consegna nel giro di qualche minuto!</p>

                        
                        
                        <!-- --------------------------------------------------------------------- -->
                        <!-- <div class="bg-white">
                            <div  v-if="filteredRestaurants.length > 0">
                                <p>{{filteredRestaurants.length - 1}} risultati trovati</p>
                            </div>
                            <div class="bg.white" v-else>
                                <p>nessun risultto trovato</p>
                            </div>
                        </div> -->
                        <!-- ---------------------------------------------------------------------- -->
                        
                    </div>
                </div>

                <div class="col d-none d-lg-block">
                    <div class="banner-logo animate__animated animate__fadeInRight">
                        <img src="../../assets/img/burger-4k.jpg" alt="Hamburger">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueTyper } from 'vue-typer'

export default {
    name: 'Banner',
    components: {
        VueTyper
    },
    data: function() {
        return {
            
            
            
        }
    },
   
    methods: {
       
        
    },
    created: function() {
        
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';

.banner {
    // background-image: url('../../assets/img/prova.jpg');
    background-color: #000103;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 80px 0;
    margin-top: 120px;
    position: relative;
    // box-shadow:inset 0 0 0 2000px rgba(0,0,0,0.5);

    .banner-text {
        h1 {
            color: #fec866;
            font-weight: 700;
            font-size: 50px;
            margin: 0 auto;
            letter-spacing: -2px;

            ::v-deep .typed {
                color: lighten(#7c2a02, 30%) !important;
            }

            .ovunque {
                color: lighten(#7c2a02, 30%);
                font-size: 70px;
            }
        }

        p {
            color: #c2c181;
            font-size: 22px;
            margin: 20px 0;
        }

        
    }

    .banner-logo {
        img {
            width: 800px;
            transform: scale(1.2);
        }
    }

// ----------
    .bg-white{
        background-color: white;
    }
// ----------
}
</style>