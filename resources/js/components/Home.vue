<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ welcome }}</h3>
        </div>
        <div class="card-body">
            {{ welcome }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
        computed: {
            welcome() {
                return this.$store.getters.welcome
            }
        }
    }
</script>
