<template>
    <div class="flex justify-center items-center min-h-screen min-w-screen bg-background bg-cover">
        <div class="relative flex flex-col items-center justify-center h-screen sm:shadow-lg shadow-none bg-white sm:px-5 px-0 sm:py-10 py-0 sm:rounded-lg rounded-none w-[350px]">
            <button @click="$router.back()" class="absolute text-blue-600 top-12 left-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </button>
            <div class="relative flex flex-col items-center justify-center">
                <!-- <img src="/Visitor_Homepage_Assets/approval.png" class="w-52"> -->
                <Vue3Lottie animationLink="https://assets1.lottiefiles.com/packages/lf20_WWifl0Qmyq.json" :loop="true"
                    :height="'280px'" />
                <p class="text-xs text-center">Please wait for the approval of your visit</p>

                <!-- <button
                    class="relative py-1.5 flex w-full items-center justify-center border-indigo-500 border bg-white rounded-lg">
                    <p class="text-sm text-indigo-500">Pending Approval</p>
                </button> -->

            </div>
        </div>
    </div>
</template>

<script>
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'

export default {
    components: {
        Vue3Lottie,
    },
}

</script>