<template>
    <div class="flex justify-center items-center">
        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center justify-center w-full min-h-screen gap-y-8">

                <div class="text-[10px] text-blue-900 flex flex-col items-center text-center gap-y-3">
                    <Vue3Lottie animationLink="https://assets1.lottiefiles.com/packages/lf20_rc5d0f61.json" :loop="false" :width="150" :height="150"/>
                    <p class="text-base tracking-wide text-green-500 font-bold">Checked-In</p>
                </div>
                <div class="text-[10px] text-blue-900 flex flex-col text-center">
                    <p>Time recorded</p>
                    <p>MMMM DD, YYYY, 0:00 PM</p>
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

export default {
    name: 'Invite Success',

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
        }
    },
    created() {
        axios.get('/api/visitor-registration/' + this.id)
            .then((data) => {
                this.buildings = data.data.data;
            })
            .catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });

        setTimeout(() => this.$router.push({ path: '/visitor-registration/index/' + this.id }), 5000);
    },
    components: {
        Vue3Lottie,
    },
}
</script>