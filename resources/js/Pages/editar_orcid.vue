<template>
    <navbar></navbar>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">Editar Orcid</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ingrese la identificacion de orcid:</label>
                            <input type="text" class="form-control" v-model="form.orcid_identifier_path">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" v-model="form.given_names">
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" v-model="form.family_name">
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email Principal:</label>
                            <input type="text" class="form-control" v-model="form.email_primary">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <p>Palabras claves</p>

                </div>


                <div class="row" v-if="orcid.data.keywords.length > 0">

                    <div v-for="(keyword, index) in  orcid.data.keywords" :key="index" class="col-xl-6">
                        <div class="mb-3">
                            <textarea class="form-control" v-model="orcid.data.keywords[index].content"></textarea>
                        </div>
                    </div>

                </div>
                <div class="row" v-else>
                    <div class="mb-3">
                        <p> No hay palabras claves registradas</p>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" @click="UpdateOrcid()">Guardar Cambios</button>
            </div>

        </div>

    </div>
</template>
<script>
import axios from 'axios'
import navbar from '@/Pages/menu.vue';

export default {

    components: {
        navbar
    },
    props: {
        orcid: Object
    },
    methods: {
        UpdateOrcid() {
            axios.put('/api/orcid/update/' + this.orcid.data.id, this.form)
                .then((res) => {
                    this.UpdatedKeywords();
                }).catch((error) => {

                });
        },
        MessageUpdate() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Registro Actualizado',
                showConfirmButton: false,
                timer: 1500
            });
        },
        UpdatedKeywords() {
            this.orcid.data.keywords.forEach(element => {
                axios.put('/api/keyword/update/' + element.id, {
                    'content': element.content
                })
                    .then((res) => {
                    }).catch((error) => {

                    });
            });
            this.MessageUpdate();

        }

    },

    data() {
        return {
            form: {
                orcid_identifier_path: this.orcid.data.orcid_identifier_path,
                given_names: this.orcid.data.given_names,
                family_name: this.orcid.data.family_name,
                email_primary: this.orcid.data.email_primary,

            },
            formKeyword: {
                keyword_content: this.orcid.data.keywords,
                orcid_id: this.orcid.data.id
            },
        }

    },
}
</script>