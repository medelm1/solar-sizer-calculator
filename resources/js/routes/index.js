import { createWebHistory, createRouter } from "vue-router";
import dashboardRouter from './dashboardRouter';
import authRouter from './authRouter';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        dashboardRouter,
        authRouter,
    ]
});

export default router;