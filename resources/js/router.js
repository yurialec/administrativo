import { createRouter, createWebHistory } from 'vue-router';

import Dashboard from './pages/Dashboard.vue';
import Menus from './pages/Menus.vue';
import Perfis from './pages/Perfis.vue';


const routes = [
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: Dashboard
    },
    {
        path: '/admin/menus',
        name: 'admin.menus',
        component: Menus
    },
    {
        path: '/admin/menus/:id',
        name: 'admin.menus.show',
        component: () => import('./pages/ShowMenu.vue')
    },
    {
        path: '/admin/menus/create',
        name: 'admin.menus.create',
        component: () => import('./pages/CreateMenu.vue')
    },
    {
        path: '/admin/menus/edit/:id',
        name: 'admin.menus.edit',
        component: () => import('./pages/EditMenu.vue'),
        props: true
    },
    {
        path: '/admin/perfis',
        name: 'admin.perfis',
        component: Perfis
    },
    // {
    //     path: '/admin/permissoes',
    //     name: 'admin.permissoes',
    //     component: Permissoes
    // },
    // {
    //     path: '/admin/usuarios',
    //     name: 'admin.usuarios',
    //     component: Usuarios
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;