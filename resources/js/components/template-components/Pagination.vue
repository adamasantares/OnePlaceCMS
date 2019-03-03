<template>
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            <li class="paginate_button page-item previous" :class="{ disabled: (currentPage == 1) }">
                <router-link :to="{ path: '/content/model', query: { page: 1 }}"  class="page-link">First</router-link>
            </li>

            <li class="paginate_button page-item" :class="{ disabled: (currentPage == 1) }">
                <router-link :to="{ path: '/content/model', query: { page: currentPage - 1 }}"  class="page-link">Prev</router-link>
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
                <router-link :to="{ path: '/content/model', query: { page: page }}"  class="page-link">{{ page }}</router-link>
            </li>


            <li class="paginate_button page-item" :class="{ disabled: (currentPage == lastPage) }">
                <router-link :to="{ path: '/content/model', query: { page: currentPage + 1 }}"  class="page-link">Next</router-link>
            </li>

            <li class="paginate_button page-item next" :class="{ disabled: (currentPage == lastPage) }">
                <router-link :to="{ path: '/content/model', query: { page: lastPage }}"  class="page-link">Last</router-link>
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
            // fromPage() {
            //     return this.currentPage > 1 ? this.currentPage - 1 : 1;
            // },
            pages() {
                let pagesArray = [];
                // for (let page = this.fromPage; page <= this.lastPage; page++) {
                for (let page = 1; page <= this.lastPage; page++) {
                    pagesArray.push(page);
                }

                return pagesArray;
            }
        }
    }
</script>

<style scoped>

</style>