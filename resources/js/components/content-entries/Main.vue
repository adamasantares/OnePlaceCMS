<template>
    <div class="row">
        <div class="col-12">
            <template v-if="$route.meta.type == 'list'">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Entries</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            <form-search></form-search>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <router-link to="/model/create" class="btn btn-success pull-right btn-create">Create entry</router-link>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <router-view></router-view>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </template>
            <template v-else-if="$route.meta.type == 'view'">
                <router-view></router-view>
            </template>

            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</template>

<script>
    import FormSearch from "../template-components/FormSearch";

    export default {
        name: "content-models-main",
        components: {
            FormSearch
        }
    }
</script>

<style scoped>
    .card-title {
        margin: 0;
    }

    .btn-create {
        margin: 0 0 7px;
    }
</style>