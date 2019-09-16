import Pagination from "./../components/template-components/Pagination";


export default {
    components: {Pagination},

    data() {
        return {
            page: this.$route.query.page ? +this.$route.query.page : 1,
            isLoaded: false
        }
    },

    computed: {

    },

    methods: {
        deleteRow(row) {
            let confirm = window.confirm("Delete " + row.title + "?");

            if(confirm) {
                axios.delete(`${this.base_path_api}${row._id}`)
                    .then(() => {
                        this.$store.commit('updateErrorMessage', []);
                        this.$store.commit('updateSuccessMessage', row.title + " was deleted");
                        this.getRows(this.$route.query);
                        this.$store.dispatch('getAllContentModels');
                    }).catch(() => {
                    this.$store.commit('updateSuccessMessage', "");
                    this.$store.commit('updateErrorMessage', [row.title + " wasn't deleted"]);
                });
            }
        },
    },

    created() {

    }
}