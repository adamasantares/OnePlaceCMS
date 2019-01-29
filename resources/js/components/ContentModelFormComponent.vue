<template>
    <div class="container">
        <draggable v-model="myArray" :options="{group:'people'}" @start="drag=true" @end="drag=false">
            <div v-for="element in myArray" :key="element.id">{{element.name}}</div>
        </draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        components: {
            draggable,
        },
        data: function() {
            return {
                myArray: ['test', 'keks', 'i', 'will']
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
