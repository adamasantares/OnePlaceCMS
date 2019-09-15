import PublishToggle from "./../components/template-components/PublishToggle";

export default {
    components: {PublishToggle},

    data() {
        return {
            fields: {
                title: '',
                published: false,
                model_id: this.$route.params.model,
                fields: {},
                files: {},
            },
            filesForDelete: [],
            uploadedFiles: [],
            formData: new FormData(),
            modelFields: [],
            errors: [],
            fieldsIsFilled: false
        }
    },
    computed: {

    },
    methods: {
        filesUploaded(payload) {
            this.fields.files[payload.api_id] = [];

            payload['files'].forEach((file) => {
                this.fields.files[payload.api_id].push(file);
            });
        },
        prepareDataForRequest() {
            for (let [api_id, field] of Object.entries(this.fields.fields)) {
                if(Array.isArray(field)) {
                    field.forEach((value, index) => {
                        this.formData.append('fields[' + api_id + '][' + index + ']', value);
                    });
                } else {
                    this.formData.append('fields[' + api_id + ']', field);
                }
            }

            if(this.fields.files) {
                for (let [api_id, file] of Object.entries(this.fields.files)) {
                    if(Array.isArray(file)) {
                        file.forEach((value, index) => {
                            this.formData.append('files[' + api_id + '][' + index + ']', value);
                        });
                    } else {
                        this.formData.append('files[' + api_id + ']', file);
                    }
                }
            }

            this.formData.append('title', this.fields.title);
            this.formData.append('published', this.fields.published);
            this.formData.append('model_id', this.fields.model_id);
        },
        getFields() {
            return new Promise((resolve, reject) => {
                axios.get(`/api/content-model/${this.$route.params.model}`).then(response => {
                    this.modelFields = response.data.fields;
                    this.errors = [];
                    this.$store.commit('updateErrorMessage', []);
                    resolve();
                }).catch(error => {
                    this.errors = [];
                    this.$store.commit('updateSuccessMessage', "");
                    this.$store.commit('updateErrorMessage', ["Error occurred while building content model"]);
                    reject();
                });
            })
        },
        fillFields() {
            axios.get(`/api/entry/${this.$route.params.id}`).then(response => {

                this.$store.commit('updateTitlePage', `Edit ${response.data.title}`);

                this.fields._id = response.data._id;
                this.fields.title = response.data.title;
                this.fields.published = response.data.published;
                this.fields.fields = response.data.fields;
                this.fields.fields.files = [];
                this.uploadedFiles = response.data.uploadedFiles || [];
                this.fieldsIsFilled = true;

                this.errors = [];
                this.$store.commit('updateErrorMessage', []);
            }).catch(error => {
                this.errors = [];
                this.$store.commit('updateSuccessMessage', "");
                this.$store.commit('updateErrorMessage', ["Error occurred while getting field values"]);
            });
        }

    },

    created() {
        this.$store.commit('resetMedias');
    }
}
