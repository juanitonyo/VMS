import { defineStore } from "pinia";

export const useStore = defineStore('hiddenParam', {
    state: () => ({
        hiddenID: null,
        hiddenBuilding: null,
    }),
    actions: {
        setHiddenParam(param) {
            this.hiddenID = param;
        },
        setHiddenBuilding(param) {
            this.hiddenBuilding = param
        }
    },
});
