<template>
    <div class="flex flex-col items-center justify-center min-h-screen">

        <div class="flex flex-col gap-y-2 items-center justify-center absolute top-16">
            <h2 class="text-xl font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
            <h4 class="text-gray-400 text-[10px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
        </div>

        <div class="flex flex-col items-center justify-center absolute top-64">
            <p class="text-[10px] text-gray-400 text-center">By registering your account, you agree to <br>our <a href="#"
                    class="underline text-blue-800 font-bold">Privacy Policy</a> and <a href="#"
                    class="underline text-blue-800 font-bold">Terms of Use</a></p>

            <button type="button"
                class="text-white bg-red-500 hover:bg-red-500/90 focus:ring-2 focus:outline-none focus:ring-red-500/50 font-medium rounded-lg text-xs px-5 py-2.5 mt-3 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 w-[325px]">
                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor"
                        d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                    </path>
                </svg>
                Sign up with Google
            </button>

            <router-link to="'/visitor-registration/create/' + this.id"
                class="text-white bg-blue-500 hover:bg-blue-500/90 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 w-[325px]">
                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                    data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z">
                    </path>
                </svg>
                Sign up with Facebook
            </router-link>
            <div class="my-8">
                <hr class="w-64 h-px bg-gray-300 border-0">
                <span
                    class="absolute top-[152px] px-3 font-medium text-gray-400 text-sm -translate-x-1/2 bg-white left-1/2">or</span>
            </div>

            <buttonToInput is-button :id="id" :label="'Create Account'" class="text-blue-800 border border-blue-800 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 mt-2 w-[325px]"></buttonToInput>
            <!-- <buttonToInput :is-button="false"></buttonToInput> -->
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import buttonToInput from '../../../Elements/Buttons/buttonToInput.vue'

export default {
    name: 'Visitor Prompt',

    components: {
        buttonToInput,
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
}
</script>