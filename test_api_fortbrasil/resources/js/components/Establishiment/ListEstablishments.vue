<template>
    <div>
        <Navbar></Navbar>
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
                                <th>#</th>
                                <th>Razão Social</th>
                                <th>Nome Fantasia</th>
                                <th>CPF / CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Endereço</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody v-if="establishments.length > 0">
                            <tr v-for="(establishment,key) in establishments" :key="key">
                                <td>{{ establishment.id }}</td>
                                <td>{{ establishment.company_name }}</td>
                                <td>{{ establishment.fantasy_name }}</td>
                                <td>{{ establishment.document }}</td>
                                <td>{{ establishment.phone | phone }}</td>
                                <td>{{ establishment.email }}</td>
                                <td>{{ establishment.street }},
                                    {{ establishment.number }} -
                                    {{ establishment.complement }} -
                                    {{ establishment.neighborhood }} -
                                    {{ establishment.state }}
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm">Editar</button>
                                    <!--                                    <routers-link :to='{name:"categoryEdit",params:{id:category.id}}' class="btn btn-success">Edit</routers-link>-->
                                    <button type="button" class="btn btn-danger btn-sm">Remover</button>
                                    <!--                                    <button type="button" @click="deleteCategory(category.id)" class="btn btn-danger">Delete</button>-->
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
    </div>
</template>

<script>
import Navbar from "../_include/Layout/Navbar";

export default {
    components: {
        Navbar
    },

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
        phone(number) {
            return number.replace(/[^0-9]/g, '').replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
    },

    methods: {

        // Listar Todos os Estabelecimentos Cadastrados
        getEstablishments() {
            axios.get('api/establishment')
                .then(response => {
                    this.establishments = response.data;
                })
                .catch(error => {
                    console.log(error)
                    this.establishments = []
                })
        }
    }
}
</script>

<style scoped>

</style>
