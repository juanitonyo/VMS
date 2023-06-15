import { defineStore } from "pinia";
import { userAuthStore } from "./auth";

export const userPermsStore = defineStore("userPerms", {
    state: () => ({
        permissions: {
            view: false,
            create: false,
            update: false
        }
    }),
    getters: {

    },
    actions: {
        
    },
    persist: true,
});