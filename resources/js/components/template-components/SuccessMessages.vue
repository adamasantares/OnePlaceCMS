<template>
    <div v-if="message" class="alert alert-success alert-dismissible">
        <button @click.prevent="deleteMessage" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> Success!</h5>
        {{ message }}
    </div>
</template>

<script>
    export default {
        name: "SuccessMessages",
        computed: {
            message() {
                return this.$store.getters.successMessage;
            }
        },
        methods: {
            deleteMessage() {
                this.$store.commit('updateSuccessMessage', '');
            }
        }
    }
</script>

<style scoped>

</style>