<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    label: String,
    data: Number,
    unit: String
});

</script>
<template>
    <div class="mb-4 p-5 flex flex-col rounded-md gap-4">
        <h4 class="font-medium">{{ props.label }}</h4>
        <div class="flex gap-2">
            <h2 class="text-[42px] font-bold leading-[42px]">{{ props.data }}</h2>
            <span class="font-light">{{ props.unit }}</span>
        </div>
    </div>
</template>