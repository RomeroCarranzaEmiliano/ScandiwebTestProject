<template>
  <div class="product-box" v-on:click="checked=!checked;" v-bind:aria-selected="checked">
    <input type="checkbox" class="delete-checkbox" v-bind:checked="checked">
    <br>
    <div id="product-text">
      <div class="product-sku">{{ sku }}</div>
      <div class="product-name">{{ name }}</div>
      <div class="product-value">{{ price }} $</div>

      <div class="product-type-attribute" v-if="size">size: {{ size }} MB</div>

      <div class="product-type-attribute" v-if="height">height: {{ height }} CM</div>
      <div class="product-type-attribute" v-if="width">width: {{ width }} CM</div>
      <div class="product-type-attribute" v-if="length">length: {{ length }} CM</div>

      <div class="product-type-attribute" v-if="weight">weight: {{ weight }} KG</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductComponent",
  props: ["sku", "name", "price", "size", "height", "width", "length", "weight"],
  data: function () {
    return {
      checked: false
    };
  },
  methods: {

  },
}
</script>

<style scoped>
  .product-box {
    position: relative;
    float: left;

    text-align: center;

    display: table-cell;
    vertical-align: middle;

    font-size: 2vh;

    border: 2pt solid rgba(20, 20, 50, 60%);
    border-radius: 12pt;

    background-color: white;
    color: rgb(20, 20, 50);

    margin-bottom: 5pt;
    margin-right: 15pt;


    height: 150pt;
    width: 200pt;

    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Old versions of Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none; /* Non-prefixed version, currently
                                    supported by Chrome, Edge, Opera and Firefox */

    transition-duration: 0.2s;
  }
  #product-text {
    position: absolute;

    line-height: 150%;

    left:50%;
    transform: translateX(-50%) translateY(-50%);
    top:50%;
  }
  .product-box:hover {
    border: 2pt solid rgba(20, 20, 50, 100%);
  }
  .product-box[aria-selected="true"] {
    border-color: black;
    box-shadow: 0 10px 6px -6px #777;
  }

  .delete-checkbox {
    position: absolute;
    float: left;
    margin-left: -45%;
    margin-top: 5%;
  }
</style>