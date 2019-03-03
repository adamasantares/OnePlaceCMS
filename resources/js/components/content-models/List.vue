<template>
    <div>
        <table class="table table-bordered table-striped dataTable" role="grid" >
            <thead>
                <tr role="row">
                    <th>
                        <router-link :to="{ path: '/content/model', query: searchParamsForTitleColumn}"  class="sorting page-link">Title</router-link>
                    </th>
                    <th class="sorting" style="width: 200px">
                        <router-link :to="{ path: '/content/model', query: searchParamsForDateCreate}"  class="sorting page-link">Date create</router-link>
                    </th>
                    <th class="sorting" @click="sortBy('date_update')" style="width: 200px">Date update</th>
                    <th style="width: 84px">Action</th>
                </tr>
            </thead>
            <tbody>

            <template v-if="contentModels.length === 0">
                <tr role="row" class="odd">
                    <td colspan="4" class="text-center"><h2>No data available</h2></td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="model in contentModels.data" :key="model.id">
                    <td>{{ model.title }}</td>
                    <td>{{ model.created_at }}</td>
                    <td>{{ model.updated_at }}</td>
                    <td>

                    </td>
                </tr>
            </template>

            <!--<tr>-->
            <!--<td>-->
            <!--{{ $model->title }}-->
            <!--</td>-->
            <!--<td>-->
            <!--{{ $model->published == 1 ? 'Published' : 'Not published' }}-->
            <!--</td>-->
            <!--<td>{{ $model->created_at }}</td>-->
            <!--<td style="width: 84px">-->
            <!--<form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('manage.content-model.destroy', $model)}}" method="post">-->
            <!--<input type="hidden" name="_method" value="DELETE">-->
            <!--{{ csrf_field() }}-->
            <!--<a class="btn btn btn-primary" href="{{route('manage.content-model.edit', $model)}}">-->
            <!--<i class="fa fa-edit"></i>-->
            <!--</a>-->
            <!--<button type="submit" class="btn btn btn-danger">-->
            <!--<i class="fa fa-trash" aria-hidden="true"></i>-->
            <!--</button>-->
            <!--</form>-->
            <!--</td>-->
            <!--</tr>-->



            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
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
        data() {
            return {
                sortColumn: "title",
                sortDirection: "asc"
            }
        },
        computed: {
            contentModels() {
                return this.$store.getters.contentModels;
            },
            searchParamsStart() {
                return {
                    'column': 'date_create',
                    'sort': 'desc',
                    'page': 1
                }
            },
            searchParamsForTitleColumn() {
                return {
                    'column': 'title',
                    'sort': (this.$route.query.column == 'title') ? (this.$route.query.sort == 'asc') ? 'desc' : 'asc' : 'asc',
                    'page': this.$route.query.page
                }
            },
            searchParamsForDateCreate() {
                return {
                    'column': 'date_create',
                    'sort': (this.$route.query.column == 'date_create') ? (this.$route.query.sort == 'asc') ? 'desc' : 'asc' : 'asc',
                    'page': this.$route.query.page
                }
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.$store.dispatch('getContentModels', this.searchParams);
            next();
        },
        mounted() {
            if (this.contentModels.length !== 0) {
                return;
            }

            this.$store.dispatch('getContentModels', this.searchParams);
        }
    }
</script>

<style scoped>
    .card-title {
        margin: 0;
    }
</style>
