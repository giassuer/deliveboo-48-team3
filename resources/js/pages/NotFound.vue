<template>
    <div class="not-found-wrapper">
        <div class="container">
            <div class="text-wrapper">
                <div class="code-wrapper">
                    404
                </div>

                <div class="sorry-wrapper">
                    Spiacenti, non abbiamo trovato nessun risultato per la tua ricerca.
                </div>

                <div class="button-wrapper">
                    <router-link class="nav-link text-decoration-none fs-3 text-white" :to="{name:'home'}"><span class="return_home">HOMEPAGE</span></router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'NotFound',
}
</script>

<style lang="scss" scoped>

.not-found-wrapper {
    padding: 300px 0 120px 0;
    background-image:linear-gradient(rgba(0, 0, 0, .4), 
      rgba(0, 0, 0, .4)), url('../../assets/img/empty-dish.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: white;
    text-align: center;

    .text-wrapper {
        .code-wrapper {
            font-size: 100px;
            font-weight: 500;
        }

        .sorry-wrapper {
            font-size: 32px;
        }

        .button-wrapper {
            background-color: transparent;
            border: 3px solid white;
            display: inline-block;
            padding: 5px 20px;
            font-weight: bold;
            margin-top: 150px;
            cursor: pointer;
        }
    }
}

</style>