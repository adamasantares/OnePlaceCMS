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
        computed: {
            searchParams() {
                return this.$store.getters.searchParams;
            }
        },
        methods: {
            search() {
                let params = {};
                params.column = this.searchParams.column;
                params.sort = this.searchParams.sort;
                params.search = this.query;
                params.page = this.searchParams.page;

                this.$store.dispatch('updateSearchParams', params);
            }
        }
    }
</script>

<style scoped>

</style>