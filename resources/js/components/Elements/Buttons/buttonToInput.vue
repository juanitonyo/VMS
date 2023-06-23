<template>
    <div>

        <a :href="'/visitor-registration/create/' + this.id" v-show="isButton" @click="onClick" tag="button"
            class="text-blue-800 border border-blue-800 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-center flex items-center justify-center dark:focus:ring-[#4285F4]/55 w-[300px] cursor-pointer">{{
                label }}</a>

        <div v-show="!isButton" class="relative">
            <input :value="modelValue" @input="updateValue" :placeholder="'Email / Reference Code '"
                :class="'placeholder:text-gray-400 text-blue-900 border border-blue-800 pr-10 bg-white hover:bg-gray-50 text-center focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 w-[300px]'">
            <button class="absolute right-3 top-2 hover:scale-105" @click="isPop">
                <img src="/Visitor_Homepage_Assets/qrButton.png" class="w-6 h-6">
            </button>
        </div>

    </div>

    <FormDialog :isOpen="show" :Title="'Scan QR'">
        <template v-slot:body>
            <div>

                <div class="text-center">
                    <div class="qrScanner">
                        <p class="text-xs text-gray-400 mb-3 italic text-center"> Note: Place the QR Code sent to you
                            infront of the camera</p>
                        <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
                            <button @click.prevent="switchCamera()"
                                class="absolute bottom-2 p-1.5 bg-gray-100 rounded border border-gray-400 text-black hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>

                            </button>
                        </qrcode-stream>
                    </div>
                    <div class="mt-3">

                        <div class="flex">
                            <button @click="copy"
                                class="hover:bg-gray-200/90 inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                </svg>
                            </button>
                            <input v-on:focus="$event.target.select()" ref="clone" readonly :value="this.result"
                                class="pointer-events-none rounded-none rounded-r-md bg-gray-50 border text-gray-900 block flex-1 min-w-0 w-full text-xs border-gray-300 p-2">
                        </div>
                        <span v-show="error != null" class="text-[10px] text-red-500">{{ error }}</span>
                    </div>

                </div>
            </div>
        </template>
    </FormDialog>
</template>

<script>

import axios from 'axios';
import FormDialog from '../Modals/FormDialog.vue';
import { QrcodeStream } from 'vue3-qrcode-reader'
export default {
    name: 'buttonToInput',
    setup(props, context) {
        const updateValue = (event) => {
            context.emit('update:modelValue', event.target.value);
        }

        return { updateValue }
    },

    components: {
        FormDialog,
    },
    props: {
        isButton: {
            type: Boolean,
            default: true
        },
        label: {
            type: String,
            default: 'Create Account'
        },
        modelValue: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            show: false,
            result: '',
            error: '',
            camera: 'rear',
            showResult: ''
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

    methods: {
        copy() {
            this.$refs.clone.focus();
            document.execCommand('copy');
        },
        isPop() {
            this.show = !this.show;
            this.result = '';
        },
        onDecode(result) {
            this.result = result
        },

        switchCamera() {
            switch (this.camera) {
                case 'front':
                    this.camera = 'rear'
                    break
                case 'rear':
                    this.camera = 'front'
                    break
            }
        },

        async onInit(promise) {
            try {
                await promise

            } catch (error) {

                const triedFrontCamera = this.camera === 'front'
                const triedRearCamera = this.camera === 'rear'

                if (error.name === 'NotAllowedError') {
                    this.error = "ERROR: you need to grant camera access permission"
                } else if (error.name === 'NotFoundError') {
                    this.error = "ERROR: no camera on this device"
                } else if (error.name === 'NotSupportedError') {
                    this.error = "ERROR: secure context required (HTTPS, localhost)"
                } else if (error.name === 'NotReadableError') {
                    this.error = "ERROR: is the camera already in use?"
                } else if (error.name === 'OverconstrainedError') {
                    this.error = "ERROR: installed cameras are not suitable"
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = "ERROR: Stream API is not supported in this browser"
                } else if (error.name === 'InsecureContextError') {
                    this.error = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
                } else {
                    this.error = `ERROR: Camera error (${error.name})`;
                }

                if (triedRearCamera) {
                    this.error = 'ERROR: No rear camera found'
                }

                if (triedFrontCamera) {
                    this.error = 'ERROR: No front camera found'
                }
            }
        },
    },

}
</script>