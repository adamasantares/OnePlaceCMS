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
                <template v-if="!rows.data || !rows.data.length">
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
                            <router-link :to="{ path: `/model/edit/${model._id}` }" class="btn btn btn-primary" >
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

    export default {
        name: 'list',
        mixins: [FunctionsMixin],
        data() {
            return {
                base_path: '/model',
                base_path_api: '/api/content-model/',
            }
        },
        computed: {
            rows() {
                return this.$store.getters.contentModels;
            },
        },
        methods: {
            getRows(query) {
                Object.assign(this.searchParams, query);
                this.$store.dispatch('getContentModels', this.searchParams);
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.getRows(to.query);
            next();
        },
        mounted() {
            this.$store.commit('updateTitlePage', 'Models');
            this.getRows({});
        }
    }
</script>

<style scoped>
    table thead th {
        user-select: none;
    }
</style>
