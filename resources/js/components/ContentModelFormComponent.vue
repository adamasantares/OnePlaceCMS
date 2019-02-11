<template>
    <draggable v-model="myArray" class="dragArea list-group" :options="{group:'people'}">
        <li class="list-group-item"
            v-for="(element,index) in myArray">{{element.name}}
            <span>{{ element }}</span>
            <button @click="remove(index)">X
            </button>
        </li>
    </draggable>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        components: {
            draggable,
        },
        data: function() {
            return {
                myArray: [ {name :'test'},  {name: 'keks'}, {name : 'i'}, {name : 'will'}]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
