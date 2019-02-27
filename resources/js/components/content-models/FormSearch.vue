<template>
    <form style="padding: 0" role="search" action="">
        <div class="input-group add-on">
            <input class="form-control float-right"
                   placeholder="Search"
                   name="query-content-model"
                   type="text"
                   value="">
            <div class="input-group-append">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "FormSearch"
    }
</script>

<style scoped>

</style>