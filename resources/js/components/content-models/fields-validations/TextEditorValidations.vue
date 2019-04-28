<template>
    <editor-content :editor="editor" />
</template>

<script>
    import { Editor, EditorContent } from 'tiptap'

    export default {
        name: "TextEditorValidations",
        components: {
            EditorContent,
        },
        data() {
            return {
                editor: null,
            }
        },
        mounted() {
            // Create an `Editor` instance with some default content. The editor is
            // then passed to the `EditorContent` component as a `prop`
            this.editor = new Editor({
                content: '<p>This is just a boring paragraph</p>',
            })
        },
        beforeDestroy() {
            // Always destroy your editor instance when it's no longer needed
            this.editor.destroy()
        },
    }
</script>

<style scoped>

</style>