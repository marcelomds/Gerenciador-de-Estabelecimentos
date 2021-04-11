<template>
  <div class="container card-height">
    <div class="row justify-content-center">
      <div class="col-4 card">

        <h5 class="card-header text-center">Crie uma Nova Conta</h5>
        <div class="card-body">
          <div class="form-group">
            <input type="text"
                   placeholder="Nome Completo"
                   class="form-control"
                   v-model="user.name">
          </div>

          <div class="form-group">
            <input type="email"
                   placeholder="Email"
                   class="form-control"
                   v-model="user.email">
          </div>

          <div class="form-group">
            <input type="password"
                   placeholder="Senha"
                   class="form-control"
                   v-model="user.password">
          </div>

          <div class="form-group">
            <input type="password"
                   placeholder="Confirmar Senha"
                   class="form-control"
                   v-model="user.confirmPassword">
          </div>

          <div class="form-group">
            <button class="btn btn-primary btn-block" @click="userRegister">Registrar</button>
          </div>

          <span class="mt-1 text-center">Retornar para <router-link :to="{name:'login'}">Login</router-link></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {URL_BASE} from "../../../config/config";

export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      }
    }
  },

  methods: {

    // Registrar Novo Usuário
    userRegister() {
      if (this.user.name === ''
        || this.user.email === ''
        || this.user.password === ''
        || this.user.confirmPassword === '') {
        this.$swal.fire({
          icon: 'error',
          title: 'Por favor, preencha todos os campos'
        });
        return false;
      }

      if (this.user.confirmPassword !== this.user.password) {
        this.$swal.fire({
          icon: 'error',
          title: 'As senhas não conferem'
        });
        return false;
      }

      axios.post(`${URL_BASE}/register`, this.user)
        .then(response => {

          this.$router.push({name: "establishments-list"});
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            text: error.response.data.error,
          })
        })
    }
  }
}
</script>

<style scoped>
.card-height {
  margin-top: 10%;
}
</style>
