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
