<template>
    <div class="min-h-screen min-w-full flex items-center justify-center">
        <div>
            <Vue3Lottie animationLink="https://assets4.lottiefiles.com/packages/lf20_u1xuufn3.json" />
        </div>
    </div>
</template>

<script>

import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'

export default {
    name: 'BasicExampleURL',
    components: {
        Vue3Lottie,
    },
}
</script>