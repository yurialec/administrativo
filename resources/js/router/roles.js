import Roles from '../pages/Roles.vue';

export default [
    {
        path: '/admin/roles',
        name: 'admin.roles',
        component: Roles
    },
    {
        path: '/admin/roles/create',
        name: 'admin.roles.create',
        component: () => import('../pages/CreateRole.vue')
    },
    {
        path: '/admin/roles/edit/:id',
        name: 'admin.roles.edit',
        component: () => import('../pages/EditRole.vue'),
        props: true
    }
];