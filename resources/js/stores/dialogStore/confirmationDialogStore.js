import { defineStore } from "pinia";

export const useConfirmationDialogStore = defineStore('confirmationDialog', {
    state: () => ({
        isOpen: false,
        callback: null,
    }),
    actions: {
        open(cb) {
            this.isOpen = true;
            this.callback = cb;
        },
        close() {
            this.isOpen = false;
            this.callback = null;
        }
    }
});