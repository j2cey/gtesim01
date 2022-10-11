<template>
    <div class="card card-default">
        <div class="card-body">
            <dl>
                <dt class="text text-xs">Nom</dt>
                <dd class="text text-xs">{{ employe.nom_complet }}</dd>
                <dt class="text text-xs">Matricule</dt>
                <dd class="text text-xs">{{ employe.matricule }}</dd>
                <dt class="text text-xs">Adresse</dt>
                <dd class="text text-xs">{{ employe.adresse }}</dd>
                <dt class="text text-xs">Departement</dt>
                <dd class="text text-xs">{{ employe.departement ? employe.departement.intitule : '' }}</dd>
                <dt class="text text-xs">Fonction</dt>
                <dd class="text text-xs">{{ employe.fonction ? employe.fonction.intitule : '' }}</dd>
                <dt class="text text-xs">Created at</dt>
                <dd class="text text-xs">{{ employe.created_at | formatDate}}</dd>
            </dl>
        </div>
    </div>
</template>

<script>
    export default {
        name: "employe-details",
        props: {
            employe_prop: {},
        },
        components: {
        },
        mounted() {
        },
        data() {
            return {
                employe: this.employe_prop,
            };
        },
    }
</script>

<style scoped>

</style>
