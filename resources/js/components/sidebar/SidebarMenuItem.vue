<template>
    <li class="nav-item">
        <router-link :to="item.link" class="nav-link">
            <i class="nav-icon fa" :class="item.icon"></i>
            <p>{{ item.title }}</p>
        </router-link>
    </li>
</template>

<script>
    export default {
        name: "SidebarMenuItem",
        props: {
            item: Object
        }
    }
</script>

<style scoped>

</style>