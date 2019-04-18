<template>
    <div class="clearfix">
        <span>{{fieldProp.name}}</span>
        <div class="pull-right">
            <button @click.prevent="editField" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
            <button @click.prevent="deleteField" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContentField",
        props: {
            fieldProp: Object
        },
        methods: {
            editField() {
                this.$store.commit('setCurrentContentField', this.fieldProp);
                this.$store.commit('setCurrentValidationsRules', this.fieldProp.validations);
                this.$store.commit('updateFieldFormDisplay', true);
            },
            deleteField() {
                let confirm = window.confirm("Delete " + this.fieldProp.name + "?");

                if(confirm) {
                    this.$store.commit('removeContentField', this.fieldProp.api_id);
                }

            }
        }
    }
</script>

<style scoped>
    .tree-node.open.draggable-placeholder * {
        visibility: hidden;
    }
</style>