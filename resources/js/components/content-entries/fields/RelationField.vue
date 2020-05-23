<template>
    <div class="form-group">
        <label>{{ field.title }}</label>
        <v-select
            v-if="isValuePrepared"
            :value="value"
            :options="entries"
            @input="setSelected"
            label="title"
            :reduce="option => option.id"
            multiple
            :class="errors ? 'is-invalid' : ''">
        </v-select>
        <div v-if="errors" class="invalid-feedback">{{ errors[0] }}</div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';

    export default {
        name: "RelationField",
        components: {vSelect},
        data() {
            return {
               entries: [],
               value: [],
               isValuePrepared: false
            }
        },
        props: {
            model: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            field: Object,
            errors: Array
        },
        methods: {
            getEntries() {
                axios.get(`/api/entry/${this.field.validations.model}/get-by-model`).then(response => {
                    this.entries = response.data;
                    this.$store.commit('updateErrorMessage', []);
                    this.$store.commit('updateSuccessMessage', "");
                    this.prepareSelectedValue();
                }).catch(error => {
                    this.$store.commit('updateSuccessMessage', "");
                    this.$store.commit('updateErrorMessage', ["Error occurred while building field"]);
                });
            },
            prepareSelectedValue() {
                this.value = this.entries.filter(entry => {
                    if(this.model.indexOf(entry.id) != -1) {
                        return true;
                    }
                });

                this.isValuePrepared = true;
            },
            setSelected(value) {
                this.$emit('update:model', value);
            }
        },
        created() {
            this.getEntries();
        }
    }
</script>

<style scoped>

</style>
