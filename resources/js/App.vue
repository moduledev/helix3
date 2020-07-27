<template>
  <div id="app">
    <TheNavigation></TheNavigation>
    <router-view/>
  </div>
</template>

<script>
  import TheNavigation from "./components/TheNavigation";
  export default {
    components: {
      TheNavigation
    }
  }
</script>


