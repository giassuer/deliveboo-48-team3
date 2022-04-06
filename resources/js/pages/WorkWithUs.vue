<template>
    <div class="work">
        <div class="container">
            <div class="work-wrapper">
                <h2>Lavora con Deliveboo</h2>
                <h3>Cosa offriamo</h3>
                <!-- <p>Siamo un team piccolo ma di <span class="highlighted">grande impatto</span> e in <span class="highlighted">forte crescita</span>, che cerca di trovare la risposta ad alcune delle domande più interessanti del giorno d'oggi. Siamo dinamici e sempre alla ricerca di nuove idee.</p>

                <p>Speriamo tu sia entusiasta quanto noi delle <span class="highlighted">opportunità</span> che abbiamo davanti e che tu possa unirti a noi e diventare parte integrante di questa esperienza davvero incredibile.</p> -->

                <!-- Food -->
                <div class="row row-cols-1 row-cols-lg-2 align-items-center my-5 animate__animated animate__fadeInLeft">
                    <!-- <div class="single-offer-wrapper food"> -->
                        <div class="col">
                            <div class="offer-image">
                                <img src="../../assets/img/food-min.jpg" alt="Food">
                            </div>
                        </div>

                        <div class="col">
                            <div class="offer-text">
                                <h4>Cibo</h4>
                                <p>Ordina il tuo cibo preferito tramite app</p>
                                <div class="arrow">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>

                <!-- Rider -->
                <div class="row row-cols-1 row-cols-lg-2 align-items-center my-5 animate__animated animate__fadeInRight animate__delay-1s">
                    <!-- <div class="single-offer-wrapper rider"> -->
                        <div class="col">
                            <div class="offer-text">
                                <h4>Corrieri</h4>
                                <p>Candidati come corriere</p>
                                <div class="arrow">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="offer-image">
                                <img src="../../assets/img/rider-min.jpg" alt="Rider">
                            </div>
                        </div>
                    <!-- </div> -->
                </div>

                <!-- Restaurant -->
                <div class="row row-cols-1 row-cols-lg-2 align-items-center my-5 animate__animated animate__fadeInLeft animate__delay-2s">
                    <!-- <div class="single-offer-wrapper restaurant"> -->
                        <div class="col">
                            <div class="offer-image">
                                <img src="../../assets/img/restaurant-min.jpg" alt="Restaurant">
                            </div>
                        </div>

                        <div class="col">
                            <div class="offer-text">
                                <h4>Ristoranti</h4>
                                <p>Registra il tuo ristorante</p>
                                <div class="arrow">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'WorkWithUs',
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';

.work {
    background-color: #000103;
    margin-top: 120px;
    padding: 50px 0;

    .container {
        .work-wrapper {
            h2 {
                color: #fec866;
                font-size: 46px;
                font-weight: 600;
                padding-bottom: 50px;
            }

            h3 {
                color: lighten(#7c2a02, 30%);
                font-size: 34px;
                font-weight: 600;
                margin-bottom: 30px;
            }

            p {
                color: #fec866;
                font-size: 22px;
                margin-bottom: 30px;
            }

            .highlighted {
                color: lighten(#7c2a02, 30%);
                font-weight: 600;
            }

            .offer-image {
                img {
                    border-radius: 10px;
                    cursor: pointer;
                }
            }

            .offer-text {
                h4 {
                    color: #7c2a02;
                    font-size: 30px;
                    font-weight: 600;
                }

                .arrow {
                    background-color: #7c2a02;
                    color: #fec866;
                    font-size: 20px;
                    width: 50px;
                    height: 50px;
                    line-height: 50px;
                    text-align: center;
                    border-radius: 50%;
                    cursor: pointer;
                    transition: 0.3s;

                    &:hover {
                        transform: translateX(10px);
                        transition: 0.3s;
                    }
                }
            }

            .br-10 {
                border-radius: 10px;
                border: 0.5px solid #fec866;
            }
        }
    }
}
</style>