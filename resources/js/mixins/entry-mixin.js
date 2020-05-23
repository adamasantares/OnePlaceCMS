import PublishToggle from "./../components/template-components/PublishToggle";

export default {
    components: {PublishToggle},

    data() {
        return {
            fields: {
                title: '',
                published: false,
                meta_content_id: this.$route.params.model,
                slug: '',
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
            this.fields.files[payload.slug] = [];

            payload['files'].forEach((file) => {
                this.fields.files[payload.slug].push(file);
            });
        },
        prepareDataForRequest() {
            console.log(this.fields.fields.fields);

            for (let [slug, field] of Object.entries(this.fields.fields)) {
                if(Array.isArray(field)) {
                    field.forEach((value, index) => {
                        this.formData.append('fields[' + index + '][' + index + ']', value);
                    });
                } else {
                    this.formData.append('fields[' + slug + ']', field);
                }
            }

            if(this.fields.files) {
                for (let [slug, file] of Object.entries(this.fields.files)) {
                    if(Array.isArray(file)) {
                        file.forEach((value, index) => {
                            this.formData.append('files[' + slug + '][' + index + ']', value);
                        });
                    } else {
                        this.formData.append('files[' + slug + ']', file);
                    }
                }
            }

            this.formData.append('title', this.fields.title);
            this.formData.append('published', this.fields.published);
            this.formData.append('meta_content_id', this.fields.meta_content_id);
            this.formData.append('slug', this.fields.slug);
        },
        getFields() {
            return new Promise((resolve, reject) => {
                axios.get(`/api/meta-content/${this.$route.params.model}`).then(response => {
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
            axios.get(`/api/content/${this.$route.params.id}`).then(response => {
                this.$store.commit('updateTitlePage', `Edit ${response.data.title}`);

                this.fields.id = response.data.id;
                this.fields.title = response.data.title;
                this.fields.published = response.data.published;
                this.fields.fields = response.data.fields || {};
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
