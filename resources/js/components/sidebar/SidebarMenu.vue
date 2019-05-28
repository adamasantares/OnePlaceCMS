<template>
    <nav v-if="isLoggedIn" class="mt-2">
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
                let models = this.$store.getters.allContentModels;

                return models.map((model) => {
                    return Object.assign(model, {link: `/entry/${model._id}`, icon: 'fa-circle-o'});
                });
            },
            projects() {
                let models = this.$store.getters.projects;

                return models.map((model) => {
                    return Object.assign(model, {link: `/project/${model._id}`, icon: 'fa-circle-o'});
                });
            },
            sections() {
                return [
                    {
                        title: 'Projects',
                        link: '/project',
                        icon: 'fa-university',
                        childs: this.projects
                    },
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
            },
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            }
        },
        watch: {
            isLoggedIn: function (newValue, oldValue) {
                if(newValue === true && oldValue === false) {
                    this.$store.dispatch('getAllContentModels');
                    this.$store.dispatch('getAllProjects');
                }
            }
        },
        created() {
            if(this.isLoggedIn === true) {
                this.$store.dispatch('getAllContentModels');
                this.$store.dispatch('getAllProjects');
            }
        }
    }
</script>

<style scoped>

</style>