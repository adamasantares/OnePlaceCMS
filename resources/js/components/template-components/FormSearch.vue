<template>
    <form @submit.prevent="search" style="padding: 0" role="search" action="">
        <div class="input-group add-on">
            <input class="form-control float-right"
                   placeholder="Search"
                   type="text"
                   v-model="query"
                   >
            <div class="input-group-append">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "FormSearch",
        data() {
            return {
                query: this.$route.query.search ? this.$route.query.search : ''
            }
        },
        methods: {
            search() {
                let query = Object.assign({}, this.$route.query, this.$route.query);
                query.search = this.query;

                this.$router.push({path: this.$route.path, query: query});
            }
        }
    }
</script>

<style scoped>

</style>