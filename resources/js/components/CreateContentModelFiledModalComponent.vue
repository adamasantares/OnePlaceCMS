<template>
    <div id="chooseTypeFieldModal">

        <div :class="{ show: modalShow }" :style="{ display: this.modalShow ? 'block' : 'none' }"
             class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Choose field type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <figure class="field-type-item" @click="closeModal(); switchTextFieldModalShow(true)">
                                    <p><i class="fa fa-align-justify" aria-hidden="true"></i></p>
                                    <figcaption>Text input</figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div @click="closeModal" v-if="modalShow" class="modal-backdrop fade show"></div>

        <create-text-field-modal-component :modalShow="showTextFieldModal" @switchModalShow="switchTextFieldModalShow"></create-text-field-modal-component>
    </div>
</template>

<script>
    export default {
        props: {
            modalShow: Boolean
        },
        data() {
            return {
                showTextFieldModal: false
            }
        },
        methods: {
            closeModal: function() {
                this.$emit('switchModalShow', false)
            },
            switchTextFieldModalShow: function(bool) {
                this.showTextFieldModal = bool;
                document.getElementsByTagName('body')[0].style.overflow = bool ? 'hidden' : 'auto';
            }
        }
    }
</script>

