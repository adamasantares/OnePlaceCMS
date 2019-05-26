<template>
    <div id="textFieldModal">
        <div :class="{ show: isOpened }" :style="{ display: this.isOpened ? 'block' : 'none' }"
             class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header">
                            <h5 class="modal-title">Create field</h5>
                            <ul class="nav nav-pills pull-right" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a :class="activeTab == 'settings' ? 'active' : ''" @click="setActiveTab('settings')" class="nav-link" href="#">Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a :class="activeTab == 'validations' ? 'active' : ''" @click="setActiveTab('validations')" class="nav-link" href="#">Validations</a>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div :class="activeTab == 'settings' ? 'show active' : ''" class="tab-pane fade" >
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name-input">Name</label>
                                                <input v-model="fields.name" id="name-input" type="text"
                                                       class="form-control"
                                                       :class="errors && errors.name ? 'is-invalid' : ''"
                                                       placeholder="Enter name">
                                                <div v-if="errors && errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="id-input">Field ID</label>
                                                <input v-model="fields.api_id" id="id-input" type="text"
                                                       class="form-control"
                                                       :class="errors && errors.api_id ? 'is-invalid' : ''"
                                                       placeholder="Enter field ID"
                                                       :readonly="fields._id"
                                                       >
                                                <div v-if="errors && errors.api_id" class="invalid-feedback">{{ errors.api_id[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div :class="activeTab == 'validations' ? 'show active' : ''" class="tab-pane fade" >
                                    <text-validations v-if="fieldType == 'text'"></text-validations>
                                    <image-validations v-if="fieldType == 'media'"></image-validations>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-success" name="save" type="submit" value="Save">
                            <button @click="resetFields(); closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div @click="resetFields(); closeModal()" v-if="isOpened" class="modal-backdrop fade show"></div>
    </div>
</template>

<script>
    import TextValidations from "./fields-validations/TextValidations";
    import ImageValidations from "./fields-validations/ImageValidations";

    export default {
        name: "CreateFieldModal",
        components: {
            TextValidations, ImageValidations
        },
        data() {
            return {
                activeTab: 'settings',
                errors: [],
            }
        },
        computed: {
            isOpened() {
                return this.$store.getters.isFieldFormDisplayed;
            },
            contentFields() {
                return this.$store.getters.contentModelsFields;
            },
            fields() {
                return {
                    _id: this.$store.getters.currentContentField._id,
                    name: this.$store.getters.currentContentField.name,
                    api_id: this.$store.getters.currentContentField.api_id,
                    type: this.$store.getters.currentContentField.type,
                    validations: this.$store.getters.currentContentField.validations
                }
            },
            fieldType() {
                return this.$store.getters.currentContentField.type;
            },
            validations() {
                return this.$store.getters.currentValidationsRules;
            }
        },
        methods: {
            closeModal() {
                this.$store.commit('updateFieldFormDisplay', false);
            },
            setActiveTab(tab) {
                this.activeTab = tab;
            },
            resetFields() {
                this.activeTab = 'settings';
                this.errors = [];
                this.$store.commit('resetCurrentContentField');
                this.$store.commit('resetCurrentValidationsRules');
            },
            validateUniqueApiIdByFieldsInStorage() {
                    var self = this;

                    let isInvalid = this.contentFields.find(function (field) {
                            return field._id != self.fields._id && field.api_id === self.fields.api_id;
                        }
                    );

                    return !Boolean(isInvalid);
            },
            validateOnServer() {
                return axios.post('/api/content-field/validate', this.fields);
            },
            submit() {
                let validate = this.validateUniqueApiIdByFieldsInStorage();

                if(!validate) {
                    this.errors = [];
                    this.errors['api_id'] = ['The api id has already been taken.'];
                    return false;
                }

                this.validateOnServer().then(
                    resolve => {
                        this.errors = [];

                        let field = Object.assign({}, this.fields);
                        field.validations = this.validations;

                        if(this.fields._id) {
                            this.$store.commit('updateContentField', field);
                        } else {
                            field._id = Date.now();
                            this.$store.commit('addContentField', field);
                        }

                        this.closeModal();
                        this.resetFields();
                    },
                    reject => {
                        if (reject.response.status === 422) {
                            this.errors = reject.response.data.errors || {};
                        }
                    }
                );
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
