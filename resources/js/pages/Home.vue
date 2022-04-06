<template>
    <div class="home">
        <Banner />
        <!-- {{getFilteredRestaurants()}} -->
        <!-- <Categories /> -->
        <Restaurant />
    </div>
</template>

<script>
import Banner from '../components/Banner.vue';
// import Categories from './Categories.vue';
import Restaurant from '../components/Restaurant.vue';

export default {
    name: 'Home',
    components: {
        Banner,
        // Categories,
        Restaurant
    },
    data:function(){
        return{
            filteredRestaurants: [],
            searchBar:'',
            allRestaurants: [],

        }
    },
      methods:{
         getAllRestaurants() {
            axios.get('http://127.0.0.1:8000/api/restaurants')
            .then((response) => {
                this.allRestaurants = response.data;
                // console.log(this.allRestaurants);
            });
        },
    
        
    },
    computed:{
         
    },

  
    created:function(){
        this.getAllRestaurants();
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';


</style>