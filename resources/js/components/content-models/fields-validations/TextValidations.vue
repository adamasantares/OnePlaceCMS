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

        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.email" id="email-rule">
            <label class="form-check-label" for="email-rule">
                E-mail
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.url"  id="url-rule">
            <label class="form-check-label" for="url-rule">
                URL
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TextValidations",
        data() {
            return {
                validations: {

                }
            }
        },
        watch: {
            validations: {
                handler(){
                    this.$emit('update-validations', this.validations);
                },
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>