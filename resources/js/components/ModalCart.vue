<template>
  <div>
    <div class="ck">
      <div class="quantity-indicator">
        {{ getQuantityTotal() }}
      </div>
      <div>
        <h4>
          <i class="fas fa-cart-arrow-down pt-4 bg-gradient-secondary"></i>
          Carrello
        </h4>
      </div>
      <hr />
      <ul v-for="item in shoppingCart" :key="item.id">
        <div class="d-flex justify-content-between align-items-center px-3">
          <li v-if="item.quantity">
            {{ item.name }}
          </li>
          <li v-if="item.quantity">
            {{ item.quantity }}
          </li>
        </div>
        <hr />
      </ul>
      <h4 class="card-header font-weight-bold">Totale: € {{totalPrice.toFixed(2) == 0 ? 0 : totalPrice.toFixed(2) }}</h4>
    </div>
  </div>
</template>

<script>
export default {
  name: "ModalCart",
  props: ["shoppingCart", "totalPrice"],
  methods: {
    getQuantityTotal(){
      let sum = 0;
      if(this.shoppingCart.length){
        for (let i = 0; i < this.shoppingCart.length; i++){
            sum += this.shoppingCart[i].quantity;
        };
      }
      return sum;
    },
  },
};
</script>

<style scoped lang="scss">
@import "../../sass/app.scss";
.shopping-cart {
  width: 100%;
  max-width: 100%;
}
.ck {
  height: auto;
  // color: white;
  width: 200px;
  background-color: $page_secondary_color;
  border-radius: 20px;
  -webkit-box-shadow: -2px 5px 11px 0px rgba(64, 64, 64, 0.62);
  box-shadow: -2px 5px 11px 0px rgba(64, 64, 64, 0.62);
  position: relative;
  ul {
    list-style-type: none;
  }
  .quantity-indicator{
    position: absolute;
    top: -10px;
    left: -10px;
    height: 45px;
    width: 45px;
    font-size: 20px;
    border-radius: 50%;
    background-color: $page_other_color;
    border: 2px solid $page_secondary_color;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>