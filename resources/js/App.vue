<script setup>
import { onMounted } from "vue";
import { useApplianceStore, useCategoryStore } from "./stores";
import { applianceService, categoryService } from '@/services';
import ConfirmationDialog from '@/components/dialogs/ConfirmationDialog.vue';
import CategoryFormDialog from '@/components/dialogs/CategoryFormDialog.vue';

const applianceStore = useApplianceStore();
const categoryStore = useCategoryStore();

onMounted(async () => {

    try {

        // Load appliances
        applianceStore.init(
            await applianceService.fetchAll()
        );

        // Load categories
        categoryStore.init(
            await categoryService.fetchAll()
        );

    } catch (error) {
        console.error(error);
    }

});

</script>
<template>
    <ConfirmationDialog />
    <CategoryFormDialog />
    <router-view></router-view>
</template>