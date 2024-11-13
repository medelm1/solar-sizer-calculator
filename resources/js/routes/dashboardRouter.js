import MainLayout from '@/layouts/MainLayout.vue';

export default {
    path: '/account',
    component: MainLayout,
    children: [
        {
            path: '',
            component: () => import('@/views/dashboard/WelcomeView.vue'),
            name: 'account.welcome'
        }
    ]
};