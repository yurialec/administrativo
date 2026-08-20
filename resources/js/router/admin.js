import Dashboard from '../pages/Dashboard.vue';

export default [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/',
        redirect: { name: 'dashboard' }
    }
];