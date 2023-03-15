<style>
.button-container button,
a {
    margin-left: 8px;
}
</style>
<template>
    <agregar_modal @orcid_list_event="orcid_list"></agregar_modal>
    <show_modal :orcid_item="orcid_item"></show_modal>
    <addorcid_modal @orcid_list_event="orcid_list"></addorcid_modal>
    <navbar></navbar>

    <div class="container-fluid mt-4">

        <div class="card">
            <div class="card-header">
                Listar Orcids
            </div>
            <div class="card-body">
                <div class="button-container mb-4">
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">Agregar orcid externo</button><span class="ml-5"></span>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_orcid"
                        data-bs-whatever="@mdo">Agregar Orcid</button>
                </div>

                <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">orcid_identifier</th>
                            <th scope="col">given_names</th>
                            <th scope="col">family_name</th>
                            <th scope="col">email_primary</th>
                            <th scope="col">Opciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(orcid, index) in list_orcid.data" :key="index">
                            <td>{{ orcid.orcid_identifier_path }}</td>
                            <td>{{ orcid.given_names }}</td>
                            <td>{{ orcid.family_name }}</td>
                            <td>{{ orcid.email_primary }}</td>

                            <td>
                                <div class="button-container">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        @click="get_orcid_item(index)" data-bs-target="#staticBackdrop">Ver</button>
                                    <button @click="confirmationButton(orcid.id)" class="btn btn-primary"> Eliminar</button>
                                    <Link class="btn btn-primary" :href="'/orcid/edit/' + orcid.id"> Editar</Link>

                                </div>

                            </td>

                        </tr>


                    </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer">
                <nav class="mt-0 mb-0" aria-label="Page navigation example">
                    <ul class="pagination mt-0 mb-0">
                        <li style="cursor:pointer" v-for="(page, index) in list_orcid.meta?.links" :key="index"
                            :class="['page-item', { 'disabled': page.url == null }]"><a
                                :class="['page-link', { 'active': page.active }]" @click="ChangePage(page.url)">{{
                                    page.label }}
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import agregar_modal from '@/Pages/add_modal.vue';
import show_modal from '@/Pages/show_modal.vue';
import addorcid_modal from '@/Pages/addorcid_modal.vue';
import navbar from '@/Pages/menu.vue';

import { Link } from '@inertiajs/vue3';

export default {

    components: {
        agregar_modal,
        show_modal,
        addorcid_modal,
        Link,
        navbar
    },
    props: {

    },
    created() {
        this.orcid_list();
    },
    methods: {
        ChangePage(url) {
            axios.get(url).then((res) => {
                console.log(res.data);
                this.list_orcid = res.data;

            })
        },
        confirmationButton(id) {
            Swal.fire({
                title: '¿Estas Seguro?',
                html: "<span style='color:white'>No puede revertir esta accion</span>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Remover',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Removido',
                        "<span style='color:white'>Su archivo ha sido eliminado</span>",
                        'success'
                    )
                   this.destroy(id);
                }
            })
        },
        destroy(id) {
            axios.delete('api/orcid/delete/' + id).then((res) => {
                this.ChangePage('api/orcid/list?page=' + this.list_orcid.meta.current_page);
            })

        },
        orcid_list() {
            axios.get("api/orcid/list").then((res) => {
                console.log(res.data);
                this.list_orcid = res.data;


            })
        },
        get_orcid_item(index) {
            this.orcid_item = this.list_orcid.data[index];

        }
    },

    data() {
        return {
            url_listar: '/api/orcid/list',
            list_orcid: [],
            current_page: "",
            orcid_item: "",
        }

    },
}
</script>