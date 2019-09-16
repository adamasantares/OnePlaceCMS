export default {
    props: {
        label: String,
        parameter: String,
        searchParams: Object
    },

    computed: {
        classObjectForCell() {
            return {
                sorting_asc: this.searchParams.column == this.parameter && this.searchParams.sort == 'asc',
                sorting_desc: this.searchParams.column == this.parameter && this.searchParams.sort == 'desc',
                sorting: this.searchParams.column != this.parameter
            }
        }
    },

    methods: {
        sortTable() {
            this.searchParams.column = this.parameter;
            this.searchParams.sort = (this.searchParams.column == this.parameter) ? (this.searchParams.sort == 'asc') ? 'desc' : 'asc' : 'asc';
            this.$router.push({path: this.base_path, query: this.searchParams });
        }
    }
}