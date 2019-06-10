<template>
    <div>
        <form @submit.prevent="save">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Entry</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body"  v-if="fieldsIsFilled">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="title-field">Title</label>
                                <input v-model="fields.title" id="title-field" class="form-control"
                                       :class="errors && errors.title ? 'is-invalid' : ''">
                                <div v-if="errors && errors.title" class="invalid-feedback">{{ errors.title[0] }}</div>
                            </div>
                            <text-field :model.sync="fields.title" :field="{api_id: 'title', name: 'Title'}" :errors="errors.title">
                            </text-field>
                        </div>
                        <div class="col-3">
                            <publish-toggle :published.sync="fields.published"></publish-toggle>
                        </div>
                    </div>

                    <div class="form-group"  v-for="field in modelFields">
                        <text-field v-if="field.type == 'text'"
                                    :model.sync="fields.fields[field.api_id]" :field="field" :errors="errors['fields.' + field.api_id]"
                        >
                        </text-field>

                        <template v-if="field.type == 'media'">
                            <media-field :api-id="field.api_id" :model-id="fields.model_id" :files-prop="fields.files[field.api_id] ? fields.files[field.api_id] : []" :label-prop="field.name"></media-field>
                        </template>

                        <template v-if="field.type == 'text_editor'">
                            <text-editor :model.sync="fields.fields[field.api_id]"
                                         :label="field.name"
                            ></text-editor>
                        </template>

                        <relation-field v-if="field.type == 'relation'"
                                        :model.sync="fields.fields[field.api_id]" :field="field" :errors="errors['fields.' + field.api_id]"
                        ></relation-field>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group pull-right" role="group" aria-label="...">
                        <input class="btn btn-success" name="save" type="submit" value="Save">
                        <router-link :to="`/entry/${fields.model_id}`" class="btn btn-default">Close</router-link>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
        </form>
    </div>
</template>

<script>
    import FunctionsMixin from '../../mixins/CreateAndUpdateEntry';
    import TextField from './fields/TextField';
    import MediaField from './fields/MediaField';
    import TextEditor from './fields/TextEditor';
    import RelationField from './fields/RelationField';

    export default {
        name: "Edit",
        mixins: [FunctionsMixin],
        components: {TextField, MediaField, TextEditor, RelationField},
        methods: {
            save() {
                this.fields.files = this.$store.getters.medias;

                axios.put(`/api/entry/${this.fields._id}`, this.fields).then(response => {
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', this.fields.title + " was updated");
                    this.errors = [];
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Entry wasn't updated"]);
                    } else {
                        this.errors = [];
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Error occurred while updating entry"]);
                    }
                });
            }
        },
        created() {
            this.getFields().then(resolve => {
                this.fillFields();
            });
        }
    }
</script>

<style scoped>

</style>