<template>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a @click="sidebarShowToggle" class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "sidebar-toggle",
        methods: {
            sidebarShowToggle() {
                this.$store.commit('sidebarShowToggle');
            }
        },
        computed: {
            sidebarShow() {
                return this.$store.getters.sidebarShow
            }
        },
        watch: {
            sidebarShow(bool) {
                let body = document.getElementsByTagName('body')[0];
                bool ? body.className = "sidebar-mini sidebar-open" : body.className = "sidebar-mini sidebar-collapse";
            }
        }
    }
</script>

<style scoped>

</style>