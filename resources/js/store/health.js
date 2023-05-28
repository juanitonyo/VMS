import { defineStore } from "pinia";

export const userHealthStore = defineStore("userHealth", {
    state: () => ({
        healthStatus: false,
        isChecked: false
    }),
    getters: {
        getHealthStatus: (state) => state.healthStatus,
        getCheckedStatus: (state) => state.isChecked
    },
    actions: {
        toggleCheckbox(){
            this.isChecked = !this.isChecked
        },
        toggleHealthStatus(){
            this.healthStatus = !this.healthStatus
        }
    },
    persist: true,
});