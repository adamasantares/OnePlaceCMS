<template>
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date }}</strong>
    </footer>
</template>

<script>
    export default {
        name: "Footer",
        computed: {
            date() {
                return new Date().getFullYear();
            }
        }
    }
</script>

<style scoped>

</style>
