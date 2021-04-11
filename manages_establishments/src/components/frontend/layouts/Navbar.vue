<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-nav>
        <b-nav-item>
          <router-link class="nav-link" :to='{name: "establishments-list"}'>Home</router-link>
        </b-nav-item>
      </b-navbar-nav>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item>
            <router-link class="nav-link" :to='{name: "establishment-add"}'>Cadastrar</router-link>
          </b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right>
            <!-- Using 'button-content' slot -->
            <template #button-content>
              <em>Usuário</em>
            </template>

            <b-dropdown-item>
              <router-link :to="{name: 'login'}">Logout</router-link>
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

  </div>
</template>

<script>
import axios from "axios";
import {URL_BASE} from "../../config/config";

export default {

}
</script>

<style scoped>

</style>
