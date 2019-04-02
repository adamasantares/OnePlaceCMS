<template>
    <form @submit.prevent="saveModel">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Model</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title-field">Title</label>
                                        <input v-model="fields.title" id="title-field" class="form-control"
                                               :class="errors && errors.title ? 'is-invalid' : ''">
                                        <div v-if="errors && errors.title" class="invalid-feedback">{{ errors.title[0] }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="id-field">Api Identifier</label>
                                        <input v-model="fields.api_id" id="id-field" class="form-control"
                                               :class="errors && errors.api_id ? 'is-invalid' : ''">
                                        <div v-if="errors && errors.api_id" class="invalid-feedback">{{ errors.api_id[0] }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc-field">Description</label>
                                        <textarea v-model="fields.desc" id="desc-field" class="form-control"
                                                  :class="errors && errors.desc ? 'is-invalid' : ''"
                                                  rows="5">
                                        </textarea>
                                        <div v-if="errors && errors.desc" class="invalid-feedback">{{ errors.desc[0] }}</div>
                                    </div>
                                </div>
                                <div class="col-5 offset-1">
                                    <div class="clearfix mb-3">
                                        <button class="btn btn-primary pull-right" @click="addChild">Add child</button>
                                    </div>

                                    <DraggableTree :data="treeData" draggable="draggable" :cross-tree="false">
                                        <div slot-scope="{data, store}">
                                            <template>
                                                <span>{{data.text}}</span>
                                            </template>
                                        </div>
                                    </DraggableTree>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <input class="btn btn-success" name="save" type="submit" value="Save">
                    <router-link to="/content/model" class="btn btn-default">Close</router-link>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
    </form>
</template>

<script>
    import {DraggableTree} from 'vue-draggable-nested-tree';

    export default {
        name: "Create",
        components: {DraggableTree},
        data() {
            return {
                fields: {
                    title: '',
                    api_id: '',
                    desc: ''
                },
                errors: [],
                treeData: [
                    {text: 'node 1', droppable: false},
                    {text: 'node 2', droppable: false}
                ]
            }
        },
        methods: {
            saveModel() {
                axios.post('/api/content-model', this.fields).then(response => {
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', this.fields.title + " was created");
                    this.errors = [];
                    this.fields = {};
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Model wasn't created"]);
                    } else {
                        this.errors = [];
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Error occurred while saving new model"]);
                    }
                });
            },
            addChild() {
                this.treeData.push({text: 'child', droppable: false})
            }
        },
        created() {
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