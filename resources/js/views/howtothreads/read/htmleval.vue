<template>
    <div class="card-body">
      <div v-html="htmlcontent"></div>
    </div>
</template>

<script>

    export default {
        name: "howtothread-htmleval",
        props: {
            htmlcontent_prop: {}
        },
        components: {

        },
        mounted() {
            this.$parent.$on('htmlcontent_reloaded', ({ htmlcontent }) => {
                //console.log('htmlcontent_reloaded receive on htmleval ', htmlcontent)
                this.htmlcontent = htmlcontent
            })
        },
        created() {
        },
        data() {
            return {
                htmlcontent: this.htmlcontent_prop,
            }
        },
        methods: {

        },
        computed: {

        }
    }
</script>

<style scoped>

</style>
