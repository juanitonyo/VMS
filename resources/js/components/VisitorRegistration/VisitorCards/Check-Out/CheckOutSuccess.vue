<template>
    <div class="flex justify-center items-center">
        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center justify-center w-full min-h-screen gap-y-8">

                <div class="text-[10px] text-blue-900 flex flex-col items-center text-center gap-y-3">
                    <Vue3Lottie animationLink="https://assets1.lottiefiles.com/packages/lf20_rc5d0f61.json" :loop="false" :width="150" :height="150"/>
                    <p class="text-base tracking-wide text-green-500 font-bold">Check out Successful</p>
                </div>
                <div class="text-[10px] text-blue-900 flex flex-col text-center mb-10">
                    <p>Time recorded</p>
                    <p>{{ moment(this.time).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                </div>

                <router-link :to="'/visitor-registration/index/' + this.id">
                    <button class="text-xs text-white bg-blue-800 rounded-md pl-3 h-[33px] w-80">Thank You</button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import moment from 'moment';

export default {
    name: 'Check Out Success',

    props: {
        data: {
            type: Array,
            default: []
        },
    },
    components: {
        Vue3Lottie,
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
        }
    },
    methods: {
        async getData() {
            await axios.get('/api/get-visitor-log/')
                .then((data) => {
                    this.time = data.data.data.updated_at;
                })
                .catch((e) => {
                    
                });
        },
    },

    created() {
        this.getData();
        this.moment = moment;
        setTimeout(() => this.$router.push({ path: '/visitor-registration/index/' + this.id }), 5000);
    }
    
}
</script>