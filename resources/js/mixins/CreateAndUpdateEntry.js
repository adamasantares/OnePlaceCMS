import PublishToggle from "./../components/template-components/PublishToggle";

export default {
    components: {PublishToggle},

    data() {
        return {
            fields: {
                title: '',
                published: false,
                fields: {}
            },
            modelFields: [],
            errors: []
        }
    },

    computed: {

    },

    methods: {

        onChangePublished(value) {
            this.fields.published = value;
        },

        getFieldsFromModel() {
            new Promise((resolve, reject) => {
                axios.get(`/api/content-model/${this.$route.params.model}`).then(response => {
                    this.modelFields = response.data.fields;
                    this.errors = [];
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', "");
                    resolve();
                }).catch(error => {
                    this.errors = [];
                    this.$store.commit('updateSuccessMessage', "");
                    this.$store.commit('updateErrorMessage', ["Error occurred while building content model"]);
                    reject();
                });
            })
        },
        fillFieldsFromModal() {
            axios.get(`/api/content-entry/${this.$route.params.id}`).then(response => {
                this.fields.fileds = response.data;
                this.errors = [];
                this.$store.commit('updateErrorMessage', []);
                this.$store.commit('updateSuccessMessage', "");
            }).catch(error => {
                this.errors = [];
                this.$store.commit('updateSuccessMessage', "");
                this.$store.commit('updateErrorMessage', ["Error occurred while getting field values"]);
            });
        }

    },

    created() {

    }
}