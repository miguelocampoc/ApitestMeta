<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar orcid Externo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Ingrese la identificacion de orcid:</label>
              <input v-model="orcid_identifier_path" type="text" class="form-control"
                placeholder="Agrege el orcid identificador">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button @click="GetExternalOrcid()" type="button" class="btn btn-primary">Guardar</button>
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
    SaveOrcid(data) {

      this.form.orcid_identifier_path = data['orcid-identifier'].path;
      this.form.given_names = data.person.name['given-names'].value;
      this.form.family_name = data.person.name['family-name'].value;
      if (data.person.emails.email.length > 0) {
        this.form.email_primary = this.getEmailPrimary(data.person.emails.email)[0].email;

      }

      axios.post('api/orcid/create', this.form)
        .then((res) => {
          let orcid_id = res.data;
          this.UpdateKeywords(data.person.keywords.keyword, orcid_id);
          this.SendKeywords();
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
    GetExternalOrcid() {
      axios.get(this.url_external_orcid + this.orcid_identifier_path, {
        headers: {
          'Accept': 'application/json'
        }
      }).then((res) => {
        this.SaveOrcid(res.data);

      }).catch((error) => {

        console.log("No se encontro el orcid suministrado");
      });
    },
    getEmailPrimary(data) {
      return data.filter(function (objeto) {
        return objeto.primary === true;
      });
    },
    UpdateKeywords(data, id) {
      data.forEach(element => {
        let nuevo_objecto = {
          'orcid_id': id,
          'content': element.content
        }
        this.formKeyword.keyword_content.push(nuevo_objecto);
      });
    },
    SendKeywords() {
      axios.post('api/keyword/create', this.formKeyword)
        .then((res) => {
          console.log("guardado de keywords exitoso");

        }).catch((error) => {
          console.log("fallo al guardar las keywords");

        });
    },
  },
  data() {
    return {
      orcid_identifier_path: '',
      url_external_orcid: "https://pub.orcid.org/v3.0/",
      errors:"",
      keyword_content: '',
      form: {
        orcid_identifier_path: '',
        given_names: '',
        family_name: '',
        email_primary: '',
      },
      formKeyword: {
        keyword_content: []
      },
    }

  },
}
</script>
