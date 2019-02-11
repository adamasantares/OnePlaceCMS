<template>
    <div id="createFieldModel">
        <button @click.prevent="switchModalShow(true)" class="btn btn-primary">Create field</button>
        <create-content-model-field-modal-component :modalShow="modalShow" @switchModalShow="switchModalShow" ></create-content-model-field-modal-component>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                modalShow: false
            }
        },
        methods: {
            switchModalShow: function(bool) {
                this.modalShow = bool;
                document.getElementsByTagName('body')[0].style.overflow = bool ? 'hidden' : 'auto';
            }
        }
    }
</script>
