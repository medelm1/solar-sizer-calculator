<script setup>
import Dialog from 'primevue/dialog';
import CategoryForm from '@/components/CategoryForm.vue';
import { useCategoryStore, useCategoryFormDialogStore } from '@/stores';
import { notification } from '@/utils';
import { categoryService } from '@/services';

const categoryStore = useCategoryStore();
const categoryFormDialogStore = useCategoryFormDialogStore();

async function handleSubmit(category) {
    try {
        const newCategory = await categoryService.create({ name: category.name });
        categoryStore.addCategory(newCategory);
        notification.success('Category added successfully!');
        categoryFormDialogStore.close();

    } catch (error) {
        notification.error(error.message);
    }
}

</script>
<template>
    <Dialog v-model:visible="categoryFormDialogStore.isOpen" modal header="Create New Category" :style="{ width: '25rem' }">
        <template #header>
            Create New Category
        </template>
        <div>
            <CategoryForm @submit="handleSubmit" @cancel="() => categoryFormDialogStore.close()" />
        </div>
    </Dialog>
</template>