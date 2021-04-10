<template>
  <div id="app">
    <navbar></navbar>

    <router-view></router-view>

  </div>
</template>

<script>
import ListEstablishments from "./components/frontend/pages/establishments/ListEstablishments";
import AddEstablishment from "./components/frontend/pages/establishments/AddEstablishment";
import Navbar from "./components/frontend/layouts/Navbar";

export default {
  components: {
    Navbar,
    ListEstablishments,
    AddEstablishment
  }
}
</script>

<style>

</style>
