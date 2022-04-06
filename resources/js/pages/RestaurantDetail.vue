<template>
  <div class="bg-color">
    <div class="restaurant-detail">
      <HeaderRestaurant />
      <div class="container-fluid px-md-5">
        <div class="margin-top-120">
          <div v-if="!isCheckout" class="container-fluid">
            <div class="d-flex page_titles justify-content-center">
              <h2>I Piatti</h2>
            </div>
            <div class="row w-100">
              <div class=" col-6 col-md-3 d-flex flex-column align-items-center cart-position">
                <div class="text-center cart-modal-container">
                  <div class="col-6 col-md-3 d-flex flex-column align-items-center">
                    <div class="text-center cart-modal-container">
                      <div  v-if="shoppingCart.length > 0" class="mw-100">
                        <ModalCart :shoppingCart="shoppingCart" :totalPrice="totalPrice" />
                        <div class="d-flex justify-content-between">
                          <a class="btn btn-success mt-3 mr-4" @click="showCheckoutComp">
                            Checkout
                          </a>
                          <button class="btn btn-danger mt-3 ml-3" @click="clearLocalStorage">
                            Svuota
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class=" col-8 col-lg-9 col-xl-10 d-flex justify-content-around flex-wrap ">
                <div class="  col-10 col-md-5 col-xl-3 mx-xl-1 mb-5 d-flex flex-wrap justify-content-around " v-for="(dish, index) in dishes" :key="dish.id + index">
                  <div class="card">
                    <div class="card-img">
                      <img :src="dish.path_img" alt="">
                    </div>
                    <div class="description-wrap mw-100 text-center">
                      <div class="description">
                        <h5 class="plate-name">{{ dish.name }}</h5>
                        <p class="plate-description">{{ dish.description }}</p>
                        <div
                          class=" plate-quantity-menu d-flex align-items-center justify-content-around flex-wrap ">
                          <a class=" btn btn-danger quantity-btn quantity-btn-negative " v-if="dish.quantity && shoppingCart.length > 0" @click="removePlateToCart(dish, index)"> - </a>
                          <span v-else class="px-4 px-lg-3 replacer">.</span>
                          <p class="plate-quantity" v-if="shoppingCart.length === 0" >
                            0
                          </p>
                          <p v-else class="plate-quantity">{{ dish.quantity }}</p>
                          <a class=" btn btn-success quantity-btn quantity-btn-positive " @click="addPlateToCart(dish)">+</a>
                        </div>
                        <p class="plate-price">{{ dish.price }} €</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <Checkout v-if="isCheckout" :shoppingCart="shoppingCart" :totalPrice="totalPrice" :restaurant="restaurant" />
          </div>
        </div>
      </div>
      <Footer />
    </div>
  </div>
</template>
<script>
import ModalCart from "../components/ModalCart.vue";
import Checkout from "../components/Checkout.vue";
import HeaderRestaurant from "../components/HeaderRestaurant.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "Cart",
  components: {
    ModalCart,
    Checkout,
    HeaderRestaurant,
    Footer
  },
  data() {
    return {
      baseUri: "http://127.0.0.1:8000/api",
      restaurant: [],
      prevRestaurant: [],
      dishes: [],
      shoppingCart: [],
      isCheckout: false,
      isLoading: false,
      totalPrice: 0,
      imgURL: "../storage/",
      test: [],
      sum: 0
    };
  },
  methods: {
    getRestaurantAndPlatesFromApi(dinamicParam) {
      this.isLoading = true;
      axios
        .get(`${this.baseUri}${dinamicParam}`)
        .then((res) => {
          this.restaurant = res.data.restaurant;
          this.dishes = res.data.dishes;
          this.dishes.forEach(dish => {
            dish.price = parseFloat(dish.price);
          });
          if(this.prevRestaurant.restaurant_name !== this.restaurant.restaurant_name) {
            this.clearLocalStorage();
            console.log(localStorage);
          }
        });
    },
    addPlateToCart(dish) {
      if (!this.shoppingCart.includes(dish)) {
        this.shoppingCart.push(dish);
        dish.quantity = 1;
        this.totalPrice = this.totalPrice + dish.price;
        
      } else {
        dish.quantity++;
        this.totalPrice = this.totalPrice + dish.price;
      }
      this.saveCartInLocalStorage();
    },
    removePlateToCart(dish, index) {
      dish.quantity--;
      if (this.shoppingCart.includes(dish) && dish.quantity > 0) {
        this.totalPrice = this.totalPrice - dish.price;
      } else {
         this.shoppingCart.splice(this.shoppingCart.indexOf(dish), 1);
        this.totalPrice = this.totalPrice - dish.price;
      }
      this.saveCartInLocalStorage();
    },
    // LOCAL STORAGE
    saveCartInLocalStorage() {
      this.prevRestaurant = this.restaurant;
      let serializedShoppingCart = JSON.stringify(this.shoppingCart);
      let serializedTotalPrice = JSON.stringify(this.totalPrice);
      let serializedRestaurant = JSON.stringify(this.prevRestaurant);
      localStorage.setItem("cart", serializedShoppingCart);
      localStorage.setItem("amount", serializedTotalPrice);
      localStorage.setItem("restaurant", serializedRestaurant);
    },
    clearLocalStorage() {
      this.shoppingCart = [];
      this.totalPrice = 0;
      localStorage.setItem("cart", JSON.stringify(this.shoppingCart));
      localStorage.setItem("amount", JSON.stringify(this.totalPrice));
    },
    showCheckoutComp() {
      if (this.shoppingCart.length > 0) {
        this.isCheckout = true;
      }
    },
  },
  created() {
    let url = window.location.href;
    url = new URL(url);
    let dinamicParam = url.pathname;
    this.getRestaurantAndPlatesFromApi(dinamicParam);
    this.prevRestaurant = JSON.parse(localStorage.getItem("restaurant"));
    if (this.shoppingCart !== null && this.totalPrice !== null) {
      this.shoppingCart = JSON.parse(localStorage.getItem("cart"));
      this.totalPrice = JSON.parse(localStorage.getItem("amount"));
    }
  },
};
</script>

<style lang="scss">
@import "../../sass/app.scss";
body {
  margin: 0 !important;
}
.bg-color{
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
     
}
.margin-top-120{
  margin-top: 120px;
}
.cart-position{
  position: absolute;
  top: 325px;
  right: 0;
}
.restaurant-detail {
  // background-color: black;

  .card {
  margin-top: 100px;
  height: 221px;
  width: 221px;
  position: relative;
  background-color: white;
  // transition: all 0.3s ease-out;
  border-radius: 100%;
  overflow: hidden;
  background-color: #f3ba32;

}

.card-img{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.card-img img{
  width: 97%;
  height: 97%;
  border-radius: 100%;
  object-fit: cover;
  object-position: center;

}
.card .description-wrap {
  padding: 32px;
  position: relative;
  overflow: hidden;
}
.card .description {
  color: #7c2a02;
  text-align: center;
  position: relative;
  display: flex;
  flex-wrap: wrap;
  font-size: 15px;
}
.card .description > * {
  width: 100%;
  margin: 0;
}
.card .description h3 {
  margin: 0;
  font-size: 17px;
}
.card .description h4 {
  margin: 0;
}
.card:hover .card-img{
  display: none;
}
.description-wrap:hover{
  display: block;
}
.pro-pic {
  position: absolute;
  left: 50%;
  top: 2%;
  width: 100%;
  height: 100%;
  transform: translatex(-50%);
  background-size: cover;
  background-position: center center;
  transition: all 0.5s ease-out;
  transform: translate(-50%, 0%);
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 3px solid #7c2a02;
  overflow: hidden;
}
.pro-pic img{
  width: 100%;
  height: 100%;
}

.card:hover {
  cursor: pointer;
}
.pos-rel{
  position: relative;
}
.position-cart{
  position: absolute;
  top: 0;
  right: 0;
}

.cart-modal-container {
  width: 100%;
}
.cart-column {
  max-width: 100%;
  position: relative;
  .cart-fixer {
    width: 200px;
    top: 230px;
    left: calc(100% - 320px);
  }
}
.plate-name {
  font-size: 20px;
  font-family: "Montserrat", sans-serif;
  font-weight: 900;
}
.plate-description {
  font-size: 20px;
  margin: 0;
//   font-style: italic;
}
.plate-quantity {
  font-size: 60px;
  font-weight: 600;
}
.quantity-btn {
  font-size: 15px;
  border-radius: 50%;
}
.quantity-btn-positive {
  padding: 3px 12px;
}
.quantity-btn-negative {
  padding: 5px 15px;
}
.replacer {
  color: #FF5858;
}
@media screen and (max-width: 1199px) {
  .plate-description {
    display: none;
  }
}
@media screen and (max-width: 1340px) {
  .cart-column {
    .cart-fixer {
      left: calc(100% - 270px);
    }
  }
}
@media screen and (max-width: 700px) {
  .cart-column {
    .cart-fixer {
      left: calc(100% - 250px);
    }
  }
}
@media screen and (max-width: 600px) {
  .cart-column {
    .cart-fixer {
      left: calc(100% - 225px);
    }
  }
}
.plate-quantity-menu {
  display: flex;
  justify-content: space-around;
  align-content: center;
}
@media screen and (min-width: 768px) {
  .plate-quantity-menu {
    flex-direction: column;
    justify-content: center;
  }
  .plate-quantity,
  .plate-name {
    font-size: 20px;
  }
  .quantity-btn-positive,
  .quantity-btn-negative {
    margin: 10px 0;
    font-size: 20px;
  }
  .plate-description {
    font-size: 8px;
  }
  .quantity-btn-positive {
    padding: 1px 12px;
  }
  .quantity-btn-negative {
    padding: 3px 16px;
  }
}
@media screen and (min-width: 1200px) {
  .plate-quantity-menu {
    flex-direction: row;
    justify-content: space-around;
  }
  .plate-name {
    font-size: 20px;
  }
  .plate-quantity {
    font-size: 40px;
  }
  .quantity-btn {
    font-size: 15px;
  }
  .quantity-btn-positive {
    padding: 2px 11px;
  }
  .quantity-btn-negative {
    padding: 3px 14px;
  }
  .plate-description {
    font-size: 15px;
  }
}
}


</style>