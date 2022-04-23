<template>
  <div role="button" aria-pressed="false" tabindex="0" class="btn">{{ content }}</div>
</template>

<script>
export default {
  name: "Button",
  data: function () {
    return {

    };
  },
  props: ["content"]
}
</script>

<style scoped>
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