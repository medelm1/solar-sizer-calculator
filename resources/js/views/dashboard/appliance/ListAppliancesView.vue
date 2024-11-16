<script setup>
import { useRouter } from 'vue-router';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import { 
    useApplianceStore, 
    useConfirmationDialogStore
} from '@/stores';
import { applianceService } from '@/services';
import { notification } from '@/utils';

const router = useRouter();
const applianceStore = useApplianceStore();
const confirmationDialogStore = useConfirmationDialogStore();

const handleDeleteAppliance = (applianceId) => {
    confirmationDialogStore.open(async () => {
        try {
            await applianceService.remove(applianceId);

            applianceStore.removeAppliance(applianceId);

            notification.success('Appliance deleted succesfully!');

        } catch (error) {
            notification.error(error.message);
        }
    });
};

</script>
<template>
    <div class="flex gap-2 mb-4">
        <Button label="New Appliance" size="small" outlined severity="secondary" icon="pi pi-plus" @click="async () => await router.push({ name: 'account.create-appliance' })"></Button>
    </div>

    <DataTable :value="applianceStore.appliances" dataKey="id" stripedRows>
        <Column>
            <template #header>
                <div>
                    <span class="font-bold">Appliance Name</span>
                </div>
            </template>
            <template #body="slotProps">
                <div>{{ slotProps.data.name }}</div>
            </template>
        </Column>
        <Column>
            <template #header>
                <div>
                    <span class="font-bold">Category</span>
                </div>
            </template>
            <template #body="slotProps">
                <div>{{ slotProps.data.category.name }}</div>
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
                        @click="async () => router.push({ name: 'account.edit-appliance', params: { applianceId: slotProps.data.id } })"
                    ></Button>
                    <Button 
                        label="Delete" 
                        outlined 
                        severity="secondary" 
                        size="small"
                        @click="() => handleDeleteAppliance(slotProps.data.id)"
                    ></Button>
                </div>
            </template>
        </Column>
    </DataTable>
</template>