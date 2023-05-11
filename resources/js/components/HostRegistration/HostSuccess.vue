<template>
    <div class="min-h-screen p-6 flex items-center justify-center">
        <div class="container max-w-screen-md mx-auto">
            <div class="bg-white rounded-md shadow-lg shadow-blue-200 p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
                    <Vue3Lottie animationLink="https://assets1.lottiefiles.com/packages/lf20_rc5d0f61.json" :loop="false"
                        :width="280" :height="280"/>
                    <div class="flex flex-col items-center justify-center mb-20 lg:mb-0">
                        <p class="text-blue-700 text-center uppercase font-light text-2xl lg:text-5xl">Success!</p>
                        <p class="text-center text-xs lg:text-sm">proceed to <router-link :to="'/login'" class="underline hover:text-blue-900">login</router-link> ?</p>
                    </div>
                </div>
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