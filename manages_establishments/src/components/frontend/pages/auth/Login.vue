<template>
  <div class="container card-height">
    <div class="row justify-content-center">
      <div class="col-4 card">
        <h5 class="card-header text-center">Faça o Login</h5>
        <div class="card-body">
          <form>
            <div class="form-group">
              <input type="email"
                     placeholder="E-mail"
                     class="form-control"
                     v-model="signUp.email">
            </div>

            <div class="form-group">
              <input type="password"
                     placeholder="Senha"
                     class="form-control"
                     v-model="signUp.password">
            </div>

            <div class="form-group">
              <button class="btn btn-primary btn-block" @click.prevent="login">Entrar</button>
            </div>

            <div class="mt-1 text-center">
              <p>Você não tem conta?</p>
              <router-link :to="{name: 'register'}"> Crie uma conta</router-link>
            </div>
          </form>
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
      signUp: {
        email: '',
        password: ''
      },
      users: []
    }
  },

  methods: {
    // Logar na Conta
    login() {
      if (this.signUp.email === ''
        || this.signUp.password === '') {
        this.$swal.fire({
          icon: 'error',
          title: 'Por favor, preencha todos os campos'
        });
        return false;
      }

      axios.post(`${URL_BASE}/login`, this.signUp)
        .then(response => {
          this.$router.replace('establishments');
        })
        .catch(error => {
          if (error.response.data.errors.email) {
            this.$swal.fire({
              icon: 'error',
              text: error.response.data.errors.email,
            })
          }

          if (error.response.data.errors.password) {
            this.$swal.fire({
              icon: 'error',
              text: error.response.data.errors.password,
            })
          }
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
