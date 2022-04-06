<template>
  <div>
    <div class="container mt-3">
      <div class="d-flex">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 cart-position-check">
          <ModalCart
            class="mt-5 text-center"
            :shoppingCart="shoppingCart"
            :totalPrice="totalPrice"
          />
        </div>
        <div v-if="form" class="form col-xl-10 col-lg-9 col-md-8 col-sm-7 ml-5 form-margin">
          <h2 class="text-center orange_text">Inserisci i tuoi dati</h2>
          <div class="mb-1">
            <label for="name"></label>
            <input
              type="text"
              placeholder="Nome..."
              id="name"
              v-model="name"
            />
          </div>
          <div class="mb-1">
            <label for="Surname"></label>
            <input
              type="text"
              placeholder="Cognome..."
              id="Surname"
              v-model="lastname"
            />
          </div>
          <div class="mb-1">
            <label for="Address"></label>
            <input
              type="text"
              placeholder="Indirizzo..."
              id="Address"
              v-model="address"
            />
          </div>
          <div class="mb-1">
            <label for="email" class="form-label"></label>
            <input
              type="email"
              id="email"
              aria-describedby="emailHelp"
              placeholder="Email.."
              v-model="email"
            />

          </div>
          <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-primary" type="submit" @click="createOrder">
              Crea Ordine
            </button>
            <a
              @click="clearLocalStorage"
              class="btn btn-danger"
              :href="`http://127.0.0.1:8000/restaurants/${restaurant.slug}`"
              >Cancella ordine</a
            >
          </div>
        </div>
        <div class="form col-xl-10 col-lg-9 col-md-8 col-sm-7 ml-5">
          <div v-if="payment" class="payment">
            <v-braintree
              :authorization="token"
              @success="onSuccess"
              @error="onError"
              locale="it_IT"
              :card="{
                cardholderName: {
                  required: true,
                },
              }"
            ></v-braintree>
          </div>
          <Thanks v-if="thanks" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Thanks from "./Thanks.vue";
import ModalCart from "./ModalCart.vue";
export default {
  name: "Checkout",
  components: {
    ModalCart,
    Thanks,
  },
  props: ["shoppingCart", "totalPrice", "restaurant"],
  data() {
    return {
      token: "",
      order_id: "",
      name: "",
      lastname: "",
      phone: "",
      email: "",
      address: "",
      order: {},
      form: true,
      payment: false,
      thanks: false,
    };
  },
  methods: {
    clearLocalStorage() {
      this.shoppingCart = [];
      this.totalPrice = 0;
      localStorage.setItem("cart", JSON.stringify(this.shoppingCart));
      localStorage.setItem("amount", JSON.stringify(this.totalPrice));
    },
    showConsoleLog(cart, amount) {
      console.log(cart);
      console.log(amount);
    },
    onSuccess(payload) {
      let nonce = payload.nonce;
      axios({
        method: "post",
        url: "http://127.0.0.1:8000/api/payments",
        data: {
          token: nonce,
          id: this.orderId,
        },
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
      }).then((res) => {
        this.payment = false;
        this.thanks = true;
        this.clearLocalStorage();
        console.log(res);
      });
    },
    onError(error) {
      let message = error.message;
      console.log(message);
    },
    createOrder() {
      // user info
      let order = {
        name: this.name,
        lastname: this.lastname,
        address: this.address,
        email: this.email,
        amount: this.totalPrice,
        status: false,
      };
      let ogg = {};
      this.shoppingCart.forEach((el) => {
        ogg[el.id] = el.quantity;
      });
      console.log(ogg);
      order.order_details = ogg;
      this.order = order;
      console.log("ordine:  ", this.order);
      //  this.isLoading = true;
      setTimeout(() => {
        axios;
        axios({
          method: "post",
          url: "http://127.0.0.1:8000/api/orders",
          data: this.order,
        })
          .then((res) => {
            console.log(res);
            this.orderId = res.data.Order_number;
            this.form = false;
            this.payment = true;
          })
          .catch((error) => {
            console.log(error.response.data);
          })
          .then(() => {
            // this.isLoading = false;
          });
      }, 2500);
      // order complete
      this.order = order;
    },
    getTokenFromApi() {
      axios
        .get("http://127.0.0.1:8000/api/payments")
        .then((res) => {
          this.token = res.data.token;
        })
        .catch()
        .then(() => {
          // this.isLoading = false;
        });
    },
  },
  created() {
    
    // this.showConsoleLog(this.shoppingCart, this.totalPrice);
    this.getTokenFromApi();
  },
};
</script>

<style lang="scss">
@import "../../sass/app.scss";
.cart-position-check{
  position: relative;
  top: -15px;
}
.orange_text{
  color:$page_other_color;
}
.form-margin{
  margin: 50px 0;
}
.payment{
  margin-bottom: 40px;
}
input{
  background: transparent;
  border: none;
  color: $page_other_color;
  border-bottom: 1px solid $page_other_color;
  width: 100%;
  padding-bottom: 10px;
  outline:0;
}
input::placeholder{
  color: $page_other_color;
  
}
// .braintree-sheet {
//     background-color: $page_other_color;
//     border: 1px solid $page_secondary_color;
// }
// .braintree-sheet__header .braintree-sheet__text {
//     color: $page_secondary_color;
// }
// .braintree-sheet__content--form .braintree-form__field-group .braintree-form__label {
//     color: $page_secondary_color;
// }

// .braintree-sheet__content--form::placeholder .braintree-form__field-group::placeholder .braintree-form__label::placeholder {
//   color: $page_secondary_color;
// }
// .braintree-sheet__header {
//     border-bottom: 1px solid $page_secondary_color;
// }
</style>