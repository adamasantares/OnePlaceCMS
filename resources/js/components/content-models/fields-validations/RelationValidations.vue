<template>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.required" id="required-rule">
            <label class="form-check-label" for="required-rule">
                Required
            </label>
        </div>
        <div class="form-group">
            <label for="relation_type">Relation type</label>
            <select v-model="validations.relation_type" class="form-control" id="relation_type">
                <option value="one_to_many">One To Many</option>
            </select>
        </div>
        <div class="form-group">
            <label for="model">Content Model</label>
            <select v-model="validations.model" class="form-control" id="model">
                <option v-for="model in models" :value="model._id">{{ model.title }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import ValidationMixin from '../../../mixins/ValidationFields';

    export default {
        name: "RelationValidations",
        mixins: [ValidationMixin],
        computed: {
            models() {
                return this.$store.getters.allContentModels;
            }
        }
    }
</script>

<style scoped>

</style>