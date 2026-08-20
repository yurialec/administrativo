import Menus from '../pages/Menus.vue';

export default [
    {
        path: '/admin/menus',
        name: 'admin.menus',
        component: Menus
    },
    {
        path: '/admin/menus/create',
        name: 'admin.menus.create',
        component: () => import('../pages/CreateMenu.vue')
    },
    {
        path: '/admin/menus/edit/:id',
        name: 'admin.menus.edit',
        component: () => import('../pages/EditMenu.vue'),
        props: true
    }
];