<template>
  <div>
  <navbar-component title="Product List"></navbar-component>
  <div id="opt">
    <router-link to="/add-product"><button class="btn">ADD</button></router-link>
    <router-link to="" v-on:click="massDelete"><button class="btn">MASS DELETE</button></router-link>
  </div>

  <div id="product-container">
    <product-component v-for="product in products" :key="product.id" v-on:click="check(product.id)"
                       v-bind:sku="product.sku" v-bind:name="product.name"
                       v-bind:price="product.price" v-bind:size="product.size"
                       v-bind:height="product.height" v-bind:width="product.width"
                       v-bind:length="product.length" v-bind:weight="product.weight">
    </product-component>
  </div>
  </div>
</template>

<script>
import NavbarComponent from "@/components/NavbarComponent";
import ProductComponent from "@/components/ProductComponent";
import axios from "axios";

export default {
  name: "ProductListView.vue",
  data () {
    return {
      products: null,
      productList: {},
    }
  },
  mounted () {
    axios
        .get("http://localhost:3000/product/product-list")
        .then(response => (this.products = JSON.parse(response.data)))
        .catch(error => console.log(error.message))
  },
  components: {
    NavbarComponent,
    ProductComponent,
  },
  methods: {
    check (id) {
      if (id in this.productList) {
        this.productList = !this.productList;
      } else {
        this.productList[id] = true;
      }
    },
    massDelete () {
      axios
          .delete("http://localhost:3000/product/mass-delete", {data: {productList: this.productList}})
          .then(() => window.location.href = "/")
          .catch(error => this.err = error.message)
    }
  }
}
</script>

<style scoped>

  #opt {
    position: fixed;

    top: 2vh;
    right: 2vw;

    background-color: transparent;

    float: right;
  }
  .btn {
    margin-left: 5pt;

    height: 95%;
    width: auto;

    font-size: 1.5vh;

    border-radius: 4px 4px 4px 4px;
    border: 2pt solid rgb(20, 20, 50);
    color: rgb(20, 20, 50);
    background-color: transparent;

    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    line-height: 250%;

    padding-left: 4pt;
    padding-right: 4pt;

    transition-duration: 0.25s;
  }
  .btn:hover {
    border-radius: 4px 4px 4px 12px;

    border: 2pt solid rgb(20, 20, 50);
    color: white;
    background-color: rgb(20, 20, 50);
  }

  #product-container {
    position: fixed;

    z-index: -1;
    background-color: transparent;

    left: 0;
    top: 8vh;
    height: 74vh;
    width: 100vw;

    overflow-y: scroll;

    display: grid;
    grid-template-columns: repeat(auto-fill, 210pt);
    grid-auto-rows: auto;

    justify-content: center;

    padding-top: 15pt;
    padding-bottom: 30pt;

  }

</style>