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
                files: {}
            },
            modelFields: [],
            errors: [],
            fieldsIsFilled: false
        }
    },

    computed: {

    },

    methods: {

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
                this.fields.files = response.data.files;
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