<template>
    <div id="textFieldModal">

        <div :class="{ show: modalShow }" :style="{ display: this.modalShow ? 'block' : 'none' }"
             class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <b-form @submit="onSubmit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Text field</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closeModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <b-tabs>
                                <b-tab title="Settings" active>
                                    <b-form-row>
                                        <b-col>
                                            <b-form-group label="Field name:"
                                                          label-for="fieldName">
                                                <b-form-input id="fieldName"
                                                              type="text"
                                                              v-model="form.name"
                                                              required
                                                              placeholder="Enter name of field">
                                                </b-form-input>
                                            </b-form-group>
                                        </b-col>

                                        <b-col>
                                            <b-form-group label="Field ID:"
                                                          label-for="exampleInput1">
                                                <b-form-input id="fieldID"
                                                              type="text"
                                                              v-model="form.id"
                                                              required
                                                              placeholder="Enter ID of field">
                                                </b-form-input>
                                            </b-form-group>
                                        </b-col>
                                    </b-form-row>

                                    <b-form-group label="Length of field">
                                        <b-form-radio-group id="lengthFieldRadio" v-model="length" name="lengthField">
                                            <b-form-radio value="short">Short text (max 255 characters)</b-form-radio>
                                            <b-form-radio value="long">Long text (max 50k characters)</b-form-radio>
                                        </b-form-radio-group>
                                    </b-form-group>

                                </b-tab>
                                <b-tab title="Validations">
                                    <b-form-group label="Validation rules">
                                        <b-form-checkbox-group stacked v-model="form.validations" name="validations" :options="validationOptions">
                                        </b-form-checkbox-group>
                                    </b-form-group>
                                </b-tab>
                            </b-tabs>
                        </div>
                        <div class="modal-footer">
                            <b-button type="submit" variant="primary">Create field</b-button>
                        </div>
                    </b-form>
                </div>
            </div>
        </div>
        <div @click="closeModal" v-if="modalShow" class="modal-backdrop fade show"></div>

    </div>
</template>

<script>
    export default {
        props: {
            modalShow: Boolean
        },
        data() {
            return {
                form: {
                    name: '',
                    id: '',
                    length: null,
                    validations: [],
                },
                validationOptions: [
                    {text: 'Required field', value: 'required'},
                    {text: 'Unique field', value: 'unique'},
                    {text: 'URL', value: 'url'},
                    {text: 'Email', value: 'email'},
                    {text: 'Limit character count', value: 'limit'},
                    {text: 'Match a specific pattern', value: 'pattern'}
                ]
            }
        },
        methods: {
            closeModal() {
                this.$emit('switchModalShow', false)
            },
            onSubmit (e) {
                e.preventDefault();
                alert(JSON.stringify(this.form));
            }
        }
    }
</script>

<style lang="scss">
    #textFieldModal {
        .tab-pane {
            padding: 20px 0;
        }

        .nav.nav-tabs {
            outline: none;
        }
    }
</style>
