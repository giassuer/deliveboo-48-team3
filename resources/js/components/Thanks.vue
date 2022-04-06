<template>
  <div>
    <div class=" container" >
      <div class="border-payment d-flex flex-column justify-content-center align-items-center ">
          <div class="payments_title">Pagamento avvenuto con successo.</div>
          <div class="payment_subtitle">Il tuo ordine arriverà entro : <span class="green">45</span> minuti</div>
          <div>
            <a class="btn-margin btn d-block btn-primary mt-1" href="http://127.0.0.1:8000/">Torna alla home</a>
          </div>
          <img src="../../assets/img/success.png" alt="success icon">
      </div>
      
    </div>
  </div>
</template>

<script>
export default {
  name: "Thanks",
  methods: {
    clearStoragein10Seconds() {
      setTimeout(() => {
        this.clearLocalStorage();
      }, 10000);
    },
    clearLocalStorage() {
      this.shoppingCart = [];
      this.totalPrice = 0;
      localStorage.setItem("cart", JSON.stringify(this.shoppingCart));
      localStorage.setItem("amount", JSON.stringify(this.totalPrice));
    },
  },
  created() {
    // this.clearStoragein10Seconds();
    // console.log(this.shoppingCart);
  },
};
</script>

<style scoped lang="scss">
@import '../../sass/app.scss';

.bg {
  height: 600px;
  width: 1000px;
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url("/img/tk.png");
  border-radius: 20px;
}
.border-payment{
  width: 50%;
  margin: 50px auto;
  border: 1px solid $page_secondary_color;
  background-color: black;
}
.payments_title{
  color:$page_other_color;
  font-size:20px;
  margin:40px 0;
}
.btn-margin{
  margin-bottom: 30px;
}
img{
  width: 80px;
  position: absolute;
  top: 7px;
}
.green{
  color: lightgreen;
}
.payment_subtitle{
  color: $page_other_color;
  font-size:20px;
}
</style>