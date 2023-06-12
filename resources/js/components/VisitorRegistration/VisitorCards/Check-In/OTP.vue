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
                            <input type="text" v-model="inputs[index]"
                                class="caret-transparent border focus:outline-1 w-full sm:h-8 md:h-10 bg-gray-50 rounded-md text-center font-bold text-xl text-gray-600"
                                maxlength="1"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                    </div>
                    <button @click.prevent="getInputValues" class="w-full h-8 rounded-full bg-indigo-600 text-white text-xs">
                        Verify
                    </button>
                    <div class="text-center">
                        <button class="text-indigo-600 text-center text-[10px]">Resend New
                            Code</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            inputs: ['', '', '', '', '', ''],
            
        }
    },
    methods: {
        getInputValues() {
            console.log(this.inputs.join('').toString());
        }
    }
}
</script>