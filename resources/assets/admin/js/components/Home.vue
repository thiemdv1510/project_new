<template>
<div class="wrapper">
    <div class="vld-parent">
        <loading :active.sync="mainLoading.show"
        :can-cancel="true"
        :loader="'bars'"
        :color="'#766df4'"
        :opacity="0.3"
        :is-full-page="fullPage"></loading>
    </div>
    <app-navbar></app-navbar>
    <app-aside></app-aside>
    <div class="content-wrapper">
        <app-breadcrumd :list="listRoute"></app-breadcrumd>
        <section class="content">
            <div class="container-fluid">
                <router-view></router-view>
            </div>
        </section>
    </div>
    <app-footer></app-footer>
    <profile-modal></profile-modal>
    <change-password></change-password>
    <div class="control-sidebar-bg"></div>
</div>
</template>

<script>
import AppNavbar from '@/components/Navbar';
import AppAside from '@/components/aside/views/Aside';
import AppBreadcrumd from '@/components/Breadcrumb';
import AppFooter from '@/components/Footer';
import ProfileModal from '@/components/authentication/views/ProfileModal';
import ChangePassword from '@/components/authentication/views/ChangePassword';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

import {
    mapState
} from 'vuex';

export default {
    name: 'Home',
    components: {
        AppNavbar,
        AppAside,
        AppBreadcrumd,
        AppFooter,
        ProfileModal,
        ChangePassword,
        Loading
    },
    computed: {
        ...mapState({
            user: state => state.storeAuth.user,
            mainLoading: state => state.storeLoading.mainLoading
        }),
        listRoute() {
            return this.$route.matched;
        },
    },

    data() {
        return {
            isLoading: false,
            fullPage: true
        };
    },


    /**
     * Created with component
     */
    created() {
        /**
         * Do something
         */
    }
};
</script>
