<template>
    <div>
        <table class="table table-bordered table-striped dataTable" role="grid" >
            <thead>
                <tr role="row">
                    <th @click="sortTable(sortObjForTitle)" :class="classObjectForTitleColumn">
                        Title
                    </th>
                    <th @click="sortTable(sortObjForPublished)" :class="classObjectForPublishedColumn" style="width: 200px">
                        Published
                    </th>
                    <th @click="sortTable(sortObjForDateCreated)" :class="classObjectForDateCreatedColumn" style="width: 200px">
                        Date create
                    </th>
                    <th @click="sortTable(sortObjForDateUpdated)" :class="classObjectForDateUpdatedColumn" style="width: 200px">
                        Date update
                    </th>
                    <th style="width: 84px">Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="contentModels.data === undefined || !contentModels.data.length">
                    <tr role="row" class="odd">
                        <td colspan="5" class="text-center"><h2>No data available</h2></td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="model in contentModels.data" :key="model.id">
                        <td>{{ model.title }}</td>
                        <td>{{ model.published ? 'Published' : 'Not published' }}</td>
                        <td>{{ model.created_at }}</td>
                        <td>{{ model.updated_at }}</td>
                        <td>
                            <router-link :to="{ path: `/content/model/${model._id}` }" class="btn btn btn-primary" >
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a @click.prevent="deleteModel(model)" href="#" title="Delete" class="btn btn btn-danger">
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
        <pagination :currentPage="contentModels.current_page" :lastPage="contentModels.last_page"></pagination>
    </div>
</template>

<script>
    import Pagination from '../template-components/Pagination';

    export default {
        name: 'list',
        components: {
            Pagination
        },
        computed: {
            contentModels() {
                return this.$store.getters.contentModels;
            },
            startSearchParams() {
                return {
                    column: this.$route.query.column ? this.$route.query.column : 'created_at',
                    sort: this.$route.query.column ? this.$route.query.sort : 'desc',
                    search: this.$route.query.search ? this.$route.query.search : '',
                    page: this.$route.query.page ? this.$route.query.page : 1
                }
            },
            searchParams() {
                return this.$store.getters.searchParams;
            },
            sortObjForTitle() {
                return {
                    'column': 'title',
                    'sort': (this.searchParams.column == 'title') ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc'
                }
            },
            sortObjForPublished() {
                return {
                    'column': 'published',
                    'sort': (this.searchParams.column == 'published') ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc'
                }
            },
            sortObjForDateCreated() {
                return {
                    'column': 'created_at',
                    'sort': (this.searchParams.column == 'created_at') ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc'
                }
            },
            sortObjForDateUpdated() {
                return {
                    'column': 'updated_at',
                    'sort': (this.searchParams.column == 'updated_at') ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc'
                }
            },
            classObjectForTitleColumn: function () {
                return {
                    sorting_asc: this.searchParams.column == 'title' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'title' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'title'
                }
            },
            classObjectForPublishedColumn: function () {
                return {
                    sorting_asc: this.searchParams.column == 'published' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'published' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'published'
                }
            },
            classObjectForDateCreatedColumn: function () {
                return {
                    sorting_asc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'created_at'
                }
            },
            classObjectForDateUpdatedColumn: function () {
                return {
                    sorting_asc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'asc',
                    sorting_desc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'desc',
                    sorting: this.searchParams.column != 'updated_at'
                }
            }
        },
        methods: {
            sortTable(sortObj) {
                let params = {};
                params.column = sortObj.column;
                params.sort = sortObj.sort;
                params.search = this.searchParams.search;
                params.page = this.searchParams.page;

                this.$store.dispatch('updateSearchParams', params);
            },
            deleteModel(model) {
                let confirm = window.confirm("Delete " + model.title + "?");

                if(confirm) {
                    axios.delete(`/api/content-model/${model._id}`)
                        .then(() => {
                            this.$store.commit('updateErrorMessage', []);
                            this.$store.commit('updateSuccessMessage', model.title + " was deleted");
                            this.$store.dispatch('getContentModels', this.$route.query);
                        }).catch(() => {
                            this.$store.commit('updateSuccessMessage', "");
                            this.$store.commit('updateErrorMessage', [model.title + " wasn't deleted"]);
                        });
                }

            }
        },
        watch: {
            searchParams: function (obj) {
                this.$router.push({path: '/content/model', query: obj });
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.$store.dispatch('getContentModels', to.query);
            next();
        },
        mounted() {
            this.$store.commit('updateTitlePage', 'Models');
            this.$store.dispatch('updateSearchParams', this.startSearchParams);
            this.$store.dispatch('getContentModels', this.$route.query);
        }
    }
</script>

<style scoped>
    table thead th {
        user-select: none;
    }
</style>
