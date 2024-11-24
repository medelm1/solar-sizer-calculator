<script setup>
import { useRouter } from 'vue-router';
import CategoryForm from '@/components/CategoryForm.vue';
import { categoryService } from '@/services';
import { useCategoryStore } from '@/stores';
import { notification } from '@/utils';

const router = useRouter();
const categoryStore = useCategoryStore();

async function handleSubmit(category) {
    try {
        const newCategory = await categoryService.create({ name: category.name });
        categoryStore.addCategory(newCategory);
        notification.success('Category added successfully!');
        await router.push({ name: 'account.categories' });

    } catch (error) {
        notification.error(error.message);
    }
}
</script>

<template>
    <CategoryForm @submit="handleSubmit" @cancel="async () => await router.push({ name: 'account.categories' })" />
</template>
