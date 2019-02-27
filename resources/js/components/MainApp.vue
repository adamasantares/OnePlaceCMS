<template>
    <div id="main">
        <template v-if="$route.meta.emptyLayout">
            <router-view></router-view>
        </template>
        <template v-else>
            <Header/>
            <Sidebar/>
            <div class="content-wrapper" style="min-height: 933px;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1>
                                    Title
                                </h1>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="content">
                    <router-view></router-view>
                </div>
                <!-- /.content -->
            </div>
            <Footer/>
        </template>
    </div>
</template>

<script>
    import Header from './Header.vue';
    import Sidebar from './sidebar/Sidebar.vue';
    import Footer from './Footer.vue';

    export default {
        name: 'main-app',
        components: {
            Header, Sidebar, Footer
        }
    }
</script>
