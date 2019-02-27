<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <form-search></form-search>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <a href="" class="btn btn-success pull-right btn-create">Create content model</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <router-view></router-view>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</template>

<script>
    import FormSearch from "./FormSearch";

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