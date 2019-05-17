<template>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <template v-for="section in sections">
                <sidebar-menu-section v-if="section.childs.length" :key="section.title" :section="section"></sidebar-menu-section>
                <sidebar-menu-item v-else :key="section.title" :item="section"></sidebar-menu-item>
            </template>
        </ul>
    </nav>
</template>

<script>
    import SidebarMenuSection from './SidebarMenuSection.vue';
    import SidebarMenuItem from './SidebarMenuItem.vue';

    export default {
        name: "sidebar-menu",
        components: {
            SidebarMenuItem,
            SidebarMenuSection
        },
        computed: {
            allContentModelsList() {
                let models = [...this.$store.getters.allContentModels];

                return models.map((model) => {
                    return Object.assign(model, {link: `/entry/${model._id}`, icon: 'fa-circle-o'});
                });
            },
            sections() {
                if(this.$store.currentUser && this.$store.currentUser.token) {
                    return [];
                }

                return [
                    {
                        title: 'Dashboard',
                        link: '/dashboard',
                        icon: 'fa-dashboard',
                        childs: []
                    },
                    {
                        title: 'Models',
                        link: '/model',
                        icon: 'fa-archive',
                        childs: []
                    },
                    {
                        title: 'Entries',
                        link: '/entry',
                        icon: 'fa-file-text',
                        childs: this.allContentModelsList
                    }
                ]
            }
        },
        created() {
            this.$store.dispatch('getAllContentModels');
        }
    }
</script>

<style scoped>

</style>