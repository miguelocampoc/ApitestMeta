<template>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ver Orcid</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Orcid Identificador: {{ orcid_item.orcid_identifier_path }}</p>
                    <p>Nombres:{{ orcid_item.given_names }}</p>
                    <p>Apellidos: {{ orcid_item.family_name }}</p>
                    <p>Email principal: {{ orcid_item.email_primary }}</p>
                    <p>Palabras Claves:</p>
                    <v-for v-for="(keyword, index) in orcid_item.keywords" :key="index">{{ keyword.content }}<span
                            v-if="index == orcid_item.keywords.length - 1">.</span> <span v-else>,</span></v-for>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {

    components: {

    },
    props: ['orcid_item']
}
</script>
