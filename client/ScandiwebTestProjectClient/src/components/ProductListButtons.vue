<template>

  <div class="buttons">
    <div v-on:click="goProductAdd" role="button" aria-pressed="false" tabindex="0" class="btn" id="add-btn">ADD</div>
    <div v-on:click="massDelete" class="btn" id="delete-product-btn">MASS DELETE</div>
  </div>

</template>

<script>
export default {
  name: "ProductListButtons",
  methods: {
    goProductAdd: function (e) {
      window.location.href = "/add-product";
    },
    massDelete: function (e) {
      alert("Delete clicked");
    }
  }
}
</script>

<style scoped>
  .buttons {
    position: fixed;
    display: inline-block;

    float: right;

    background-color: transparent;

    height: 4vh;
    width: auto;

    top: 2vh;
    right: 2vw;
  }

  #add-btn {
    margin-right: 8pt;
  }

  .btn {
    position: relative;
    float: left;

    cursor: pointer;

    height: 95%;
    width: auto;

    font-size: 1.5vh;

    border-radius: 4px 4px 4px 4px;
    border: 2pt solid rgb(20, 20, 50);
    color: rgb(20, 20, 50);
    background-color: transparent;

    font-family: Raleway;
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


</style>