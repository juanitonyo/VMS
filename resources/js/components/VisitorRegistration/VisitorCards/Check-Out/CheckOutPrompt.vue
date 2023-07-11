<template>
    <div class="flex justify-center items-center min-h-screen min-w-screen sm:bg-background sm:bg-cover sm:bg-center">
        <div class="flex flex-col items-center justify-center sm:h-[708px] space-y-20 sm:shadow-lg shadow-none sm:px-5 px-0 sm:py-10 py-0 sm:rounded-lg rounded-none bg-white">

            <a :href="'/visitor-registration/index/' + this.id">
                <img src="/logo/vms_logo.png" class="w-[240px] h-[90px]">
            </a>

            <div class="flex flex-col">
                <div class="text-center">
                    <h2 class="text-xl font-black tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                    <h4 class="text-gray-400 text-[9px] text-center w-72">{{ this.buildings.address }}</h4>
                </div>
            </div>  

            <div class="flex flex-col items-center justify-center">
                <p class="text-[9px] text-gray-400 text-center">By registering your account, you agree to <br>our <a
                        href="/Terms-and-Condition#privacy" target="_blank"
                        class="underline text-blue-800 font-bold">Privacy Policy</a> and <a href="/Terms-and-Condition"
                        target="_blank" class="underline text-blue-800 font-bold">Terms of Use</a>
                </p>

                <a :href="'/login-google?building-id=' + id" type="button"
                    class="text-white bg-red-500 hover:bg-red-500/90 focus:ring-2 focus:outline-none focus:ring-red-500/50 font-medium rounded-lg text-[10px] py-2 mt-3 text-center flex items-center justify-center dark:focus:ring-[#4285F4]/55 w-[300px]">
                    <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path fill="currentColor"
                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                        </path>
                    </svg>
                    Sign up with Google
                </a>

                <a :href="'/login-facebook?building-id=' + id" type="button"
                    class="text-white bg-blue-500 hover:bg-blue-500/90 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-[10px] py-2 mt-3 text-center flex items-center justify-center dark:focus:ring-[#4285F4]/55 w-[300px]">
                    <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z">
                        </path>
                    </svg>
                    Sign up with Facebook
                </a>
                <div class="my-8 relative">
                    <hr class="w-64 h-px bg-gray-300">
                    <p class="absolute -top-2 px-3 font-medium text-gray-400 text-xs bg-white left-[43%]">or</p>
                </div>

                <!-- <buttonToInput is-button :label="'Create Account'"></buttonToInput> -->
                <buttonToInput v-model="this.given" :is-button="false"></buttonToInput>
                <button @click.prevent="isExisting()" type="submit"
                    class="text-white border bg-blue-700 hover:bg-blue-600 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mt-3 w-full cursor-pointer">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Form } from 'vform';
import buttonToInput from '../../../Elements/Buttons/buttonToInput.vue'
import { useStore } from '../../../../store/visitor';

const store = useStore();

export default {
    name: 'Check In Prompt',

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
            given: '',
            account: {},
            log: {},
            buildings: {},
        }
    },
    methods: {

        async isExisting() {
            await axios.get('/api/visitor-query?given=' + this.given + '&building_id=' + this.buildings.id)
                .then((data) => {
                    this.account = data.data.data;

                    if (this.account == null) {
                        this.$router.push('/visitor-registration/signIn/reg/' + this.id);
                    }

                    else if (this.account.latest_log == null || this.account.latest_log.is_checked_out || this.account.latest_log.status == -1) {
                        store.setHiddenParam(this.account.id);
                        
                        this.$router.push('/visitor-registration/checkin/' + this.id);
                    }

                    else if (!this.account.latest_log.is_checked_out) {
                        store.setHiddenParam(this.account.id);

                        this.$router.push('/visitor-registration/checkout/' + this.id);
                    }

                    else if (this.account.latest_log.status == 0) {
                            this.$router.push('/visitor-registration/approval');
                    }

                })
                .catch((error) => {

                });
        },

        async getData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        }
    },
    created() {
        this.getData();
    },
}
</script>