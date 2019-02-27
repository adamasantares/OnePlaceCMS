<template>
    <table class="table table-bordered table-striped dataTable" role="grid" >
        <thead>
            <tr role="row">
                <th>Title</th>
                <th style="width: 150px">Date create</th>
                <th style="width: 84px">Action</th>
            </tr>
        </thead>
        <tbody>

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

            <tr role="row" class="odd">
                <td colspan="4" class="text-center"><h2>No data available</h2></td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Date create</th>
                <th style="width: 84px">Action</th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (this.customers.length) {
                return;
            }

            this.$store.dispatch('getCustomers');
        },
        computed: {
            customers() {
                return this.$store.getters.customers;
            }
        }
    }
</script>

<style scoped>
    .card-title {
        margin: 0;
    }
</style>
