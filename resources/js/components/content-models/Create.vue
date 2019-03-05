<template>
    <div class="row">
        <div class="col-3">
            <DraggableTree :data="treeData" draggable="draggable" :cross-tree="false">
                <div slot-scope="{data, store}">
                    <template>
                        <span>{{data.text}}</span>
                    </template>
                </div>
            </DraggableTree>
        </div>
        <div class="col-3">
            <button class="btn btn-primary" @click="addChild">Add child</button>
        </div>
    </div>
</template>

<script>
    import {DraggableTree} from 'vue-draggable-nested-tree';
    import * as th from 'tree-helper';

    export default {
        name: "Create",
        components: {DraggableTree},
        data() {
            return {
                treeData: [
                    {text: 'node 1', droppable: false},
                    {text: 'node 2', droppable: false}
                ]
            }
        },
        methods: {
            addChild() {
                this.treeData.push({text: 'child', droppable: false})
            }
        },
        mounted() {
            this.$store.commit('updateTitlePage', 'Create new model');
        }
    }
</script>

<style lang="scss">
    .he-tree{
        border: 1px solid #ccc;
        padding: 20px;
    }
    .tree-node{
    }
    .tree-node-inner {
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .draggable-placeholder{

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