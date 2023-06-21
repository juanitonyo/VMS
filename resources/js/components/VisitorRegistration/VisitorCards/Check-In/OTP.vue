<template>
    <div class="flex justify-center items-center">
        <div class="relative w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <button class="absolute text-indigo-600 top-8 left-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </button>
            <div class="flex flex-col items-center justify-center h-screen mx-[48px] space-y-10">
                <img src="/Visitor_Homepage_Assets/otp.png" class="w-52">

                <div class="mt-8 flex flex-col text-center space-y-1">
                    <p class="font-bold tracking-wider">Verification</p>
                    <p class="text-gray-400 text-[10px]">Enter OTP for Verification</p>
                </div>

                <div class="flex flex-col border p-6 rounded-xl w-full space-y-5">
                    <div class="flex space-x-2">
                        <div v-for="(input, index) in inputs" :key="index">
                            <input type="text" v-model="inputs[index]" ref="inputs"
                                class="caret-transparent border focus:outline-1 w-full sm:h-8 md:h-10 bg-gray-50 rounded-md text-center font-bold text-xl text-gray-600"
                                maxlength="1" @input="focusNextInput(index)"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                    </div>
                    <button :disabled="isDisabled" @click.prevent="checkLogs" class="w-full h-8 rounded-full text-white text-xs" :class="isDisabled ? 'bg-gray-500' : 'bg-indigo-600'">
                        Verify
                    </button>
                    <div class="text-center">
                        <button @click.prevent="sendOTP" class="text-indigo-600 text-center text-[10px]">Resend New
                            Code (110s)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useStore } from '../../../../store/visitor';
import axios from 'axios';
import { createToast } from 'mosha-vue-toastify';

const store = useStore();

export default {
    data() {
        return {
            inputs: ['', '', '', '', '', ''],
            id: '',
            account: {}
        }
    },

    computed: {
        isDisabled() {
            return this.inputs.some(input => input === '');
        }
    },

    methods: {
        checkLogs() {
            this.$Progress.start();
            axios.get('/api/check-otp?otp=' + this.inputs.join('').toString())
                .then((data) => {
                    this.account = data.data.data
                    store.setHiddenParam(this.account.id);
                    this.$router.push('/visitor-registration/checkin/' + this.account.building.qr_id)
                }).catch((e) => {
                    this.$Progress.fail()
                    createToast(
                        {
                            title: "Opps!",
                            description: "OTP does not match. Try again.",
                        },
                        {
                            showIcon: "true",
                            position: "top-right",
                            type: "danger",
                            hideProgressBar: "true",
                            transition: "bounce",
                        }
                    );
                })
        },
        sendOTP() {
            axios.get('/api/send-otp?id=' + store.hiddenID + '&buildingID=' + store.hiddenBuilding)
                .then((data) => {
                    createToast({
                        title: 'OTP sent!',
                        description: 'Check your device to see your OTP.'
                    },
                    {
                        position: 'top-left',
                        showIcon: 'true',
                        type: 'success',
                        toastBackgroundColor: '#00bcd4',
                        hideProgressBar: 'true',
                        toastBackgroundColor: '#00bcd4',
                    })
                }).catch((error) => {

                })
        },
        syncVisitor() {
            axios.get('/api/sync-visitor?id=' + store.hiddenID)
                .then((data) => {

                }).catch((error) => {

                })
        },
        focusNextInput(index) {
            if (this.inputs[index].length === 1 && index < this.inputs.length - 1) {
                this.$refs.inputs[index + 1].focus();
            }
        },
    },
    created() {
        if(store.hiddenID == null) {
            this.$router.back();
        }
        else {
            this.sendOTP();
        }
    }
}
</script>