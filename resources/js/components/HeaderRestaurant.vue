<template>
    <header>
        <nav class="navbar navbar-expand-lg align-items-center">
            <div class="menus d-flex align-items-center">
                <!-- Logo -->
                <div class="header-logo">
                    <img src="../../assets/img/fast-food.png" alt="Deliveboo Logo">
                </div>

                <!-- Desktop Menu -->
                <div class="collapse navbar-collapse align-items-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li v-for="(link,index) in navbar_menu" :key="index" class="nav-item active mx-3">
                            <a class="burger-link" :href="`${baseUrl}${link.name}`" active-class="active-link">{{link.label}} </a>
                        </li>
                    </ul>
                </div>

                <!-- Buttons Register/Login -->
                <div class="buttons d-none d-lg-block">
                    <button type="button" class="btn btn-warning">
                        <a href="http://127.0.0.1:8000/login">Accedi<span class="button-icon"><i class="fa-solid fa-right-to-bracket"></i></span></a>
                    </button>
                    <button type="button" class="btn btn-warning">
                        <a href="http://127.0.0.1:8000/register">Registrati<span class="button-icon"><i class="fa-solid fa-house"></i></span></a>
                    </button>
                </div>

                <!-- Burger Menu -->
                <div class="burger d-flex flex-column">
                    <Slide class="d-block d-lg-none burger-menu align-self-center" right
                    :isOpen="this.open"
                    :closeOnNavigation="true"
                    noOverlay
                    width="250"
                    >

                    <!-- Burger Links -->
                    <li v-for="(link,index) in navbar_menu" :key="index">
                        <a class="burger-link" :href="`${baseUrl}${link.name}`" active-class="active-link">{{link.label}} </a>
                    </li>
                    <div class="burger-buttons d-flex flex-column">
                        <!-- Burger Menu Buttons -->
                        <div class="single-burger-button">
                            <button type="button" class="btn btn-warning">Accedi<span class="button-icon"><i class="fa-solid fa-right-to-bracket"></i></span></button>
                        </div>
                        <div class="single-burger-button">
                            <button type="button" class="btn btn-warning">Registrati<span class="button-icon"><i class="fa-solid fa-house"></i></span></button>
                        </div>
                    </div>
                    </Slide>
                </div>
            </div>  
        </nav>
    </header>
</template>

<script>
import { Slide } from 'vue-burger-menu';

export default {
    name: 'Header',
    components: {
        Slide
    },
    // DATA
    data() {
        return {
            open: false,
            baseUrl: 'http://127.0.0.1:8000',
            navbar_menu:[
                {
                'name':'/',
                'label':'Home',
                },
                {
                'name':'/chi-siamo',
                'label':'Chi siamo',
                },
                {
                'name':'/lavora-con-noi',
                'label':'Lavora con noi',
                }
            ],
        };
    },
    // METHODS
    methods: {
        openMenu() {
            this.open = true;
        }
    }
}
</script>

<style lang="scss">
@import '../../sass/app.scss';

header {
    background-color: #000103;
    // color: black;
    padding: 20px;
    font-size: 20px;
    // text-transform: uppercase;
    width: 100%;
    border-bottom: 1px solid $page_secondary_color;
    position: fixed;
    top: 0;
    z-index: 1000;
    height: 120px;
    
    nav {
        width: 100%;

        .bm-burger-button {
        position: fixed;
        width: 40px;
        height: 25px;
        left: 36px;
        top: 36px;
        cursor: pointer;
        color: white;
        }

        .menus {
            width: 100%;

            .header-logo img {
                width: 60px;
            }
            .navbar-collapse {
                .navbar-nav {
                    flex-grow: 1;
                    justify-content: center;
                    .nav-item {
                        .nav-link {
                            color: #fec866;
                            transition: 0.3s;
                            font-size: 24px;
                            font-weight: 600;

                            &:hover {
                                color: white;
                                transition: 0.3s;
                                transform: translateY(-5px);
                            }
                        }
                    }
                }
            }
            .bm-burger-bars {
                background-color: #fec866;
            }

            .bm-menu {
                background-color: #7c2a02;
                border: 5px $page_secondary_color;
            }

            .burger-link {
                color: #fec866;
                transition: 0.3s;
                font-weight: 600;

                &:hover {
                    text-decoration: none;
                    transform: translateX(5px);
                    transition: 0.3s;
                    color: white;
                }
            }

            .burger-buttons {
                flex-grow: 1;
                justify-content: center;
                width:100%;
                margin-top: 300px;

                .single-burger-button {
                    display:inline-block;
                    margin: 10px 0;
                    width: 120px;

                    .btn {
                        background-color: #fec866;
                        color: #7c2a02;
                        border-radius: 20px;
                    }

                    .button-icon {
                        margin-left: 5px;
                    }
                }
            }

            .bm-item-list {
                margin-left: 5px;
            }

            .cross-style {
                position: absolute;
                top: 24px;
                left: 24px;
                cursor: pointer;
            }

            .bm-cross {
                background-color: #fec866;
            }

            .buttons {
                button {
                    margin: 0 2px;
                    padding: 5px 15px;
                    background-color: #fec866;
                    color: #7c2a02;
                    transition: 0.2s;
                    border-radius: 20px;
                    a{
                        color:inherit;
                        &:hover{
                            color:inherit;
                            text-decoration: none;
                        }
                    }

                    .button-icon {
                        margin-left: 5px;
                    }
                }
            }
        }
    }
}
</style>