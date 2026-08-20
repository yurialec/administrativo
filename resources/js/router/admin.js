import Dashboard from '../pages/Dashboard.vue';

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard
    },
    {
        path: '/admin',
        redirect: { name: 'admin.dashboard' }
    }
];