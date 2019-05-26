<template>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="validations.required" id="required-rule">
            <label class="form-check-label" for="required-rule">
                Required
            </label>
        </div>

        <div class="form-group">
            <label for="mime">File extensions</label>
            <select v-model="validations.mime" class="form-control" id="mime" multiple>
                <option value="jpeg">JPEG</option>
                <option value="jpg">JPG</option>
                <option value="png">PNG</option>
                <option value="gif">GIF</option>
                <option value="pdf">PDF</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ImageValidations",
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
        created() {
            if(!this.validations.mime) {
                this.$store.commit('setCurrentValidationsRules', { mime: [] });
            }
        }
    }
</script>

<style scoped>

</style>