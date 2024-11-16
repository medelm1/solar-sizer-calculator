<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { applianceService } from '@/services';
import ApplianceForm from '@/components/ApplianceForm.vue';
import { 
    useApplianceStore,
} from '@/stores';
import { notification } from '@/utils';

const route = useRoute();
const router = useRouter();
const applianceStore = useApplianceStore();
const formState = ref({});

onMounted(async () => {
    try {
        formState.value = await applianceService.fetch(route.params.applianceId);
    } catch (err) {
        notification.error(err.message);
    }
});

async function handleSubmit(appliance) {
    try {
        const updatedAppliance = await await applianceService.edit(
            {
                name: appliance.name,
                powerRating: appliance.powerRating,
                usageHours: appliance.usageHours,
                units: appliance.units,
                categoryId: appliance.category.id
            }, 
            route.params.applianceId
        );
        applianceStore.updateAppliance(updatedAppliance);

        notification.success('Appliance updated successfully!');
        await router.push({ name: 'account.appliances' });

    } catch (error) {
        notification.error(error.message);
    }
    
}

</script>
<template>
    <ApplianceForm @submit="handleSubmit" :formState="formState" />
</template>