<template>
    <th @click="sortTable()" :class="classObjectForCell">
        {{ this.label }}
    </th>
</template>

<script>
    import CellMixin from '../../mixins/header-cell-mixin';

    export default {
        name: "TableHeaderCell",
        mixins: [CellMixin],
    }
</script>

<style scoped>

</style>