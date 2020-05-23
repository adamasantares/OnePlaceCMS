<template>
    <div class="form-group">
        <label :for="field.slug">{{ field.title }}</label>
        <datepicker :id="field.slug"
                    :input-class="errors ? 'is-invalid form-control' : 'form-control'"
                    v-model="value"
        ></datepicker>
        <div v-if="errors" class="invalid-feedback">{{ errors[0] }}</div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        name: "DateField",
        components: {Datepicker},
        data() {
            return {
                value: null
            }
        },
        props: {
            model: {
                required: true
            },
            field: Object,
            errors: Array
        },
        watch: {
            value(value) {
                if(value === undefined) return

                const timestamp = value.getTime();

                this.$emit('update:model', timestamp);
            }
        },
        created() {
            //TODO refactor
            if(this.model) {
                let date = new Date();
                date.setTime(this.model);
                this.value = date;
            }
        }
    }
</script>

<style scoped>

</style>
