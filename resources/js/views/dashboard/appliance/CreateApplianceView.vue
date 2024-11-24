<script setup>
import { useRouter } from 'vue-router';
import { applianceService } from '@/services';
import ApplianceForm from '@/components/ApplianceForm.vue';
import { 
    useApplianceStore,
} from '@/stores';
import { notification } from '@/utils';

const router = useRouter();
const applianceStore = useApplianceStore();

async function handleSubmit(appliance) {
    try {
        const newAppliance = await await applianceService.create({
            name: appliance.name,
            powerRating: appliance.powerRating,
            usageHours: appliance.usageHours,
            units: appliance.units,
            categoryId: appliance.category.id
        });
        applianceStore.addAppliance(newAppliance);

        notification.success('Appliance added successfully!');
        await router.push({ name: 'account.appliances' });

    } catch (error) {
        notification.error(error.message);
    }
    
}

</script>
<template>
    <ApplianceForm 
        @submit="handleSubmit" 
        @cancel="async () => await router.push({ name: 'account.appliances' })" 
    />
</template>