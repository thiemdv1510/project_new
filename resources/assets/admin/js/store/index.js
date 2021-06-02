import Vue from 'vue';
import Vuex from 'vuex';
import * as Cookies from 'js-cookie';
import createPersistedState from 'vuex-persistedstate';
import config from '@/library/config';
import storeAuth from '@/components/authentication/store';
import storeLoading from '@/modules/loading/store';
import storeLang from '@/modules/lang/store';
import storeAside from '@/components/aside/store';
import storeAccounts from '@/modules/account/store';
import storeProjects from '@/modules/project/store';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        storeAuth,
        storeLoading,
        storeLang,
        storeAside,
        storeAccounts,
        storeProjects
    },
    plugins: [createPersistedState({
        key: 'admin',
        paths: [
            'storeAuth.token',
            'storeAuth.user',
            'storeLang.current'
        ],
        getState: (key) => Cookies.getJSON(key),
        setState: (key, state) => Cookies.set(key, state, {
            expires: config.cookie.lifespan,
            secure: config.cookie.secure,
        }),
    })],
});