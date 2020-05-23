<template>
    <div>
        <form @submit.prevent="save">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Entry</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <text-field :model.sync="fields.title" :field="{slug: 'title', title: 'Title'}" :errors="errors.title">
                            </text-field>
                        </div>
                        <div class="col-3">
                            <publish-toggle :published.sync="fields.published"></publish-toggle>
                        </div>
                    </div>

                    <div class="form-group" v-for="field in modelFields">
                        <text-field v-if="field.type == 'text'"
                                    :model.sync="fields.fields[field.slug]" :field="field" :errors="errors['fields.' + field.slug]"
                        >
                        </text-field>

                        <template v-if="field.type == 'media'">
                            <media-field :slug="field.slug" :label="field.title"
                                         :errors="errors['files.' + field.slug]"
                                         @uploadFiles="filesUploaded"></media-field>
                        </template>

                        <text-editor v-if="field.type == 'text_editor'"
                                    :model.sync="fields.fields[field.slug]"
                                     :label="field.title"
                        ></text-editor>

                        <relation-field v-if="field.type == 'relation'"
                                     :model.sync="fields.fields[field.slug]" :field="field"
                        ></relation-field>

                        <date-field v-if="field.type == 'date'"
                                    :model.sync="fields.fields[field.slug]"
                                    :field="field"
                                    :errors="errors['fields.' + field.slug]"
                        ></date-field>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group pull-right" role="group" aria-label="...">
                        <input class="btn btn-success" name="save" type="submit" value="Save">
                        <router-link :to="`/entry/${fields.meta_content_id}`" class="btn btn-default">Close</router-link>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
        </form>
    </div>
</template>

<script>
    import FunctionsMixin from '../../mixins/entry-mixin';
    import MediaField from './fields/MediaUploadField';
    import TextEditor from './fields/TextEditor';
    import TextField from './fields/TextField';
    import RelationField from './fields/RelationField';
    import DateField from './fields/DateField';
    import { mapMutations } from 'vuex';

    export default {
        name: "Create",
        mixins: [FunctionsMixin],
        components: {MediaField, TextEditor, TextField, DateField, RelationField},
        methods: {
            ...mapMutations([
                'updateTitlePage'
            ]),
            save() {
                this.prepareDataForRequest();

                axios.post('/api/content',
                    this.formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', this.fields.title + " was created");
                    this.errors = [];
                    this.fields = {};

                    this.$router.push(`/entry/${this.$route.params.model}/edit/${response.data.id}`);

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Entry wasn't created"]);
                    } else {
                        this.errors = [];
                        this.$store.commit('updateSuccessMessage', "");
                        this.$store.commit('updateErrorMessage', ["Error occurred while saving new entry"]);
                    }
                });
            }
        },
        created() {
            this.getFields();
            this.updateTitlePage('Create entry');
        }
    }
</script>

<style lang="scss">

</style>
