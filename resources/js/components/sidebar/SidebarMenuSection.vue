<template>
    <li class="nav-item has-treeview" :class="{'menu-open': isOpen}">
        <a @click.prevent="toggleSection" href="#" class="nav-link" :class="{'active': subIsActive(section.link)}">
            <i class="nav-icon fa" :class="section.icon"></i>
            <p>
                {{ section.title }}
                <i class="fa fa-angle-left right"></i>
            </p>
        </a>
        <slide-up-down :active="isOpen" :duration="300">
            <ul class="nav nav-treeview" v-if="section.childs">
                <li class="nav-item" v-for="child in section.childs">
                    <router-link :to="child.link" class="nav-link">
                        <i class="fa nav-icon" :class="child.icon"></i>
                        <p>{{ child.title }}</p>
                    </router-link>
                </li>
            </ul>
        </slide-up-down>
    </li>
</template>

<script>
    export default {
        name: "sidebar-menu-section",
        data() {
            return {
                isOpen: false
            }
        },
        props: {
            section: Object
        },
        methods: {
            subIsActive(input) {
                const paths = Array.isArray(input) ? input : [input];

                return paths.some(path => {
                    return this.$route.path.indexOf(path) === 0;
                });
            },
            toggleSection() {
                this.isOpen = !this.isOpen;
            }
        },
        mounted() {
            if(this.subIsActive(this.section.link)) {
                this.isOpen = true;
            }
        }
    }
</script>

<style scoped>
    .nav-sidebar .nav-treeview {
        display: block;
    }
</style>