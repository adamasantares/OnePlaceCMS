<template>
    <div>
        <label>{{ label }}</label>
        <textarea ref="editor"></textarea>
    </div>
</template>

<script>
    export default {
        name: "TextEditor",
        props : {
            model: {
                required: true
            },
            height: {
                type: String,
                default: '250'
            },
            label: {
                type: String
            }
        },
        mounted() {
            let config = {
                height: this.height,
                prettifyHtml: true,
                codemirror: {
                    theme: 'monokai',
                    htmlMode: true,
                    lineNumbers: true,
                    mode: 'text/html',
                },
                toolbar: [
                    ["style", ["style", "marcos"]],
                    ["font", ["bold", "underline", "clear"]],
                    ['fontsize', ['fontsize']],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture", "video"]],
                    ['cleaner', ['cleaner']],
                    ["view", ["fullscreen", "codeview", "help"]]
                ],
                fontSizes: ['10', '12', '16', '24', '36']
            };
            let vm = this;
            config.callbacks = {
                onInit: function () {
                    $(vm.$refs.editor).summernote("code", vm.model);
                },
                onChange: function () {
                    vm.$emit('update:model', $(vm.$refs.editor).summernote('code'));
                },
            };
            $(this.$refs.editor).summernote(config);
        }
    }
</script>

<style scoped>

</style>