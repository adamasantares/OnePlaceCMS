<template>
    <div id="main">
        <template v-if="$route.meta.emptyLayout">
            <router-view></router-view>
        </template>
        <template v-else>
            <Header/>
            <Sidebar/>
            <div class="content-wrapper" style="min-height: 933px;">
                <title-header></title-header>
                <div class="content">
                    <success-messages></success-messages>
                    <error-messages></error-messages>
                    <router-view></router-view>
                </div>
                <!-- /.content -->
            </div>
            <Footer/>
        </template>
    </div>
</template>

<script>
    import Header from './template-components/Header.vue';
    import TitleHeader from './template-components/TitleHeader.vue';
    import Sidebar from './sidebar/Sidebar.vue';
    import SuccessMessages from './template-components/SuccessMessages.vue';
    import ErrorMessages from './template-components/ErrorMessages.vue';
    import Footer from './template-components/Footer.vue';

    export default {
        name: 'main-app',
        components: {
            Header, TitleHeader, Sidebar, SuccessMessages, ErrorMessages, Footer
        }
    }
</script>
