<template>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                    <i class="nav-icon fa fa-dashboard"></i>
                    <p>Dashboard</p>
                </router-link>
            </li>
            <sidebar-menu-section v-for="section in sections" :key="section.title" :section="section"></sidebar-menu-section>
        </ul>
    </nav>
</template>

<script>
    import SidebarMenuSection from './SidebarMenuSection.vue';

    export default {
        name: "sidebar-menu",
        components: {
            SidebarMenuSection
        },
        data () {
            return {
                sections: [
                    {
                        title: 'Content',
                        link: '/content',
                        icon: 'fa-book',
                        childs: [
                            {
                                title: 'Models',
                                link: '/content/model',
                                icon: 'fa-archive'
                            },
                            {
                                title: 'Entries',
                                link: '/content/entry',
                                icon: 'fa-file-text'
                            }
                        ]
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>