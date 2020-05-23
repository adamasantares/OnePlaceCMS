<template>
    <div class="form-group">
        <label :for="field.slug">{{ field.title }}</label>
        <input :id="field.slug" class="form-control"
               v-model="value"
               :class="errors ? 'is-invalid' : ''">
        <div v-if="errors" class="invalid-feedback">{{ errors[0] }}</div>
    </div>
</template>

<script>
    export default {
        name: "TextField",
        data() {
            return {
                value: ''
            };
        },
        props: {
            model: {
                required: true
            },
            errors: Array,
            field: Object
        },
        watch: {
            value(value) {
                this.$emit('update:model', value);
            }
        },
        created() {
            if(this.model) {
                this.value = this.model;
            }
        }
    }
</script>

<style scoped>

</style>
