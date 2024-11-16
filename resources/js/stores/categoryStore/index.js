import { defineStore } from 'pinia';
import getters from './getters';
import actions from './actions';

export const useCategoryStore = defineStore('categoryStore', {
    state: () => ({
        categories: [],
    }),
    getters,
    actions,
});