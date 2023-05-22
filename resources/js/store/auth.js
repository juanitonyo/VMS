import { defineStore } from "pinia";
import router from "@/router";
import axios from "axios";
import { createToast } from "mosha-vue-toastify";

export const userAuthStore = defineStore("userAuth", {
    state: () => ({
        authenticated: false,
        user: {},
        role: {},
    }),
    getters: {
        getUser: (state) => state.user,
        getAuthentition: (state) => state.authenticated,
        getRoleAndPermission: (state) => state.role,
    },
    actions: {
        async getToken() {
            await axios.get("/sunctum/csrf-cookie");
        },
        async signOut() {
            this.authenticated = false;
            this.user = {};
            this.role = {};
        },
        async login(formData) {
            this.getToken();
            await axios
                .post("/api/login", formData.value)
                .then((data) => {
                    this.authenticated = data.data.success;
                    this.user = data.data.data.user;
                    this.role = data.data.data.role;
                    router.push({ name: "dashboard" });
                })
                .catch((error) => {
                    createToast(
                        {
                            title: "Opps!",
                            description: error.response.data.message,
                        },
                        {
                            showIcon: "true",
                            position: "top-right",
                            type: "danger",
                            hideProgressBar: "true",
                            transition: "bounce",
                        }
                    );
                });
        },
    },
    persist: true,
});
