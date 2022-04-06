<template>
    <div class="restaurant">
        <div class="container">
            <!-- SEARCHBAR -->
            <div class="searchbar-container animate__animated animate__fadeInUp animate_delay-5s">
                <h6>Cerca per ristorante o categoria</h6>
                <div class="input-group rounded">
                    <input @keyup="getFilteredRestaurants()" type="text" class="form-control rounded" placeholder="Cerca" v-model="inputText">
                </div>
                <!-- CHECKBOX -->
                <div class="check_container mt-2">
                    <div class="row row-cols-3">
                            <div class="col" v-for="category in categories" :key="category.id">  
                                <input type="checkbox" v-model="checkbox" :value="category.name">
                                <label>{{category.name}}</label>
                           </div>
                    </div>
                </div>
                <!-- END CHECKBOX -->
            </div>
            <!-- END SEARCHBAR -->
            <h2 class="text-center page_titles">I nostri ristoranti</h2>
            <div class="restaurant-wrapper ">
                <div class="d-flex justify-content-center flex-wrap" v-if="filteredRestaurants.length > 0" >
                    <div v-for="restaurant in filteredRestaurants" :key="restaurant.id" >
                        <!-- RESTAURANT CARD -->
                        <div class="card restaurant_cards mx-3 my-3" style="width: 18rem;" data-aos="fade-in" data-aos-duration="1000" data-aos-once="true">
                            <div class="card-body text-center p-0">
                                <div v-if="restaurant.path_img.includes('http')">
                                    <img :src="restaurant.path_img" class="card-img-top" :alt="restaurant.restaurant_name">
                                </div>
                                <div v-else>
                                    <img :src="`http://127.0.0.1:8000/storage/` + restaurant.path_img" class="card-img-top" :alt="restaurant.restaurant_name">
                                </div>  
                                <h5 class="card-title my-3">{{ restaurant.restaurant_name }}</h5>
                                <div class="decoration"></div>
                                <a class="btn restaurant_btn" :href="`http://127.0.0.1:8000/restaurants/${restaurant.slug}`"> Vai al ristorante</a>
                            </div>
                        </div>
                        <!-- END RESTAURANT CARD -->
                    </div>
                </div>
                <div class="d-flex justify-content-center flex-wrap" v-else-if="filteredRestaurants.length <= 0 && checkbox.length <= 0">
                    <div v-for="restaurant in restaurants" :key="restaurant.id" >
                        <!-- RESTAURANT CARD -->
                        <div class="card restaurant_cards mx-3 my-3" style="width: 18rem;" data-aos="fade-in" data-aos-duration="1000" data-aos-once="true">
                            <div class="card-body text-center p-0">
                                <div v-if="restaurant.path_img.includes('http')">
                                    <img :src="restaurant.path_img" class="card-img-top" :alt="restaurant.restaurant_name">
                                </div>
                                <div v-else>
                                    <img :src="`http://127.0.0.1:8000/storage/` + restaurant.path_img" class="card-img-top" :alt="restaurant.restaurant_name">
                                </div> 
                                <h5 class="card-title my-3">{{ restaurant.restaurant_name }}</h5>
                                <div class="decoration"></div>
                                <a class="btn restaurant_btn" :href="`http://127.0.0.1:8000/restaurants/${restaurant.slug}`"> Vai al ristorante</a>
                            </div>
                        </div>
                        <!-- END RESTAURANT CARD -->
                    </div>
                </div>
                <div class="d-flex justify-content-center flex-wrap" v-else>
                    {{ restaurantFilter() }}
                    <div v-for="(restaur, index) in filter" :key="index">
                        <!-- SINGLE RESTAURANT CARD -->
                        <div class="card restaurant_cards mx-3 my-3" style="width: 18rem;" data-aos="fade-in" data-aos-duration="1000" data-aos-once="true">
                            <div class="card-body text-center p-0">
                                <div v-if="restaur.path_img.includes('http')">
                                    <img :src="restaur.path_img" class="card-img-top" :alt="restaur.restaurant_name">
                                </div>
                                <div v-else>
                                    <img :src="`http://127.0.0.1:8000/storage/` + restaur.path_img" class="card-img-top" :alt="restaur.restaurant_name">
                                </div> 
                                <h5 class="card-title my-3">{{ restaur.restaurant_name }}</h5>
                                <div class="decoration"></div>
                                <a class="btn restaurant_btn" :href="`http://127.0.0.1:8000/restaurants/${restaur.slug}`"> Vai al ristorante</a>
                            </div>
                        </div>
                        <!-- END SINGLE RESTAURANT CARD -->
                    </div>
                                
                             
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Restaurant',
    data:function(){
        return {
            restaurants: [],
            categories: [],
            filteredRestaurants: [],
            filteredCategories: [],
            inputText: '',
            checkbox: [],
            filter: []
        };
    },
    methods: {
        
        searchAllRestaurants() {
        axios.get(`http://127.0.0.1:8000/api/restaurants`)
        .then((response) => {
          this.restaurants = response.data;
        })
        .catch(() => {});
        },
        searchAllCategory() {
        axios.get(`http://127.0.0.1:8000/api/categories`)
        .then((response) => {
          this.categories = response.data.results;
        })
        .catch(() => {});
        },
        getFilteredRestaurants() {
            this.filteredRestaurants = [];
            this.restaurants.forEach(restaurant => {
                    if(restaurant.restaurant_name.toLowerCase().includes(this.inputText.toLowerCase().trim()) && this.inputText.trim() !== '') {
                        this.filteredRestaurants.push(restaurant);
                    } 
                    return this.filteredRestaurants;
                });
                
        },
        
        restaurantFilter() {

// <div v-for="restaurant in restaurants" :key="restaurant.id" >
//                         <div v-for="category in restaurant.category" :key="category.id">
//                             <div v-if="checkbox.includes(category.name) ">
            this.filter = [];
            this.restaurants.forEach(restaurant => {
                restaurant.category.forEach(categ => {
                    if(this.checkbox.includes(categ.name) && !this.filter.includes(restaurant)) {
                        this.filter.push(restaurant);
                    }
                });
            });
        },
        
    },
    created:function(){
        this.searchAllRestaurants();
        this.searchAllCategory();
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';


.restaurant {
    // BACKGROUND COLOR
        position:relative;
        // background-color: lighten(#7c2a02, 40%);
         
        background: linear-gradient(67deg, #7c2a02, #121c19, #f3ba32);
        background-size: 600% 600%;

        -webkit-animation: AnimationName 23s ease infinite;
        -moz-animation: AnimationName 23s ease infinite;
        animation: AnimationName 23s ease infinite;
    

    @-webkit-keyframes AnimationName {
        0%{background-position:51% 0%}
        50%{background-position:50% 100%}
        100%{background-position:51% 0%}
    }
    @-moz-keyframes AnimationName {
        0%{background-position:51% 0%}
        50%{background-position:50% 100%}
        100%{background-position:51% 0%}
    }
    @keyframes AnimationName {
        0%{background-position:51% 0%}
        50%{background-position:50% 100%}
        100%{background-position:51% 0%}
    }
    // BACKGROUND COLOR

    .container {
        .searchbar-container {
            max-width: 400px;
            padding: 20px 20px 40px 20px;
            border-radius: 10px;

            background-color: darken(#fec866, 20%);
            position:absolute;
            top:-134px;
            left: 109px;
            @media (max-width: 1050px) { 
               top:-60px;
            }

            @media (max-width: 992px) { 
               top:-35px;
               left: 30px;
            }


            h6 {
                color: #7c2a02;
                font-size: 18px;
                font-weight: 600;
            }

            input {
                border: 2px solid $page_secondary_color;
            }

            span {
                background-color: #7c2a02;
                color: darken(#fec866, 20%);
                cursor: pointer;
            }
        }
        .restaurant-wrapper {
            display: flex;
            flex-wrap: wrap;
            padding-top:60px;

            .restaurant_cards {
            background-color: darken(#fec866, 20%);
            margin: 0;
            padding: 0;
            height: 300px;
            transition: 0.2s;

                h5 {
                    color: black;
                    text-transform: capitalize;
                    font-weight: 600;
                }

                p {
                    color: $page_other_color;
                }

                .card-body {
                    img {
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;
                        cursor: pointer;
                        height: 160px;
                    }
                }
            }
            .restaurant_cards:hover {
                transform: translateY(-10px);
                transition: 0.2s;
                cursor: pointer;
                box-shadow: -10px 10px 5px #fec866;
            }

            .restaurant_btn {
                padding: 5px 15px;
                background-color: lighten(#311706, 40%);
                color: #7c2a02;
                border-radius: 10px;
                
            }
        }
        
    }
}
</style>