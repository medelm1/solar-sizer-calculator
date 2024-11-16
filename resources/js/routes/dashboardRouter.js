import MainLayout from '@/layouts/MainLayout.vue';

export default {
    path: '/account',
    component: MainLayout,
    children: [
        {
            path: '',
            component: () => import('@/views/dashboard/WelcomeView.vue'),
            name: 'account.welcome',
        },
        {
            path: 'appliances/create',
            component: () => import('@/views/dashboard/appliance/CreateApplianceView.vue'),
            name: 'account.create-appliance',
        },
        {
            path: 'categories',
            component: () => import('@/views/dashboard/category/ListCategoriesView.vue'),
            name: 'account.categories',
        },
        {
            path: 'categories/create',
            component: () => import('@/views/dashboard/category/CreateCategoryView.vue'),
            name: 'account.create-category',
        },
        {
            path: 'categories/edit/:categoryId',
            component: () => import('@/views/dashboard/category/EditCategoryView.vue'),
            name: 'account.edit-category',
        }
    ]
};