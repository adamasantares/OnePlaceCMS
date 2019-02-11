<template>
    <div id="text-field-button">
        <figure class="field-type-item" @click="closeModal(); switchFieldModalShow(true)">
            <p><i class="fa fa-align-justify" aria-hidden="true"></i></p>
            <figcaption>Text input</figcaption>
        </figure>
        <create-text-field-modal-component :modalShow="showFieldModal" @switchModalShow="switchFieldModalShow"></create-text-field-modal-component>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                showFieldModal: false
            }
        },
        methods: {
            switchFieldModalShow: function(bool) {
                this.showFieldModal = bool;
                document.getElementsByTagName('body')[0].style.overflow = bool ? 'hidden' : 'auto';
            },
            closeModal: function() {
                this.$emit('closeModal')
            }
        }
    }
</script>
