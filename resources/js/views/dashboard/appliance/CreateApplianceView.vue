<script setup>
import { reactive, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Button from 'primevue/button';
import Message from 'primevue/message';
import { applianceService } from '@/services';
import { useApplianceStore } from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();

let state = reactive({
    name: '', 
    powerRating: '',
    usageHours: '',
    units: 1,
});

const rules = {
    name: {
        required: helpers.withMessage('Appliance name is required.', required),
    },
    powerRating: {
        required: helpers. withMessage('Appliance power rating is required.', required),
    },
    usageHours: {
        required: helpers.withMessage('Appliance usage hours is required.', required),
    },
    units: {
        numeric: helpers.withMessage('Units must be a numeric value.', numeric),
    }
};

const v$ = useVuelidate(rules, state);

async function handleSaveChanges() {
    const isValid = await v$.value.$validate();

    if (isValid) {
        try {
            applianceStore.addAppliance(
                await applianceService.create({
                    name: state.name,
                    powerRating: state.powerRating,
                    usageHours: state.usageHours,
                    units: state.units,
                })
            );
            
            notification.success('Appliance added successfully!');

        } catch (error) {
            notification.error(error.message);
        }
    }
}

</script>
<template>
    <div class="flex flex-col gap-2 mb-4">
        <label for="name" class="font-semibold">Appliance Name</label>
        <InputText v-model="state.name" :invalid="v$.name.$error" id="name" class="flex-auto" aria-autocomplete="off"></InputText>
        <Message v-if="v$.name.$error" severity="error">
            <span class="text-sm">{{ v$.name.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div class="flex flex-col gap-2 mb-4">
        <label for="powerRating" class="font-semibold">Power Rating (Watts)</label>
        <InputNumber 
            v-model="state.powerRating" 
            inputId="powerRating"
            :invalid="v$.powerRating.$error" 
            class="flex-auto" 
            aria-autocomplete="off"
            fluid
        ></InputNumber>
        <Message v-if="v$.powerRating.$error" severity="error">
            <span class="text-sm">{{ v$.powerRating.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div class="flex flex-col gap-2 mb-4">
        <label for="usageHours" class="font-semibold">Usage Hours</label>
        <InputNumber 
            v-model="state.usageHours" 
            inputId="usageHours"
            :minFractionDigits="1" :maxFractionDigits="2"
            :invalid="v$.usageHours.$error" 
            class="flex-auto" 
            aria-autocomplete="off"
            fluid
        ></InputNumber>
        <Message v-if="v$.usageHours.$error" severity="error">
            <span class="text-sm">{{ v$.usageHours.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div class="flex flex-col gap-2 mb-4">
        <label for="units" class="font-semibold">Units</label>            
        <InputNumber 
            v-model="state.units" 
            inputId="units"
            :min="0" :max="100"
            :invalid="v$.units.$error" 
            class="flex-auto" 
            aria-autocomplete="off"
            fluid
        ></InputNumber>
        <Message v-if="v$.units.$error" severity="error">
            <span class="text-sm">{{ v$.units.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div>
        <Button label="Save" outlined severity="secondary"></Button>
    </div>
</template>