import { defineStore } from 'pinia';
import getters from './getters';
import actions from './actions';

export const useApplianceStore = defineStore('applianceStore', {
    state: () => ({
        appliances: [],
    }),
    getters,
    actions,
});