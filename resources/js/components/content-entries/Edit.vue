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
                            <publish-toggle :is-published="fields.published" @onChangePublished="onChangePublished"></publish-toggle>
                        </div>
                    </div>

                    <div class="form-group" v-for="field in modelFields">
                        <label :for="field.api_id">{{ field.name }}</label>
                        <input :id="field.api_id" class="form-control"
                               v-model="fields.fields[field.api_id]"
                               :class="errors && errors[field.api_id] ? 'is-invalid' : ''">
                        <div v-if="errors && errors[field.api_id]" class="invalid-feedback">{{ errors[field.api_id][0] }}</div>
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

    export default {
        name: "Edit",
        mixins: [FunctionsMixin],
        methods: {
            save() {
                axios.put(`/api/content-entry/${this.fields._id}`, this.fields).then(response => {
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
            this.getFieldsFromModel().then(resolve => {
                this.fillFieldsFromModal();
            });
        }
    }
</script>

<style scoped>

</style>