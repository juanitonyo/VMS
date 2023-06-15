import { defineStore } from "pinia";

export const useStore = defineStore('hiddenParam', {
    state: () => ({
        hiddenID: null,
    }),
    actions: {
        setHiddenParam(param) {
            this.hiddenID = param;
        }
    },
});
