<script setup> 
import { reactive, watch, defineEmits, defineProps } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, helpers } from '@vuelidate/validators';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';

const emit = defineEmits(['submit']);
const props = defineProps({
    formState: {
        type: Object,
        default: () => ({ name: '' })
    }
});

let state = reactive({
    name: props.formState.name,
});

const rules = {
    name: {
        required: helpers.withMessage('Category name is required.', required),
    },
};

const v$ = useVuelidate(rules, state);

const handleSaveChanges = async () => {
    const isValid = await v$.value.$validate();
    if (isValid) {
        emit('submit', state);
    }
};

// Watch for changes in formState prop and update local state
watch(
    () => props.formState,
    (newVal) => {
        state.name = newVal.name;
    },
    { deep: true }
);
</script>

<template>
    <div class="flex flex-col gap-2 mb-4">
        <label for="name" class="font-semibold">Category Name</label>
        <InputText v-model="state.name" :invalid="v$.name.$error" id="name" class="flex-auto" aria-autocomplete="off"></InputText>
        <Message v-if="v$.name.$error" severity="error">
            <span class="text-sm">{{ v$.name.$errors[0]?.$message }}</span>
        </Message>
    </div>
    <div>
        <Button label="Save" outlined severity="secondary" @click="handleSaveChanges"></Button>
    </div>
</template>
