<template>
    <div class="modal fade" id="add_orcid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Orcid</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ingrese la identificacion de
                                    orcid:</label>
                                <input v-model="form.orcid_identifier_path" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nombres:</label>
                                <input v-model="form.given_names" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Apellidos:</label>
                                <input v-model="form.family_name" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email principal:</label>
                                <input v-model="form.email_primary" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Palabras Claves:</label>
                                <textarea v-model="formKeyword.content" type="text" class="form-control"></textarea>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button @click="SaveOrcid()" type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    methods: {
        SaveOrcid() {
            axios.post('api/orcid/create', this.form)
                .then((res) => {
                    let orcid_id = res.data;
                    this.UpdateKeywords(orcid_id);
                    this.SendKeywords();
                    this.CleanData();
                    this.$emit('orcid_list_event')
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Registro Agregado',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch((error) => {

                });

        },

        UpdateKeywords(id) {
            this.formKeyword.keyword_content = {
                orcid_id: id,
                content: this.formKeyword.content
            }
        },
        SendKeywords() {
            axios.post('api/keyword/create', this.formKeyword)
                .then((res) => {
                    console.log("guardado de keywords exitoso");


                }).catch((error) => {
                    console.log("fallo al guardar las keywords");

                });
        },
        CleanData() {
            this.form.orcid_identifier_path = "";
            this.form.given_names = "";
            this.form.family_name = "";
            this.form.email_primary = "";
            this.formKeyword.content = "";

        }
    },
    data() {
        return {
            form: {
                orcid_identifier_path: '',
                given_names: '',
                family_name: '',
                email_primary: '',
            },
            formKeyword: {
                keyword_content: [],
                content: ''
            },
        }

    },
}
</script>

