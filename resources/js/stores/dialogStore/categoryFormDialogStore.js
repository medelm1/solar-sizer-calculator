import { defineStore } from "pinia";

export const useCategoryFormDialogStore = defineStore('categoryFormDialog', {
    state: () => ({
        isOpen: false,
    }),
    actions: {
        open() {
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        }
    }
});