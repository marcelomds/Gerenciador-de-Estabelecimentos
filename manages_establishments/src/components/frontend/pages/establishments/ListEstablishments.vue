<template>
  <div>
    <div class="col-12 mt-3">
      <div class="card">
        <div class="card-header">
          <h4 class="text-center">Estabelecimentos</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th width="150">Razão Social</th>
                <th width="200">Nome Fantasia</th>
                <th>CPF / CNPJ</th>
                <th width="200">Telefone</th>
                <th>E-mail</th>
                <th width="400">Endereço</th>
                <th width="160">Ações</th>
              </tr>
              </thead>
              <tbody v-if="establishments.length > 0">
              <tr v-for="(establishment,key) in establishments" :key="key">
                <td>{{ establishment.company_name }}</td>
                <td>{{ establishment.fantasy_name }}</td>
                <td>{{ establishment.document }}</td>
                <td>{{ establishment.phone | phone }}</td>
                <td>{{ establishment.email }}</td>
                <td>{{ establishment.street }},
                  {{ establishment.number }} -
                  {{ establishment.complement }} -
                  {{ establishment.neighborhood }} -
                  {{ establishment.city }} -
                  {{ establishment.state }}
                </td>
                <td>
                  <router-link :to='{name: "establishment-edit", params:{id:establishment.id}}' class="btn btn-warning btn-sm">Editar</router-link>
                  <button type="button" @click.prevent="deleteEstablishment(establishment.id)"
                          class="btn btn-danger btn-sm">Delete
                  </button>
                </td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr>
                <td colspan="8" class="text-center">Nenhum estabelecimento cadastrado</td>
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
import axios from 'axios';

export default {
  data() {
    return {
      establishments: []
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
      axios.get('http://127.0.0.1:8000/api/establishment')
        .then(response => {
          this.establishments = response.data;
        })
        .catch(error => {
          console.log(error)
          this.establishments = []
        })
    },

    deleteEstablishment(id) {
      axios.delete(`http://127.0.0.1:8000/api/establishment/${id}`)
        .then(response => {
          this.getEstablishments()
        }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>

</style>
