<script setup>
import NavBar from '@/components/NavBar.vue';
import AppFooter from '@/components/AppFooter.vue';
import Product from "@/components/Product.vue";
import Button from "@/components/Button.vue";
import axios from "axios";

</script>

<script>

export default {
  data () {
    return {
      products: null,
      productList: {},
      err: ""
    }
  },
  mounted() {
    axios
        .get("http://localhost:80/product/product-list")
        .then(response => (this.products = JSON.parse(response.data)))
        .catch(error => this.err = error.message)
  },
  methods: {
    check: function (id) {
      if (this.productList.hasOwnProperty(id)) {
        this.productList[id] = !this.productList[id];
      } else {
        this.productList[id] = true;
      }
    },
    massDelete: function () {
      axios
          .delete("http://localhost:80/product/mass-delete", {data: {productList: this.productList}})
          .then(response => window.location.href = "/")
          .catch(error => this.err = error.message)
    },
    goAddProduct: function () {
      window.location.href = "/add-product";
    }
  }
}
</script>

<template>
  <body>
  <NavBar pageTitle="Product List" />
  <div class="btn-container">
    <Button id="add-btn" content="ADD" v-on:click="goAddProduct"/>
    <Button id="delete-product-btn" class="delete-checkbox" content="MASS DELETE" v-on:click="massDelete" />
  </div>

  <div class="container">
    <Product v-for="product in products" v-on:click="check(product.id)" v-bind:sku="product.sku" v-bind:name="product.name"
             v-bind:price="product.price" v-bind:size="product.size" v-bind:height="product.height"
             v-bind:width="product.width" v-bind:length="product.length" v-bind:weight="product.weight" />
  </div>

  <AppFooter />
  </body>
</template>

<style>
  @import url('https://fonts.googleapis.com/css?family=Roboto|Abril+Fatface|Raleway:500,700,900');

  body {
    margin: 0;
  }

  .btn-container {
    position: fixed;

    top: 2vh;
    right: 2vw;

    background-color: transparent;

    float: right;
  }

  #add-btn {
    right: 5pt;
  }

  .container {
    position: fixed;

    z-index: -1;

    height: 78vh;
    top: 8vh;

    padding-top: 25pt;
    padding-bottom: 10pt;

    left: 50%;
    transform: translateX(-50%);

    overflow-y: scroll;

    align-items: center;


  }

  ::-webkit-scrollbar {
    width: 20px;
  }
  ::-webkit-scrollbar-track {
    background-color: transparent;
  }
  ::-webkit-scrollbar-thumb {
    background-color: #d6dee1;
  }
  ::-webkit-scrollbar-thumb {
    background-color: #d6dee1;
    border-radius: 20px;
  }
  ::-webkit-scrollbar-thumb {
    background-color: #d6dee1;
    border-radius: 20px;
    border: 6px solid transparent;
    background-clip: content-box;
  }
  ::-webkit-scrollbar-thumb:hover {
    background-color: #a8bbbf;
  }





  @media only screen and (min-width: 1100pt) {
    .container {
      width: 950pt;
    }
  }

  @media only screen and (min-width: 850pt) and (max-width: 1100pt) {
    .container {
      width: 750pt;
    }
  }

  @media only screen and (min-width: 510pt) and (max-width: 850pt) {
    .container {
      width: 500pt;
    }
  }

  @media only screen and (max-width: 510pt) {
    .container {
      width: 250pt;
    }
  }

</style>