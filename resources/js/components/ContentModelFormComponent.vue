<template>
    <draggable v-model="myArray" class="dragArea list-group" :options="{group:'people'}">
            <div class="list-group-item list-group-item-action"
                v-for="(element,index) in myArray">{{element.name}}
                <span>{{ element }}</span>
                <button @click="remove(index)"
                        class="btn btn-default pull-right"
                >X
                </button>
            </div>
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
