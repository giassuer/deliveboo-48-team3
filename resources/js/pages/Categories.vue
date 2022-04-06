<template>
    <div class="categories">
        <div class="container">
            <h2>Le nostre categorie</h2>
            <div v-for="category in categories" :key="category.id" >{{category.name}}</div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Categories',
    data:function(){
        return {
            categories:[]
        };
    },
    methods:{
        getCategories:function(){
            axios.get('/api/categories')
            .then((response) => {
                
                    this.categories = response.data.results;
                    // console.log(this.categories);
                
                // else{
                //     // this.$router.push({name:'not-found'});
                // }
            })
        },
        
    },
    created:function(){
        this.getCategories();
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';

.categories {
    background-color: $page_tertiary_color;
}
</style>

