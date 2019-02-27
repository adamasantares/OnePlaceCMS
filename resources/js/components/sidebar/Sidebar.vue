<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">OnePlaceCMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="" class="d-block">{{ currentUser.name }}</a>
                </div>
            </div>

            <sidebar-menu></sidebar-menu>
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    import SidebarMenu from './SidebarMenu.vue';

    export default {
        name: "Sidebar",
        components: {
            SidebarMenu
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>

<style scoped>

</style>