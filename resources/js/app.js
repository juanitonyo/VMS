//import './bootstrap';
import "../css/app.css";
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import axios from "axios";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import VueProgressBar from "@aacassandra/vue3-progressbar";
import Router from "@/router";
import CKEditor from '@ckeditor/ckeditor5-vue';
import Form from "vform";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

import moshaToast from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";

const options = {
    color: "rgb(143, 255, 199)",
    failedColor: "#FF1919",
    thickness: "3px",
    transition: {
        speed: "0.5s",
        opacity: "0.6s",
        termination: 300,
    },
    autoRevert: true,
    location: "top",
    inverse: false,
};

const app = createApp({});
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
app.config.globalProperties.$axios = axios;
app.use(Router);
app.use(pinia, moshaToast, Form);
app.use(VueProgressBar, options);
app.use(CKEditor);
app.component("v-select", vSelect);

app.mount('#app');
