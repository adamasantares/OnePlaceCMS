<template>
    <div class="form-group">
        <label :for="field.api_id">{{ field.name }}</label>
        <datepicker :id="field.api_id"
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
            if(this.model.$date) {
                let date = new Date();

                date.setTime(this.model.$date.$numberLong);

                this.value = date;
            }
        }
    }
</script>

<style scoped>

</style>
