import AddFieldBtn from "./../components/content-models/AddFieldBtn";
import PublishToggle from "./../components/template-components/PublishToggle";
import FieldsList from "./../components/content-models/FieldsList";
import FieldModal from "./../components/content-models/FieldModal";

export default {
    components: {FieldModal, FieldsList, AddFieldBtn, PublishToggle},

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


    },

    created() {
        this.$store.commit('resetContentFields');
    }
}