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
                            <div class="form-group">
                                <label for="title-field">Title</label>
                                <input v-model="fields.title" id="title-field" class="form-control"
                                       :class="errors && errors.title ? 'is-invalid' : ''">
                                <div v-if="errors && errors.title" class="invalid-feedback">{{ errors.title[0] }}</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <publish-toggle :published.sync="fields.published"></publish-toggle>
                        </div>
                    </div>

                    <div class="form-group" v-for="field in modelFields">
                        <template v-if="field.type == 'text'">
                            <label :for="field.api_id">{{ field.name }}</label>
                            <input :id="field.api_id" class="form-control"
                                   v-model="fields.fields[field.api_id]"
                                   :class="errors && errors[field.api_id] ? 'is-invalid' : ''">
                            <div v-if="errors && errors[field.api_id]" class="invalid-feedback">{{ errors[field.api_id][0] }}</div>
                        </template>

                        <template v-if="field.type == 'media'">
                            <image-field :api-id="field.api_id" :files-prop="[]" :label-prop="field.name"></image-field>
                        </template>

                        <template v-if="field.type == 'text_editor'">
                            <text-editor :model.sync="fields.fields[field.api_id]"></text-editor>
                        </template>
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
    import ImageField from './fields/ImageField';
    import TextEditor from './fields/TextEditor';

    export default {
        name: "Create",
        mixins: [FunctionsMixin],
        components: {ImageField, TextEditor},
        methods: {
            save() {
                this.fields.files = this.$store.getters.medias;

                axios.post('/api/content-entry', this.fields).then(response => {
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', this.fields.title + " was created");
                    this.errors = [];
                    this.fields = {};

                    this.$router.push(`/entry/${this.$route.params.model}/edit/${response.data._id}`);

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
            this.getFieldsFromModel();
            this.$store.commit('updateTitlePage', 'Create entry');
        }
    }
</script>

<style lang="scss">

</style>