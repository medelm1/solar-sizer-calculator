<script setup>
import { useApplianceStore } from '@/stores';

const applianceStore = useApplianceStore();

</script>
<template>
    <div>
        <h3 class="text-md font-medium">Daily Energy Needs:</h3>
        <span>{{ applianceStore.totalDailyEnergyConsumption / 1000 }} kWh</span>
    </div>
</template>