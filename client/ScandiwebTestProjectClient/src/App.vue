<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from '@/components/HelloWorld.vue'

import NavBar from '@/components/NavBar.vue';
import AppFooter from '@/components/AppFooter.vue';
</script>

<template>
  <button v-on:click="goAddProduct">ADD</button>
  <RouterView />
</template>

<style>

</style>
