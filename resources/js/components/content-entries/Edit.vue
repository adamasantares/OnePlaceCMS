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
                            <text-field :model.sync="fields.title" :field="{slug: 'title', title: 'Title'}" :errors="errors.title">
                            </text-field>
                        </div>
                        <div class="col-3">
                            <publish-toggle :published.sync="fields.published"></publish-toggle>
                        </div>
                    </div>

                    <div class="form-group"  v-for="field in modelFields">
                        <text-field v-if="field.type == 'text'"
                                    :model.sync="fields.fields[field.slug]" :field="field" :errors="errors['fields.' + field.slug]"
                        >
                        </text-field>

                        <template v-if="field.type == 'media'">
                            <media-field :slug="field.slug"
                                         :label="field.title"
                                         :uploaded-files-prop="uploadedFiles[field.slug]"
                                         :errors="errors['files.' + field.slug]"
                                         @uploadFiles="filesUploaded"
                                         @deleteUploadedFile="deleteUploadedFile" />
                        </template>

                        <template v-if="field.type == 'text_editor'">
                            <text-editor :model.sync="fields.fields[field.slug]"
                                         :label="field.title"
                            ></text-editor>
                        </template>

                        <relation-field v-if="field.type == 'relation'"
                                        :model.sync="fields.fields[field.slug]" :field="field" :errors="errors['fields.' + field.slug]"
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
    import TextField from './fields/TextField';
    import MediaField from './fields/MediaUploadField';
    import TextEditor from './fields/TextEditor';
    import DateField from './fields/DateField';
    import RelationField from './fields/RelationField';

    export default {
        name: "Edit",
        mixins: [FunctionsMixin],
        components: {TextField, MediaField, TextEditor, DateField, RelationField},
        methods: {
            deleteUploadedFile(fileid) {
                this.filesForDelete.push(fileid)
            },
            additionalPrepareDataForReqeust() {
                this.formData.append('_method', 'PATCH');

                this.filesForDelete.forEach((value, index) => {
                    this.formData.append('deleted_filesids[' + index + ']', value);
                });

                //if previously uploaded files exist. It for request validation

                Object.keys(this.uploadedFiles).map((objectKey) => {
                    let items = this.uploadedFiles[objectKey];
                    if(items.length > 0) {
                        this.formData.append('old_files_info[' + objectKey + ']', 'true');
                    }
                })

            },
            save() {
                this.prepareDataForRequest();
                this.additionalPrepareDataForReqeust();

                axios.post(`/api/content/${this.fields.id}`,
                    this.formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
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
