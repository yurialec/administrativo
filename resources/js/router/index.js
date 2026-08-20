import { createRouter, createWebHistory } from 'vue-router';

import adminRoutes from './admin';
import menuRoutes from './menus';
import roleRoutes from './roles';
import permissionRoutes from './permissions';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...adminRoutes,
        ...menuRoutes,
        ...roleRoutes,
        ...permissionRoutes
    ]
});

export default router;