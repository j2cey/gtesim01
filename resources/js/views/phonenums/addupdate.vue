<template>
    <div class="modal fade" id="addUpdatePhoneNum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="phonenumModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="phonenumForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nom_raison_sociale" class="col-sm-2 col-form-label text-xs">Nom / Raison Sociale</label>
                                <div class="col-sm-10">
                                    <input disabled type="text" class="form-control text-xs" id="nom_raison_sociale" name="nom_raison_sociale" autocomplete="nom_raison_sociale" autofocus placeholder="Nom / Raison Sociale" v-model="phonenumForm.client_esim.nom_raison_sociale">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prenom" class="col-sm-2 col-form-label text-xs">Prenom</label>
                                <div class="col-sm-10">
                                    <input disabled type="text" class="form-control text-xs" id="prenom" name="prenom" autocomplete="prenom" autofocus placeholder="Prenom" v-model="phonenumForm.client_esim.prenom">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero" class="col-sm-2 col-form-label text-xs">Numero Telephone</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="numero" name="numero" required autocomplete="numero" autofocus placeholder="Numero Telephone" v-model="phonenumForm.numero">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="phonenumForm.errors.has('numero')" v-text="phonenumForm.errors.get('numero')"></span>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updatePhoneNum()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="createPhoneNum()" :disabled="!isValidCreateForm" v-else>Creer Client</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    export default {
        name: "addupdate"
    }
</script>

<style scoped>

</style>
