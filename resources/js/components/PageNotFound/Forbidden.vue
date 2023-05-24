<template>
    <div class="flex flex-col items-center justify-center w-screen h-screen p-24">
        <Vue3Lottie animationLink="https://assets7.lottiefiles.com/packages/lf20_XB4AKncfOp.json" :loop="false" />
        <!-- <router-link :to="'/visitor-registration/index/' + this.id" class="text-indigo-950 text-4xl font-black hover:text-indigo-800 hover:scale-105">Go back to
            Homepage?</router-link> -->
    </div>
</template>

<script>
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import axios from 'axios'

export default {
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
    },

    components: {
        Vue3Lottie,
    },
}

</script>