<template>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.required" id="required-rule">
            <label class="form-check-label" for="required-rule">
                Required
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.unique" id="unique-rule">
            <label class="form-check-label" for="unique-rule">
                Unique
            </label>
        </div>

        <b>Specific pattern</b>

        <div class="form-check">
            <input class="form-check-input" type="radio" v-model="validations.specific"  value="email" id="email">
            <label class="form-check-label" for="email">
                E-mail
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" v-model="validations.specific"  value="url" id="url">
            <label class="form-check-label" for="url">
                URL
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" v-model="validations.specific"  value="pattern" id="pattern">
            <label class="form-check-label" for="pattern">
                Regular pattern
            </label>
            <br>
            <input v-if="validations.specific == 'pattern'" class="form-control" type="text" v-model="validations.pattern">
        </div>

    </div>
</template>

<script>
    import ValidationMixin from '../../../mixins/ValidationFields';

    export default {
        name: "TextValidations",
        mixins: [ValidationMixin],
        computed: {
            validations: {
                get() {
                    return this.$store.getters.currentValidationsRules;
                },
                set(value) {
                    this.$store.commit('setCurrentValidationsRules', value);
                }
            }
        }
    }
</script>

<style scoped>

</style>