export default {
    data() {
        return {}
    },

    computed: {
        validations: {
            get() {
                return this.$store.getters.currentValidationsRules;
            },
            set(value) {
                this.$store.commit('setCurrentValidationsRules', value);
            }
        }
    },

    methods: {}
}