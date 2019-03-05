<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        {{ title }} {{   }}
                    </h1>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "TitleHeader",
        computed: {
            title() {
                return this.$store.getters.titlePage ? this.$store.getters.titlePage : '' ;
            }
        },
        watch: {
            title: function(value) {
                document.title = value;
            }
        }
    }
</script>

<style scoped>

</style>