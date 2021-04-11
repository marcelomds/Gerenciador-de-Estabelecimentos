<template>
  <div>
    <navbar></navbar>

    <div class="col-12 mt-3">
      <div class="card">
        <div class="card-header">
          <h4 class="text-center">Lista de Estabelecimentos</h4>
        </div>

        <div class="container row mt-2 search-address">
          <div class="col-md-4">
            <form>
              <input type="text" class="form-control" placeholder="Pesquisar: Digite o Endereço"
                     v-model="filterAddress">
            </form>
          </div>
        </div>


        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-dark">
              <tr>
                <th width="150">Razão Social</th>
                <th width="200">Nome Fantasia</th>
                <th width="200">CPF / CNPJ</th>
                <th width="180">Telefone</th>
                <th width="150">E-mail</th>
                <th width="400">Endereço</th>
                <th width="120">Ações</th>
              </tr>
              </thead>
              <tbody v-if="filterEstablishmentsAddress.length > 0">
              <tr v-for="(establishment,key) in filterEstablishmentsAddress" :key="key">
                <td>{{ establishment.company_name }}</td>
                <td>{{ establishment.fantasy_name }}</td>
                <td>{{ establishment.document }}</td>
                <td>{{ establishment.phone }}</td>
                <td>{{ establishment.email }}</td>
                <td>{{ establishment.street }},
                  {{ establishment.number }} -
                  {{ establishment.neighborhood }} -
                  {{ establishment.city }} -
                  {{ establishment.state }}
                </td>
                <td>
                  <router-link :to='{name: "establishment-edit", params:{id:establishment.id}}'
                               class="btn btn-warning btn-sm"><i title="Editar" class="fas fa-edit"></i></router-link>
                  <button type="button" @click.prevent="deleteEstablishment(establishment.id)"
                          class="btn btn-danger btn-sm"><i title="Excluir" class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr>
                <td colspan="7" class="text-center">Nenhum estabelecimento cadastrado</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from "../../layouts/Navbar";
import axios from 'axios';
import {URL_BASE} from "../../../config/config";

export default {
  components: {
    Navbar
  },
  data() {
    return {
      establishments: [],
      filterAddress: '',

    }
  },

  mounted() {
    // Lista os estabelecimentos ao iniciar a página
    this.getEstablishments()
  },

  filters: {
    // Formatar apresentação número de telefone
    phone(number) {
      return number.replace(/[^0-9]/g, '').replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }
  },

  methods: {

    // Listar Todos os Estabelecimentos Cadastrados
    getEstablishments() {

      axios.get(`${URL_BASE}/establishment`)
        .then(response => {
          this.establishments = response.data;
        })
        .catch(error => {
          console.log(error)
          this.establishments = []
        })
    },

    // Deletar Estabelecimento
    deleteEstablishment(id) {
      this.$swal.fire({
        title: 'Excluir este Ítem?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#38AC6D',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
      })

        .then((result) => {
          if (result.isConfirmed) {
            axios.delete(`${URL_BASE}/establishment/${id}`)
              .then(response => {
                this.getEstablishments()
              }).catch(error => {
              console.log(error)
            })
          }
        })
    }
  },

    computed: {
    // Filtrar Estabelecimentos por Endereço
      filterEstablishmentsAddress() {
        if (this.filterAddress === '') {
          return this.establishments;
        }

        return this.establishments.filter(address => {
          return address.street.toLowerCase().includes(this.filterAddress)
        });
      }
    }
  }
</script>

<style scoped>
.search-address {
  margin-left: -9px;
}
</style>
