<template>
    <div v-if="pages.length" class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            <li class="paginate_button page-item previous" :class="{ disabled: (currentPage == 1) }">
                <a href="#" @click.prevent="changePage(1)" class="page-link">First</a>

            </li>

            <li class="paginate_button page-item" :class="{ disabled: (currentPage == 1) }">
                <a href="#" @click.prevent="changePage(currentPage - 1)" class="page-link">Prev</a>
            </li>


            <!--{{&#45;&#45; Pagination Elements &#45;&#45;}}-->
            <!--@foreach ($elements as $element)-->
            <!--{{&#45;&#45; "Three Dots" Separator &#45;&#45;}}-->
            <!--@if (is_string($element))-->
            <!--<li class="paginate_button page-item disabled">-->
                <!--<a href="{{ $url }}" data-dt-idx="3" tabindex="0" class="page-link">{{ $element }}</a>-->
            <!--</li>-->
            <!--@endif-->


            <li v-for="page in pages" class="paginate_button page-item" :class="{ active: (currentPage == page) }">
                <a href="#" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
            </li>


            <li class="paginate_button page-item" :class="{ disabled: (currentPage == lastPage) }">
                <a href="#" @click.prevent="changePage(currentPage + 1)" class="page-link">Next</a>
            </li>

            <li class="paginate_button page-item next" :class="{ disabled: (currentPage == lastPage) }">
                <a href="#" @click.prevent="changePage(lastPage)" class="page-link">Last</a>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        name: "pagination",
        props: {
            currentPage: Number,
            lastPage: Number
        },
        computed: {
            pages() {

                if(this.lastPage <= 1) {
                    return [];
                }

                let pagesArray = [];

                for (let page = 1; page <= this.lastPage; page++) {
                    pagesArray.push(page);
                }

                return pagesArray;
            }
        },
        methods: {
            changePage(page) {
                let query = Object.assign({}, this.$route.query, this.$route.query);
                query.page = page;

                this.$router.push({path: this.$route.path, query: query});
            }
        }
    }
</script>

<style scoped>

</style>