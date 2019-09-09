<template>
    <div class="row">
        <div class="col-lg-2 col-sm-4 col-12 cell">
            <label>{{ label }}
                <input type="file" :id="api_id" ref="files" multiple v-on:change="handleFilesUpload()"/>
            </label>
        </div>
        <div class="col-lg-10 col-sm-8 col-12 cell">
            <ul class="list-group" v-if="files.length || uploadedFiles.length ">
                <li class="list-group-item list-group-item-action clearfix" v-for="(file, index) in uploadedFiles">
                    <img :src="file.thumb" width="60">
                    <span>{{ file.name }} - {{ file.size }} Kb</span>
                    <button @click.prevent="deleteUploadedFile(file, index)" href="#" title="Delete" class="btn btn btn-danger pull-right"><i aria-hidden="true" class="fa fa-trash"></i></button>
                </li>

                <li class="list-group-item list-group-item-action clearfix" v-for="(file, index) in files">
                    <img :src="getUrlForThumb(file)" width="60">
                    <span>{{ file.name }} - {{ file.size }} Kb</span>
                    <button @click.prevent="deleteFile(file, index)" href="#" title="Delete" class="btn btn btn-danger pull-right"><i aria-hidden="true" class="fa fa-trash"></i></button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MediaUploadField",
        data(){
            return {
                files: [],
                uploadedFiles: []
            }
        },
        props: {
            label: String,
            api_id: String,
            uploadedFilesProp: {
                type: Array,
                default: []
            }
        },
        methods: {
            handleFilesUpload() {
                for (let [key, file] of Object.entries(this.$refs.files.files)) {
                    file.id = key;
                    this.files.push(file);
                }
                console.log({ files: this.files, api_id: this.api_id })
                this.$emit('uploadFiles', { files: this.files, api_id: this.api_id });
            },
            getUrlForThumb(file) {
                if(file.type == 'application/pdf') {
                    return '/images/icons/pdf-icon.png'
                }

                if(file.type.match('image.*')) {
                    return  URL.createObjectURL(file);
                }
            },
            deleteFile(file_name, index) {
                const confirm = window.confirm("Delete " + file_name + " ?");

                if(confirm) {
                    this.$delete(this.files, index);

                    this.$emit('uploadFiles', { files: this.files, api_id: this.api_id });
                }
            },
            deleteUploadedFile(file, index) {
                const confirm = window.confirm("Delete " + file.name + " ?");

                if(confirm) {
                    this.$delete(this.uploadedFilesProp, index);

                    this.$emit('deleteUploadedFile', file.id);
                }
            }
        },
        created() {
            this.uploadedFiles = this.uploadedFilesProp
        }
    }
</script>

<style scoped>

</style>
