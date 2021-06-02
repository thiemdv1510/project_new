/* eslint-disable linebreak-style */
import Home from '@/components/Home.vue';
import Login from '@/components/authentication/views/Login.vue';
import ForgotPassword from '@/components/authentication/views/ForgotPassword.vue';

export default [{
    path: '/login',
    name: 'Login',
    component: Login
}, {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: ForgotPassword
}, {
    path: '/',
    name: 'Home',
    component: Home,
    redirect: '/',
    meta: { requiresAuth: true },
    children: [{
        path: '/',
        component: () =>
            import('@/modules/dashboard/views/Dashboard.vue'),
        name: 'Dashboard',
        meta: { title: 'dashboard', requiresAuth: true, accessedBy: ['admin'] },
    }, {
        path: 'accounts',
        name: 'Accounts',
        redirect: 'accounts',
        meta: { title: 'Accounts', requiresAuth: true, accessedBy: ['admin'] },
        component: {
            render(c) {
                return c('router-view');
            },
        },
        children: [{
            path: '',
            component: () =>
                import('@/modules/account/views/List.vue'),
        },
        {
            path: 'profile/:id',
            name: 'Profile',
            component: () =>
                import('@/modules/account/views/Profile.vue'),
        },
        ],
    },
    {
        path: 'projects',
        name: 'Projects',
        redirect: 'projects',
        meta: { title: 'Projects', requiresAuth: true, accessedBy: ['admin'] },
        component: {
            render(c) {
                return c('router-view');
            },
        },
        children: [{
            path: '',
            component: () =>
                import('@/modules/project/views/List.vue'),
        },
        {
            path: 'create',
            name: 'Create',
            component: () =>
                import('@/modules/project/views/Create.vue'),
        },
        ],
    },
    {
        path: '*',
        name: 'Error Page',
        component: () =>
            import('@/modules/error/views/NotFound.vue')
    },
    ]
}];