<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import CategoryForm from '@/components/CategoryForm.vue';
import { categoryService } from '@/services';
import { useCategoryStore } from '@/stores';
import { notification } from '@/utils';

const route = useRoute();
const router= useRouter();
const categoryStore = useCategoryStore();
const formState = ref({});

onMounted(async () => {
    try {
        formState.value = await categoryService.fetch(route.params.categoryId);
    } catch (err) {
        notification.error(err.message);
    }
});

async function handleSubmit(category) {
    try {
        const updatedCategory = await categoryService.edit(
            { name: category.name },
            route.params.categoryId
        );
        categoryStore.updateCategory(updatedCategory);
        notification.success('Category updated successfully!');
        await router.push({ name: 'account.categories' });

    } catch (error) {
        notification.error(error.message);
    }
}
</script>

<template>
    <CategoryForm @submit="handleSubmit" :formState="formState" />
</template>
