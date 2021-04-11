<template>
  <div>
    <navbar></navbar>

    <div class="container">

      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Editar Estabelecimento - {{ establishment.company_name }}</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateEstablishment">

              <div>
                <span>Dados do Estabelecimento</span>
                <hr>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <input type="text"
                         placeholder="Razão Social"
                         id="company_name"
                         class="form-control"
                         required
                         v-model="establishment.company_name">
                </div>

                <div class="form-group col-md-6">
                  <input type="text"
                         placeholder="Nome Fantasia"
                         id="fantasy_name"
                         class="form-control"
                         v-model="establishment.fantasy_name">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-4" v-if="establishment.document.length <= 14">
                  <input type="text"
                         placeholder="CPF / CNPJ"
                         class="form-control"
                         v-mask="'###.###.###-##'"
                         required
                         v-model="establishment.document">
                </div>

                <div class="form-group col-md-4" v-if="establishment.document.length > 14">
                  <input type="text"
                         placeholder="CPF / CNPJ"
                         class="form-control"
                         v-mask="'##.###.###/####-##'"
                         required
                         v-model="establishment.document">
                </div>

                <div class="form-group col-md-4">
                  <input type="text"
                         placeholder="Telefone"
                         id="phone"
                         class="form-control"
                         required
                         v-mask="'(##) #####-####'"
                         v-model="establishment.phone">
                </div>

                <div class="form-group col-md-4">
                  <input type="email"
                         placeholder="E-mail"
                         id="email"
                         class="form-control"
                         v-model="establishment.email">
                </div>
              </div>

              <div class="mt-4">
                <span>Endereço</span>
                <hr>
              </div>

              <div class="row">
                <div class="form-group col-md-3">
                  <input type="text"
                         placeholder="CEP"
                         id="zipcode"
                         class="form-control"
                         @keyup="searchCep()"
                         v-model="establishment.zipcode">
                </div>

                <div class="form-group col-md-7">
                  <input type="text"
                         placeholder="Logradouro"
                         id="street"
                         class="form-control"
                         v-model="establishment.street">
                </div>

                <div class="form-group col-md-2">
                  <input type="text"
                         placeholder="Número"
                         id="number"
                         class="form-control"
                         v-model="establishment.number">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-3">
                  <input type="text"
                         placeholder="Complemento"
                         id="complement"
                         class="form-control"
                         v-model="establishment.complement">
                </div>

                <div class="form-group col-md-5">
                  <input type="text"
                         placeholder="Bairro"
                         id="neighborhood"
                         class="form-control"
                         v-model="establishment.neighborhood">
                </div>

                <div class="form-group col-md-3">
                  <input type="text"
                         placeholder="Cidade"
                         id="city"
                         class="form-control"
                         v-model="establishment.city">
                </div>

                <div class="form-group col-md-1">
                  <input type="text"
                         placeholder="UF"
                         id="state"
                         class="form-control"
                         v-model="establishment.state">
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <router-link :to='{name: "establishments-list"}' class="btn btn-secondary">Voltar</router-link>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import Navbar from "../../layouts/Navbar";
import axios from "axios";
import {URL_BASE} from "../../../config/config";

export default {
  components: {
    Navbar
  },
  data() {
    return {
      establishment: {
        company_name: '',
        fantasy_name: '',
        document: '',
        phone: '',
        email: '',
        zipcode: '',
        street: '',
        number: '',
        complement: '',
        neighborhood: '',
        city: '',
        state: ''
      },
    }
  },

  mounted() {
    this.showEstablishment();
  },

  methods: {

    // Retornar dados do Estabelecimento nos campos do formulário
    showEstablishment() {
      axios.get(`${URL_BASE}/establishment/${this.$route.params.id}`)
      .then(response => {
        const {
          company_name, fantasy_name, document, phone, email, zipcode, street, number, complement, neighborhood, city, state
        } = response.data;

        this.establishment.company_name = company_name;
        this.establishment.fantasy_name = fantasy_name;
        this.establishment.document = document;
        this.establishment.phone = phone;
        this.establishment.email = email;
        this.establishment.zipcode = zipcode;
        this.establishment.street = street;
        this.establishment.number = number;
        this.establishment.complement = complement;
        this.establishment.neighborhood = neighborhood;
        this.establishment.city = city;
        this.establishment.state = state;
      })
      .catch(error=>{
        console.log(error)
      })
    },

    updateEstablishment() {
      if (this.establishment.company_name === ''
        || this.establishment.document === ''
        || this.establishment.zipcode === ''
        || this.establishment.street === '') {
        this.$swal.fire({
          icon: 'error',
          title: 'Por favor, preencha os campos corretamente'
        });
        return false;
      }

      axios.put(`http://127.0.0.1:8000/api/establishment/${this.$route.params.id}`,this.establishment)
      .then(response => {
        this.$swal.fire({
          position: 'center',
          icon: 'success',
          title: response.data.success,
          showConfirmButton: false,
          timer: 1500
        });
        this.$router.push({name: "establishments-list"});
      })
      .catch(error => {
        this.$swal.fire({
          icon: 'error',
          text: error.response.data.error,
        })
      })
    },

    // Realizar preenchimento do endereço pelo CEP
    searchCep() {
      if (this.establishment.zipcode.length === 8) {
        axios.get(`https://viacep.com.br/ws/${this.establishment.zipcode}/json/`)
          .then(response => {
            console.log(response.data)
            const { logradouro, number, complement, bairro, localidade, uf } = response.data;

            this.establishment.street = logradouro;
            this.establishment.number = number;
            this.establishment.complement = complement;
            this.establishment.neighborhood = bairro;
            this.establishment.city = localidade;
            this.establishment.state = uf;
          })
          .catch(error => console.log(error))
      }
    }
  }
}
</script>

<style scoped>

</style>
