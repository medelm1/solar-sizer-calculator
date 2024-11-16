<script setup>
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import { useConfirmationDialogStore } from '@/stores';

const confrimationDialogStore = useConfirmationDialogStore();

function handleConfirm()
{
    confrimationDialogStore.callback();
    confrimationDialogStore.close();
}

</script>
<template>
    <Dialog v-model:visible="confrimationDialogStore.isOpen" modal header="Settings" :style="{ width: '25rem' }">
        <template #header>
            Confirmation
        </template>
        <div>
            Are you sure you want to proceed?
        </div>
        <template #footer>
            <Button label="Cancel" text severity="secondary" @click="confrimationDialogStore.close"></Button>
            <Button label="Confirm" outlined severity="secondary" @click="handleConfirm"></Button>
        </template>
    </Dialog>
</template>