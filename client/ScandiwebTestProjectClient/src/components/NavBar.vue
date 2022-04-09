<template>

  <header>
    <div id="pageTitle">{{ pageTitle }}</div>
    <component v-bind:is="pageButtons"></component>
  </header>

</template>

<script>
import ProductListButtons from './ProductListButtons.vue'
import AddProductButtons from "./AddProductButtons.vue";
export default {
  name: "NavBar",
  components: {ProductListButtons, AddProductButtons},
  props: ["pageTitle", "pageButtons"],
}
</script>

<style scoped>
  header {
    position: fixed;
    top: 0;
    left: 0;

    background-color: white;
    border-bottom: 1pt solid rgb(20, 20, 50);

    height: 8vh;
    width: 100vw;
  }

  #pageTitle {
    position: relative;
    font-family: 'Raleway';
    font-weight: bold;
    font-size: 4vh;

    color: rgb(10, 10, 50);

    top: 2vh;
    left: 2vw;

  }

</style>