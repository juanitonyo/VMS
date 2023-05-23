<template>
    <div class="flex justify-center items-center">
        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center justify-center w-full min-h-screen gap-y-8">

                <div class="text-[10px] text-blue-900 flex flex-col items-center text-center gap-y-3">
                    <Vue3Lottie animationLink="https://assets1.lottiefiles.com/packages/lf20_rc5d0f61.json" :loop="false"
                        :width="150" :height="150" />
                    <p class="text-base tracking-wide text-green-500 font-bold">Checked-In</p>
                </div>
                <div class="text-[10px] text-blue-900 flex flex-col text-center">
                    <p>Time recorded</p>
                    <p >{{ moment(this.time).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                </div>

                <div class="text-[10px] text-blue-900 flex flex-col text-center w-48">
                    <p>Please wait for unit owner's approval prior to entry.</p>
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
    name: 'Check In Prompt',
    components: {
        Vue3Lottie, moment
    },
    props: {
        data: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            time: ""
        }
    },

    methods: {
        async getData() {
            await axios.get('/api/get-visitor-log/')
                .then((data) => {
                    this.time = data.data.data.created_at;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
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