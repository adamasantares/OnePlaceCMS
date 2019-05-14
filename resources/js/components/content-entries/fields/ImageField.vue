<template>
    <div class="media-full">
        <label>{{ labelProp }}</label>
        <div v-show="$refs.upload && $refs.upload.dropActive" class="drop-active">
            <h3>Drop files to upload</h3>
        </div>
        <div class="upload">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Thumb</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Speed</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="!files.length">
                        <td colspan="7">
                            <div class="text-center p-5">
                                <h4>Drop files anywhere to upload<br/>or</h4>
                                <label :for="apiId" class="btn btn-lg btn-primary">Select Files</label>
                            </div>
                        </td>
                    </tr>
                    <tr v-for="(file, index) in files" :key="file.id">
                        <td>{{index}}</td>
                        <td>
                            <img v-if="file.thumb" :src="file.thumb" width="40" height="auto" />
                            <span v-else>No Image</span>
                        </td>
                        <td>
                            <div class="filename">
                                {{file.name}}
                            </div>
                            <div class="progress" v-if="file.active || file.progress !== '0.00'">
                                <div :class="{'progress-bar': true, 'progress-bar-striped': true, 'bg-danger': file.error, 'progress-bar-animated': file.active}" role="progressbar" :style="{width: file.progress + '%'}">{{file.progress}}%</div>
                            </div>
                        </td>
                        <td>{{file.size | formatSize}}</td>
                        <td>{{file.speed | formatSize}}</td>

                        <td v-if="file.error">{{file.error}}</td>
                        <td v-else-if="file.success">success</td>
                        <td v-else-if="file.active">active</td>
                        <td v-else></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a :class="{'dropdown-item': true, disabled: file.active || file.success}" href="#" @click.prevent="file.active || file.success ? false :  onEditFileShow(file)">Edit</a>
                                    <a :class="{'dropdown-item': true, disabled: !file.active}" href="#" @click.prevent="file.active ? $refs.upload.update(file, {error: 'cancel'}) : false">Cancel</a>

                                    <a class="dropdown-item" href="#" v-if="file.active" @click.prevent="$refs.upload.update(file, {active: false})">Abort</a>
                                    <a class="dropdown-item" href="#" v-else-if="file.error && $refs.upload.features.html5" @click.prevent="$refs.upload.update(file, {active: true, error: '', progress: '0.00'})">Retry upload</a>
                                    <a :class="{'dropdown-item': true, disabled: file.success}" href="#" v-else @click.prevent="file.success ? false : $refs.upload.update(file, {active: true})">Upload</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" @click.prevent="$refs.upload.remove(file)">Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="media-foorer">
                <div class="btn-group">
                    <file-upload
                            class="btn btn-primary"
                            :post-action="routeLaravel"
                            :extensions="extensions"
                            :accept="accept"
                            :multiple="multiple"
                            :directory="directory"
                            :size="size || 0"
                            :thread="thread < 1 ? 1 : (thread > 5 ? 5 : thread)"
                            :headers="uploadHeaders"
                            :data="data"
                            drop="true"
                            :add-index="addIndex"
                            v-model="files"
                            @input-filter="inputFilter"
                            @input-file="inputFile"
                            @input="inputUpdate"
                            :input-id="apiId"
                            ref="upload">
                        Select
                        <i class="fa fa-plus"></i>
                    </file-upload>
                </div>
                <button type="button" class="btn btn-success" v-if="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true">
                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                    Start Upload
                </button>
                <button type="button" class="btn btn-danger"  v-else @click.prevent="$refs.upload.active = false">
                    <i class="fa fa-stop" aria-hidden="true"></i>
                    Stop Upload
                </button>
            </div>
        </div>


        <div :class="{'modal-backdrop': true, 'fade': true, show: editFile.show}" v-if="editFile.show"></div>
        <div :class="{modal: true, fade: true, show: editFile.show}"
             :style="toggleShowModal"
             id="modal-edit-file" tabindex="-1" role="dialog" aria-labelledby="mediaModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediaModalLongTitle">Edit file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="editFile.show = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="onEditorFile">
                        <div class="modal-body">
                            <div class="form-group" v-if="editFile.show && editFile.blob && editFile.type && editFile.type.substr(0, 6) === 'image/'">
                                <label>Image: </label>
                                <div class="edit-image">
                                    <img :src="editFile.blob" ref="editImage" />
                                </div>

                                <div class="edit-image-tool">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" @click="editFile.cropper.rotate(-90)" title="cropper.rotate(-90)"><i class="fa fa-undo" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-primary" @click="editFile.cropper.rotate(90)"  title="cropper.rotate(90)"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" @click="editFile.cropper.crop()" title="cropper.crop()"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-primary" @click="editFile.cropper.clear()" title="cropper.clear()"><i class="fa fa-remove" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click.prevent="editFile.show = false">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .media-full .btn-group .dropdown-menu {
        display: block;
        visibility: hidden;
        transition: all .2s
    }
    .media-full .btn-group:hover > .dropdown-menu {
        visibility: visible;
    }
    .media-full label.dropdown-item {
        margin-bottom: 0;
    }
    .media-full .btn-group .dropdown-toggle {
        margin-right: .6rem
    }
    .media-full .filename {
        margin-bottom: .3rem
    }
    .media-full .media-foorer {
        padding: .5rem 0;
        border-top: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }
    .media-full .edit-image img {
        max-width: 100%;
    }
    .media-full .edit-image-tool {
        margin-top: .6rem;
    }
    .media-full .edit-image-tool .btn-group{
        margin-right: .6rem;
    }
    .media-full .footer-status {
        padding-top: .4rem;
    }
    .media-full .drop-active {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        position: fixed;
        z-index: 9999;
        opacity: .6;
        text-align: center;
        background: #000;
    }
    .media-full .drop-active h3 {
        margin: -.5em 0 0;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 40px;
        color: #fff;
        padding: 0;
    }
    .media-full .table-responsive {
        overflow-x: visible;
    }
</style>

<script>
    import Cropper from 'cropperjs'
    import FileUpload from 'vue-upload-component'

    export default {
        components: {
            FileUpload,
        },
        data() {
            return {
                files: [],
                accept: 'image/png,image/gif,image/jpeg,image/webp,application/pdf',
                extensions: ['gif', 'jpg', 'jpeg','png', 'webp', 'pdf'],
                minSize: 1024,
                size: 1024 * 1024 * 10,
                multiple: true,
                directory: false,
                addIndex: false,
                thread: 3,
                routeLaravel: '/api/media',
                uploadHeaders: {
                    'Authorization': 'Bearer ' + this.$store.getters.currentUser.token,
                    '_method': 'post'
                },
                data: {
                    model_id: '',
                    field_api_id: ''
                },
                uploadAuto: false,
                addData: {
                    show: false,
                    name: '',
                    type: '',
                    content: '',
                },
                editFile: {
                    show: false,
                    name: '',
                }
            }
        },
        props: {
            apiId: String,
            modelId: String,
            filesProp: Array,
            labelProp: String
        },
        watch: {
            'editFile.show'(newValue, oldValue) {
                if (!newValue && oldValue) {
                    this.$refs.upload.update(this.editFile.id, { error: this.editFile.error || '' })
                }
                if (newValue) {
                    this.$nextTick(function () {
                        if (!this.$refs.editImage) {
                            return
                        }
                        let cropper = new Cropper(this.$refs.editImage, {
                            autoCrop: false,
                        })
                        this.editFile = {
                            ...this.editFile,
                            cropper
                        }
                    })
                }
            },
            'addData.show'(show) {
                if (show) {
                    this.addData.name = '';
                    this.addData.type = '';
                    this.addData.content = '';
                }
            },
        },
        methods: {
            inputFilter(newFile, oldFile, prevent) {
                if (newFile && !oldFile) {
                    // Before adding a file
                    // Filter system files or hide files
                    if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                        return prevent()
                    }
                    // Filter php html js file
                    if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                        return prevent()
                    }
                }
                if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
                    // Create a blob field
                    newFile.blob = ''
                    let URL = window.URL || window.webkitURL
                    if (URL && URL.createObjectURL) {
                        newFile.blob = URL.createObjectURL(newFile.file)
                    }
                    // Thumbnails
                    newFile.thumb = ''
                    if (newFile.blob && newFile.type.substr(0, 6) === 'image/') {
                        newFile.thumb = newFile.blob
                    }
                }
            },
            // add, update, remove File Event
            inputFile(newFile, oldFile) {
                if (newFile && oldFile) {
                    // update
                    if (newFile.active && !oldFile.active) {
                        // beforeSend
                        // min size
                        if (newFile.size >= 0 && this.minSize > 0 && newFile.size < this.minSize) {
                            this.$refs.upload.update(newFile, { error: 'size' })
                        }
                    }
                    if (newFile.progress !== oldFile.progress) {
                        // progress
                    }
                    if (newFile.error && !oldFile.error) {
                        // error
                    }
                    if (newFile.success && !oldFile.success) {
                        let self = this;
                        this.files.forEach(function(item, index){
                            if(item.id === newFile.id) {
                                self.files[index].name = newFile.response.name;
                                self.files[index].size = newFile.response.size;
                            }
                        });
                    }
                }
                if (!newFile && oldFile) {
                    // remove
                    if (oldFile.success && oldFile.response && oldFile.response.id) {
                        axios.post(this.routeLaravel + "/" + oldFile.response.id).then(response => (console.log(response)))
                            .catch((error) => {
                                console.log('fail');
                            });
                    }
                }
                // Automatically activate upload
                if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
                    if (this.uploadAuto && !this.$refs.upload.active) {
                        this.$refs.upload.active = true
                    }
                }

            },
            onEditFileShow(file) {
                this.editFile = { ...file, show: true }
                this.$refs.upload.update(file, { error: 'edit' })
            },
            onEditorFile() {
                if (!this.$refs.upload.features.html5) {
                    this.alert('Your browser does not support')
                    this.editFile.show = false
                    return
                }
                let data = {
                }
                if (this.editFile.cropper) {
                    let binStr = atob(this.editFile.cropper.getCroppedCanvas().toDataURL(this.editFile.type).split(',')[1])
                    let arr = new Uint8Array(binStr.length)
                    for (let i = 0; i < binStr.length; i++) {
                        arr[i] = binStr.charCodeAt(i)
                    }
                    data.file = new File([arr], data.name, { type: this.editFile.type })
                    data.size = data.file.size
                }
                this.$refs.upload.update(this.editFile.id, data)
                this.editFile.error = '';
                this.editFile.show = false
            },
            inputUpdate(files) {
                this.$store.commit('updateMedias', { key: this.apiId, files: files});
            },
            formatImagesDataFromServer(files) {
                this.files = files.map((file) => {
                    file.speed = 100;
                    file.active = false;
                    file.postAction = this.routeLaravel;
                    file.headers = this.uploadHeaders;
                    file.success = true;
                    file.progress = '0.00';
                    return file;
                });
            }
        },
        computed: {
            toggleShowModal: function() {
                return {
                    display: this.editFile.show ? 'block' : 'none'
                }
            }
        },
        mounted() {
            this.data.field_api_id = this.apiId;
            this.data.model_id = this.modelId;

            this.formatImagesDataFromServer(this.filesProp);
        }
    }
</script>