import { createRouter, createWebHistory } from 'vue-router';

import adminRoutes from './admin';
import menuRoutes from './menus';
import roleRoutes from './roles';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...adminRoutes,
        ...menuRoutes,
        ...roleRoutes
    ]
});

export default router;