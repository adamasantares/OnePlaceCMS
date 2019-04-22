<template>
    <div>
        <table class="table table-bordered table-striped dataTable" role="grid" >
            <thead>
            <tr role="row">
                <th @click="sortTable('title')" :class="classObjectForTitleColumn">
                    Title
                </th>
                <th @click="sortTable('published')" :class="classObjectForPublishedColumn" style="width: 200px">
                    Published
                </th>
                <th @click="sortTable('created_at')" :class="classObjectForDateCreatedColumn" style="width: 200px">
                    Date create
                </th>
                <th @click="sortTable('updated_at')" :class="classObjectForDateUpdatedColumn" style="width: 200px">
                    Date update
                </th>
                <th style="width: 84px">Action</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!contentEntries.data || !contentEntries.data.length">
                <tr role="row" class="odd">
                    <td colspan="5" class="text-center"><h2>No data available</h2></td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="model in contentEntries.data" :key="model.id">
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
        <pagination :currentPage="searchParams.page" :lastPage="contentEntries.last_page"></pagination>
    </div>
</template>

<script>
    import Pagination from '../template-components/Pagination';

    export default {
        name: 'list',
        components: {
            Pagination
        },
        data() {
            return {
                entries: [],
                model_id: this.$route.params.model,
                searchParams: {
                    column: this.$route.query.column ? this.$route.query.column : 'created_at',
                    sort: this.$route.query.sort ? this.$route.query.sort : 'desc',
                    search: this.$route.query.search ? this.$route.query.search : '',
                    page: this.$route.query.page ? +this.$route.query.page : 1
                }
            }
        },
        computed: {
            contentEntries() {
                return this.$store.getters.contentEntries;
            },
            classObjectForTitleColumn() {
                return {
                    sorting_asc: this.searchParams.column == 'title' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'title' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'title'
                }
            },
            classObjectForPublishedColumn() {
                return {
                    sorting_asc: this.searchParams.column == 'published' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'published' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'published'
                }
            },
            classObjectForDateCreatedColumn() {
                return {
                    sorting_asc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'created_at'
                }
            },
            classObjectForDateUpdatedColumn() {
                return {
                    sorting_asc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'updated_at'
                }
            }
        },
        methods: {
            sortTable(column) {
                this.searchParams.column = column;
                this.searchParams.sort = (this.searchParams.column == column) ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc';
                this.$router.push({path: `/entry/${this.model_id}`, query: this.searchParams });
            },
            deleteRow(model) {
                let confirm = window.confirm("Delete " + model.title + "?");

                if(confirm) {
                    axios.delete(`/api/content-entry/${model._id}`)
                        .then(() => {
                            this.$store.commit('updateErrorMessage', []);
                            this.$store.commit('updateSuccessMessage', model.title + " was deleted");
                            this.getEntries(this.$route.query);
                        }).catch(() => {
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', [model.title + " wasn't deleted"]);
                    });
                }
            },
            getEntries(query) {
                let params = Object.assign(this.searchParams, query);
                params = Object.assign({model_id: this.model_id}, this.searchParams);
                this.$store.dispatch('getEntries', params);
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.model_id = to.params.model;
            this.getEntries(to.query);
            next();
        },
        mounted() {
            this.$store.commit('updateTitlePage', 'Entries');
            this.getEntries({});
        }
    }
</script>

<style scoped>
    table thead th {
        user-select: none;
    }
</style>