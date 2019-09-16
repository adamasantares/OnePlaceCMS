<template>
    <div>
        <table class="table table-bordered table-striped dataTable" role="grid" >
            <thead>
            <tr role="row">
                <table-header-cell :searchParams="searchParams" label="Title" parameter="title" />
                <table-header-cell :searchParams="searchParams" label="Published" parameter="published" />
                <table-header-cell :searchParams="searchParams" label="Date create" parameter="created_at" />
                <table-header-cell :searchParams="searchParams" label="Date update" parameter="updated_at" />
                <th style="width: 84px">Action</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!isLoaded">
                <tr role="row" class="odd">
                    <td colspan="5" class="text-center"><h2>Loading...</h2></td>
                </tr>
            </template>
            <template v-else-if="!rows.data || !rows.data.length">
                <tr role="row" class="odd">
                    <td colspan="5" class="text-center"><h2>No data available</h2></td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="model in rows.data" :key="model.id">
                    <td>{{ model.title }}</td>
                    <td>{{ model.published ? 'Published' : 'Not published' }}</td>
                    <td>{{ model.created_at }}</td>
                    <td>{{ model.updated_at }}</td>
                    <td>
                        <router-link :to="{ path: `/entry/${model_id}/edit/${model._id}` }" class="btn btn btn-primary" >
                            <i class="fa fa-edit"></i>
                        </router-link>
                        <a @click.prevent="deleteRow(model)" href="#" title="Delete" class="btn btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            </template>
            </tbody>
            <tfoot>
            <tr>
                <th>Title</th>
                <th>Published</th>
                <th>Date create</th>
                <th style="width: 150px">Date update</th>
                <th style="width: 84px">Action</th>
            </tr>
            </tfoot>
        </table>
        <pagination :currentPage="searchParams.page" :lastPage="rows.last_page"></pagination>
    </div>
</template>

<script>
    import FunctionsMixin from '../../mixins/Listing';
    import TableHeaderCell from '../template-components/TableHeaderCell'

    export default {
        name: 'list',
        components: { TableHeaderCell },
        mixins: [FunctionsMixin],
        data() {
            return {
                model_id: this.$route.params.model,
                base_path: `/entry/${this.$route.params.model}`,
                base_path_api: '/api/entry/',
                searchParams: {
                    column: this.$route.query.column ? this.$route.query.column : 'created_at',
                    sort: this.$route.query.sort ? this.$route.query.sort : 'desc',
                    search: this.$route.query.search ? this.$route.query.search : '',
                    page: this.$route.query.page ? +this.$route.query.page : 1
                }
            }
        },
        computed: {
            rows() {
                return this.$store.getters.contentEntries;
            }
        },
        methods: {
            getRows(query) {
                let params = Object.assign(this.searchParams, query);
                params = Object.assign({model_id: this.model_id}, this.searchParams);
                this.$store.dispatch('getEntries', params).then(
                    resolve => {
                        this.isLoaded = true;
                    },
                    reject => {

                    }
                );
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.model_id = to.params.model;
            this.getRows(to.query);
            next();
        },
        mounted() {
            this.$store.commit('updateTitlePage', 'Entries');
            this.getRows({});
        }
    }
</script>

<style scoped>
    table thead th {
        user-select: none;
    }
</style>