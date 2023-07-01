import { defineStore } from "pinia";

export const useStore = defineStore('hiddenParam', {
    state: () => ({
        hiddenID: null,
        hiddenBuilding: null,
        hiddenLog: null,
    }),
    actions: {
        setHiddenParam(param) {
            this.hiddenID = param;
        },
        setHiddenBuilding(param) {
            this.hiddenBuilding = param
        },
        setHiddenLog(param) {
            this.hiddenLog = param;
        }
    },
});
