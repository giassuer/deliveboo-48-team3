<template>
    <div class="about">
        <div class="container">
            <div class="about-wrapper">
                <h2>Il nostro team</h2>
                <div class="row row-cols-1 row-cols-lg-3 mt-3">
                    <!-- Michael -->
                    <div class="col">
                        <div class="single-person animate__animated animate__fadeInLeft">
                            <div class="person-image">
                                <img src="../../assets/img/blob-michael.png" alt="Michael">
                            </div>

                            <div class="person-text">
                                <h3>Michael Scarantino</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Patrick -->
                    <div class="col">
                        <div class="single-person animate__animated animate__fadeInLeft animate__delay-1s">
                            <div class="person-image">
                                <img src="../../assets/img/blob-patrick.png" alt="Patrick">
                            </div>

                            <div class="person-text">
                                <h3>Patrick Galasso</h3> 
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tommaso -->
                    <div class="col">
                        <div class="single-person animate__animated animate__fadeInLeft animate__delay-2s">
                            <div class="person-image">
                                <img src="../../assets/img/blob-tommaso.png" alt="Tommaso">
                            </div>

                            <div class="person-text">
                                <h3>Tommaso Giannotta</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Gianluca -->
                    <div class="col">
                        <div class="single-person animate__animated animate__fadeInLeft animate__delay-3s">
                            <div class="person-image">
                                <img src="../../assets/img/blob-gianluca.png" alt="Gianluca">
                            </div>

                            <div class="person-text">
                                <h3>Gianluca Assuero</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dejan -->
                    <div class="col">
                        <div class="single-person animate__animated animate__fadeInLeft animate__delay-4s">
                            <div class="person-image">
                                <img src="../../assets/img/blob-dejan.png" alt="Dejan">
                            </div>

                            <div class="person-text">
                                <h3>Dejan Nikolic</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'About',
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';

.about {
    background-color: #000103;
    margin-top: 120px;
    padding: 50px 0;
    
    .container {
        .about-wrapper {
            h2 {
                color: #fec866;
                font-size: 46px;
                font-weight: 600;
                padding-bottom: 50px;
            }

            .single-person {
                margin: 10px 0;

                .person-text {
                    text-align: center;
                    margin-top: 10px;

                    h3 {
                        color: lighten(#7c2a02, 30%);
                        font-size: 36px;
                        margin-bottom: 50px;
                    }
                }
            }
        }
    }
}
</style>