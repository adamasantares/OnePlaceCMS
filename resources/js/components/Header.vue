<template>
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

        <sidebar-toggle></sidebar-toggle>

        <ul class="navbar-nav ml-auto">

            <template v-if="currentUser">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        {{ currentUser.name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </template>

        </ul>
    </nav>

</template>

<script>
    import SidebarToggle from './sidebar/SidebarToggle.vue';

    export default {
        name: 'app-header',
        components: {
            SidebarToggle
        },
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
