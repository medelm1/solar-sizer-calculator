<script setup>
import { reactive, defineEmits, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Select from 'primevue/select';
import Button from 'primevue/button';
import Message from 'primevue/message';
import { useCategoryStore, useCategoryFormDialogStore } from '@/stores';

const emit = defineEmits(['submit', 'cancel']);
const props = defineProps({
    formState: {
        type: Object,
        default: () => ({ 
            name: '', 
            powerRating: '',
            usageHours: '',
            units: 1,
            category: '',
        })
    }
});
const categoryStore = useCategoryStore();
const categoryFormDialogStore = useCategoryFormDialogStore();

let state = reactive({
    name: props.formState.name,
    powerRating: props.formState.powerRating,
    usageHours: props.formState.usageHours,
    units: props.formState.units,
    category: props.formState.category,
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
    },
    category: {
        required: helpers.withMessage('Category is required.', required),
    },
};

const v$ = useVuelidate(rules, state);

async function handleSaveChanges() {
    const isValid = await v$.value.$validate();
    if (isValid) {
        emit('submit', state);
    }
}

function handleCancel() {
    emit('cancel');
}

// Watch for changes in formState prop and update local state
watch(
    () => props.formState,
    (newVal) => {
        state.name = newVal.name;
        state.powerRating = newVal.powerRating;
        state.usageHours = newVal.usageHours;
        state.units = newVal.units;
        state.category = newVal.category;
    },
    { deep: true }
);
</script>
<template>
    <div class="flex flex-col gap-2 mb-4">
        <label for="name" class="font-semibold">Appliance Name</label>
        <InputText v-model="state.name" :invalid="v$.name.$error" id="name" class="flex-auto" aria-autocomplete="off"></InputText>
        <Message v-if="v$.name.$error" severity="error">
            <span class="text-sm">{{ v$.name.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div class="flex flex-col gap2 mb-4">
        <label for="category" class="font-semibold">Category</label>
        <Select 
            v-model="state.category" 
            :options="categoryStore.categories.map(category => ({ id: category.id, name: category.name }))" 
            optionLabel="name" 
            placeholder="Select a Category" 
            class="w-full my-2"
            :invalid="v$.category.$error"
        >
            <template #option="slotProps">
                <template class="flex items-center">
                    <div>{{ slotProps.option.name }}</div>
                </template>
            </template>
            <template #footer>
                <div class="flex p-3">
                    <Button 
                        label="Add New" 
                        fluid 
                        severity="secondary" 
                        outlined 
                        size="small" 
                        icon="pi pi-plus"
                        @click="() => categoryFormDialogStore.open()"
                    ></Button>
                </div>
            </template>
        </Select>
        <Message v-if="v$.category.$error" severity="error">
            <span class="text-sm">{{ v$.category.$errors[0]?.$message }}</span>
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
        <Button label="Save" outlined severity="secondary" class="me-2" @click="handleSaveChanges"></Button>
        <Button label="Cancel" outlined severity="secondary" @click="handleCancel"></Button>
    </div>
</template>