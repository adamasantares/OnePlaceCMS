import Pagination from "./../components/template-components/Pagination";


export default {
    components: {Pagination},

    data() {
        return {
            searchParams: {
                column: this.$route.query.column ? this.$route.query.column : 'created_at',
                sort: this.$route.query.sort ? this.$route.query.sort : 'desc',
                search: this.$route.query.search ? this.$route.query.search : '',
                page: this.$route.query.page ? +this.$route.query.page : 1
            },
            isLoaded: false
        }
    },

    computed: {
        classObjectForTitleColumn() {
            return {
                sorting_asc: this.searchParams.column == 'title' && this.searchParams.sort == 'asc',
                sorting_desc: this.searchParams.column == 'title' && this.searchParams.sort == 'desc',
                sorting: this.searchParams.column != 'title'
            }
        },
        classObjectForPublishedColumn() {
            return {
                sorting_asc: this.searchParams.column == 'published' && this.searchParams.sort == 'asc',
                sorting_desc: this.searchParams.column == 'published' && this.searchParams.sort == 'desc',
                sorting: this.searchParams.column != 'published'
            }
        },
        classObjectForDateCreatedColumn() {
            return {
                sorting_asc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'asc',
                sorting_desc: this.searchParams.column == 'created_at' && this.searchParams.sort == 'desc',
                sorting: this.searchParams.column != 'created_at'
            }
        },
        classObjectForDateUpdatedColumn() {
            return {
                sorting_asc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'asc',
                sorting_desc: this.searchParams.column == 'updated_at' && this.searchParams.sort == 'desc',
                sorting: this.searchParams.column != 'updated_at'
            }
        }
    },

    methods: {
        sortTable(column) {
            this.searchParams.column = column;
            this.searchParams.sort = (this.searchParams.column == column) ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc';
            this.$router.push({path: this.base_path, query: this.searchParams });
        },

        deleteRow(row) {
            let confirm = window.confirm("Delete " + row.title + "?");

            if(confirm) {
                axios.delete(`${this.base_path_api}${row._id}`)
                    .then(() => {
                        this.$store.commit('updateErrorMessage', []);
                        this.$store.commit('updateSuccessMessage', row.title + " was deleted");
                        this.getRows(this.$route.query);
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