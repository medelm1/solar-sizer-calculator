<script setup>
import { reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import Panel from 'primevue/panel';
import Slider from 'primevue/slider';
import InputNumber from 'primevue/inputnumber';
import { Badge } from 'primevue';
import { useApplianceStore } from '@/stores';
import OverviewCard from '@/components/OverviewCard.vue';

const applianceStore = useApplianceStore();

const state = reactive({
    solarPanelPowerRating: 250,
    averageSunglightHours: 5,
});

const rules = {
    solarPanelPowerRating: {
        required: helpers.withMessage('Solar panel\' power rating is required', required),
        numeric: helpers.withMessage('Solar panel\'s power rating must be a numeric value', numeric),
    },
    averageSunglightHours: {
        required: helpers.withMessage('Average sunlight hours is required', required),
        numeric: helpers.withMessage('Average sunlight hours must be a numeric value.', numeric),
    }
};

const v$ = useVuelidate(rules, state);

async function calculate() {
    const isValid = await v$.value.$validate();

    if (isValid) {
        console.log('Validated!');
    }
}

const solarPanelTotalEnergyOutput = computed(
    () => state.solarPanelPowerRating * state.averageSunglightHours
);

const numberOfPanelsNeeded = computed(() => {
    if (solarPanelTotalEnergyOutput.value === 0) return 0;

    return Math.ceil(applianceStore.totalDailyEnergyConsumption / solarPanelTotalEnergyOutput.value);
});

</script>
<template>
    <div class="flex gap-4">
        <OverviewCard
            label="Energy Needs"
            :data="(applianceStore.totalDailyEnergyConsumption / 1000).toFixed(2)"
            unit="kWh/day"
            class="flex-1"
        />
        <OverviewCard
            label="Solar Panel Output"
            :data="(solarPanelTotalEnergyOutput / 1000).toFixed(2)"
            unit="kWh/day"
            class="flex-1"
        />
        <OverviewCard
            label="Panels Needed"
            :data="numberOfPanelsNeeded"
            unit="Panel(s)"
            class="flex-1"
        />
    </div>
    <Panel header="Solar panel information">
        <div class="flex flex-col gap-2 mb-4">
            <label for="solar-panel-power-rating">Power rating (W)</label>
            <InputNumber
                v-model.number="state.solarPanelPowerRating"
                inputId="solar-panel-power-rating"
                class="flex-auto"
                aria-autocomplete="off"
                
            >
            </InputNumber>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label for="average-sunlight-hours">Average sunlight hours (<span class="font-medium">{{ state.averageSunglightHours }}</span> h)</label>
            <Slider 
                v-model.number="state.averageSunglightHours"
                inputId="average-sunlight-hours"
                :min="0"
                :max="24"
                :step="1"
            />
        </div>
    </Panel>
</template>