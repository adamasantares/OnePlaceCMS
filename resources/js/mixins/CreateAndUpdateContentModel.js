
import AddFieldBtn from "./../components/content-models/AddFieldBtn";
import PublishToggle from "./../components/template-components/PublishToggle";
import FieldsList from "./../components/content-models/FieldsList";
import CreateFieldModal from "./../components/content-models/fieldsModals/CreateFieldModal";

export default {
    components: {CreateFieldModal, FieldsList, AddFieldBtn, PublishToggle},

    data() {
        return {
            fields: {
                title: '',
                api_id: '',
                desc: '',
                published: false
            },
            errors: []
        }
    },

    computed: {
        contentFields() {
            return this.$store.getters.contentModelsFields;
        }
    },

    methods: {
        onChangePublished(value) {
            this.fields.published = value;
        },

    },
    created() {
        this.$store.commit('resetContentFields');
    }
}