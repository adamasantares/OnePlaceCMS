<template>
    <li v-if="currentUser" class="nav-item dropdown" :class="{show: isDropDownActive}">
        <a @click.prevent="toggleDropdown" class="nav-link dropdown-toggle" href="#">
            {{ currentUser.name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu" :class="{show: isDropDownActive}">
            <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
        </div>
    </li>
</template>

<script>
    export default {
        name: "LoginDropdown",
        data() {
            return {
                isDropDownActive: false,
                isDroDownOpen: false
            }
        },
        methods: {
            toggleDropdown() {
                this.isDropDownActive = !this.isDropDownActive;
                this.isDroDownOpen = !this.isDroDownOpen;
            },
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

<style scoped>

</style>