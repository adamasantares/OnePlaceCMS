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
    import ValidationMixin from '../../../mixins/ValidationFields';

    export default {
        name: "ImageValidations",
        mixins: [ValidationMixin],
        created() {
            if(!this.validations.mime) {
                this.validations.mime = [];
            }
        }
    }
</script>

<style scoped>

</style>