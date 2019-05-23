<template>
    <div>
        {{ model }}
    </div>
</template>

<script>
    export default {
        name: "TextField",
        props: {
            model: {
                required: true
            },
            errors: Array
        },
        methods: {
            onChange: function () {
                vm.$emit('update:model', this.model);
            }
        }
    }
</script>

<style scoped>

</style>