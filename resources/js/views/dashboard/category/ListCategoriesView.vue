<script setup>
import { useRouter } from 'vue-router';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import { 
    useCategoryStore, 
    useConfirmationDialogStore
} from '@/stores';
import { categoryService } from '@/services';
import { notification } from '@/utils';

const router = useRouter();
const categoryStore = useCategoryStore();
const confirmationDialogStore = useConfirmationDialogStore();

const handleDeleteCategory = (categoryId) => {
    confirmationDialogStore.open(async () => {
        try {
            await categoryService.remove(categoryId);

            categoryStore.removeCategory(categoryId);

            notification.success('Category deleted succesfully!');

        } catch (error) {
            notification.error(error.message);
        }
    });
};

</script>
<template>
    <div class="flex gap-2 mb-4">
        <Button label="New Category" size="small" outlined severity="secondary" icon="pi pi-plus" @click="async () => await router.push({ name: 'account.create-category' })"></Button>
    </div>

    <DataTable :value="categoryStore.categories" dataKey="id" stripedRows>
        <Column>
            <template #header>
                <div>
                    <span class="font-bold">Category Name</span>
                </div>
            </template>
            <template #body="slotProps">
                <div>{{ slotProps.data.name }}</div>
            </template>
        </Column>
        <Column>
            <template #header>
                <div class="flex justify-end w-full">
                    <span class="font-bold">Action</span>
                </div>
            </template>
            <template #body="slotProps">
                <div class="flex justify-end gap-2">
                    <Button 
                        label="Edit" 
                        outlined 
                        severity="secondary" 
                        size="small" 
                        @click="async () => router.push({ name: 'account.edit-category', params: { categoryId: slotProps.data.id } })"
                    ></Button>
                    <Button 
                        label="Delete" 
                        outlined 
                        severity="secondary" 
                        size="small"
                        @click="() => handleDeleteCategory(slotProps.data.id)"
                    ></Button>
                </div>
            </template>
        </Column>
    </DataTable>
</template>