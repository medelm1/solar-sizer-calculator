import AuthLayout from '@/layouts/AuthLayout.vue';

export default {
    path: '/',
    component: AuthLayout,
    children: [
        {
            path: '',
            component: () => import('@/views/auth/LoginView.vue'),
            name: 'auth.login'
        }
    ]
};