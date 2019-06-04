<template>
    <div :class="{ show: isOpened }" class="dropdown pull-right">
        <button @click="isOpened = !isOpened" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Add field
        </button>
        <div :class="{ show: isOpened }" class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a @click="addField('text')" class="dropdown-item" href="#">Text field</a>
            <a @click="addField('media')" class="dropdown-item" href="#">Media</a>
            <a @click="addField('text_editor')" class="dropdown-item" href="#">Text Editor</a>
            <a @click="addField('relation')" class="dropdown-item" href="#">Relation</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddFieldBtn",
        data() {
            return {
                isOpened: false
            }
        },
        methods: {
            addField(type) {
                this.isOpened = false;
                this.$store.commit('setCurrentContentField', {type: type});
                this.$store.commit('updateFieldFormDisplay', true);
            }
        }
    }
</script>

<style scoped>

</style>