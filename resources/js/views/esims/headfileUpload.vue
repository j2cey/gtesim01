<template>
    <div class="card">
        <div class="card-header">
            <span class="text text-sm">
                Détails Téléchargement
            </span>
        </div>
        <div class="card-body">

            <form class="form-horizontal" @submit.prevent @keydown="esimForm.errors.clear()">

                <div class="form-group input-group file-group">
                    <input type="file" class="custom-file-input" id="fichier_esims" ref="fichier_esims" @change="handleFichierEsimsUpload" multiple>
                    <label class="custom-file-label" for="fichier_esims">{{ fichierEsimsPlaceholder }}</label>
                    <p class="text-sm-left"><small class="text text-danger" role="alert" v-if="esimForm.errors.has('fichier_dossier_candidature')" v-text="esimForm.errors.get('fichier_dossier_candidature')"></small></p>
                </div>

            </form>

        </div>
        <!-- /.card-body -->
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" @click="closeWindow">Fermer</button>
            <button type="button" class="btn btn-primary btn-sm" @click="createEsims()" :disabled="!isValidCreateForm">Valider</button>
        </div>
    </div>
</template>

<script>
    class Esimsfile {
        constructor(esimsfile) {
            this.fichier = esimsfile.fichier || ''
            this.fichier_esims = esimsfile.fichier_esims || ''
        }
    }

    export default {
        name: "esims-headfile-upload",
        props: {
            postlink_prop: '',
            getfileuploadmaxsize_prop: 0,
        },
        mounted() {
            this.editing = false
            this.esimsfile = new Esimsfile({})
            this.esimForm = new Form(this.esimsfile)
        },
        data() {
            return {
                esimsfile: {},
                esimForm: new Form(new Esimsfile({})),
                esimsfileId: null,
                postlink: this.postlink_prop,
                editing: false,
                loading: false,
                errors: [],
                selectedEsimsFile : null,
                selectedEsimsFileName : "Selectionnez le fichier (xls)...",
                fichierEsimsPlaceholder : "Selectionnez le Fichier...(" + this.getfileuploadmaxsize_prop + " Mo max)",
            }
        },
        methods: {
            handleFichierEsimsUpload(event) {
                this.selectedEsimsFile = event.target.files[0];
                this.fichierEsimsPlaceholder = (typeof this.selectedEsimsFile !== 'undefined') ? this.selectedEsimsFile.name : "Selectionnez le Fichier...(" + this.getfileuploadmaxsize_prop + " Mo max)";
                this.esimForm.fichier = this.fichierEsimsPlaceholder;
            },
            createEsims() {
                this.loading = true
                const fd = new FormData();
                fd.append('fichier_esims', this.selectedEsimsFile);
                this.esimForm
                    .post('/esims.' + this.postlink, fd)
                    .then(newdata => {
                        this.loading = false
                        this.resetForm();
                        this.$swal({
                            html: '<small>Fichier téléchargé avec succès !</small>',
                            type: 'success',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            window.location = '/esims'
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            closeWindow() {
                window.location = '/esims'
            },
            resetForm() {
                this.esimForm.reset();
                this.$refs.fichier_esims.value = '';
            }
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            }
        }
    }
</script>
