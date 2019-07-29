<template>
    <div class="row">
        <div class="col-lg-2 col-sm-4 col-12 cell">
            <label>{{ label }}
                <input type="file" :id="api_id" ref="files" multiple v-on:change="handleFilesUpload()"/>
            </label>
        </div>
        <div class="col-lg-10 col-sm-8 col-12 cell">
            <ul class="list-group" v-if="files">
                <li class="list-group-item list-group-item-action clearfix" v-for="file in files">
                    <img :src="getUrlForFile(file)" width="60">
                    <span>{{ file.name }} - {{ file.size }} Kb</span>
                    <button @click.prevent="deleteFile(file)" href="#" title="Delete" class="btn btn btn-danger pull-right"><i aria-hidden="true" class="fa fa-trash"></i></button>
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
                files: []
            }
        },
        props: {
            label: String,
            api_id: String
        },
        methods: {
            handleFilesUpload(){
                for (let [key, file] of Object.entries(this.$refs.files.files)) {
                    file.id = key;
                    this.files.push(file);
                }

                this.$emit('uploadFiles', { files: this.files, api_id: this.api_id });
            },
            getUrlForFile(file) {
                if(file.type == 'application/pdf') {
                    return '/images/icons/pdf-icon.png'
                }

                if(file.type == 'image/png') {
                    return  URL.createObjectURL(file);
                }
            },
            deleteFile(file) {
                const confirm = window.confirm("Delete " + file.name + " ?");
                const file_id = file.id;

                if(confirm) {
                    this.files = this.files.filter((current_file) => {
                        if(current_file.id != file_id) {
                            return file;
                        }
                    });
                }
            },
            submitFiles(){
                console.log(this.files)
            },
        }
    }
</script>

<style scoped>

</style>