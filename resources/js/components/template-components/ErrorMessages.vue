<template>
    <div v-if="errors.length" class="alert alert-danger alert-dismissible">
        <button @click.prevent="deleteMessages" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-ban"></i> Error!</h5>
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ErrorMessages",
        computed: {
            errors() {
                return this.$store.getters.errorMessage;
            }
        },
        methods: {
            deleteMessages() {
                this.$store.commit('updateErrorMessage', []);
            }
        }
    }
</script>

<style scoped>

</style>