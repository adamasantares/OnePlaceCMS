<template>
        <div class="form-group">
            <label style="display: block;">Published</label>
            <div class="btn-group btn-group-toggle published-toggle" data-toggle="buttons">
                <label :class="isPublished ? 'btn-success active' : 'btn-default'" class="btn">
                    <input type="radio" @click="onChangePublished(true)"><i class="fa fa-check" aria-hidden="true"></i> Published
                </label>
                <label :class="isPublished ? 'btn-default' : 'btn-danger active'" class="btn">
                    <input type="radio" @click="onChangePublished(false)"><i class="fa fa-times" aria-hidden="true"></i> Not published
                </label>
            </div>
        </div>
</template>

<script>
    export default {
        name: "PublishToggle",
        props: {
            isPublished: Boolean,
        },
        methods: {
            onChangePublished(value) {
                this.$emit('onChangePublished', value);
            }
        }
    }
</script>

<style scoped>

</style>