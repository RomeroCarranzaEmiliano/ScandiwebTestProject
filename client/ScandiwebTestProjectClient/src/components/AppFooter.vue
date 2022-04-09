<template>
  <footer>
    <p id="footerTitle">Scandiweb Test assigment</p>
  </footer>
</template>

<script>
export default {
  name: "AppFooter"
}
</script>

<style scoped>
  footer {
    position: fixed;
    bottom: 0;
    left: 0;

    background-color: rgb(10, 10, 50);

    height: 8vh;
    width: 100vw;

    text-align: center;
    font-family: Raleway;
    font-size: 2.5vh;
    color: rgb(235, 235, 250)
  }

  #footerTitle {
    position: relative;
    bottom: 2%;
  }
</style>