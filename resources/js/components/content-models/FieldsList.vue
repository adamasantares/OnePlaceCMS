<template>
    <DraggableTree :data="fields" @drop="drop" draggable="draggable" :cross-tree="false">
        <content-field slot-scope="{data, store}" :field-prop="data"></content-field>
    </DraggableTree>
</template>

<script>
    import {DraggableTree} from 'vue-draggable-nested-tree';
    import ContentField from './ContentField';

    export default {
        name: "FieldsList",
        components: {DraggableTree, ContentField},
        computed: {
            fields() {
                return this.$store.getters.contentModelsFields.map(function(field) {
                    return Object.assign({droppable: false}, field);
                });
            }
        },
        methods: {
            drop(node, targetTree, oldTree) {
                let fields = targetTree.getPureData();
                let sortedFields = [];
                let element;

                fields.forEach((field) => {
                    element = this.$store.getters.contentModelsFields.find((fieldState) => {
                        if(fieldState.api_id == field.api_id) {
                            return fieldState;
                        }
                    });

                    sortedFields.push(element);
                });

                this.$store.commit('setContentFields', sortedFields);
            },
        }
    }
</script>

<style lang="scss">
    .he-tree{
        border: 1px solid #ccc;
        padding: 20px;
    }

    .tree-node-inner {
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }

    .draggable-placeholder-inner{
        border: 1px dashed #0088F8;
        box-sizing: border-box;
        background: rgba(0, 136, 249, 0.09);
        color: #0088f9;
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
    }
    .tree3{
        .tree-node-inner{
            border: none;
            padding: 0px;
        }
        .tree-node-inner-back:hover{
            background: #ddd;
        }
    }

    .tree4{
        .tree-node-inner{
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 5px 10px;
            backgroud: #ccc;
        }
        .draggable-placeholder-inner{
            background-color: orangered;
        }
    }
</style>