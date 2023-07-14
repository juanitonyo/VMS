<template>
    <div v-show="this.result == ''" class="flex justify-center items-center min-h-screen min-w-screen sm:bg-background sm:bg-cover sm:bg-center"
        :class="guard_pm_authorized ? 'bg-gradient-to-br from-white to-blue-100' : ''">
        <div class="flex flex-col items-center justify-center gap-y-4 sm:shadow-lg shadow-none sm:px-8 px-0 sm:py-10 py-0 sm:rounded-lg rounded-none bg-white">

            <img src="/logo/vms_logo.png" alt="logo" class="w-[180px] pointer-events-none">

            <div class="flex flex-col items-center justify-center">
                <h2 class="text-sm font-light tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                <h4 class="text-[10px] text-gray-400 text-center w-80">{{ this.buildings.address }}</h4>
            </div>

            <div v-show="guard_pm_authorized"
                class="actions flex items-center justify-center gap-1.5 w-[280px] text-xs font-light">
                <button @click.prevent="openQR()"
                    class="w-full h-8 text-blue-700 border border-blue-700 rounded-md p-0.5 gap-1 flex items-center justify-center">
                    <img src="/Visitor_Homepage_Assets/qrButton.png" class="w-5 h-5">
                    Scan QR
                </button>

                <button
                    class="w-full h-8 text-blue-700 border border-blue-700 rounded-md p-0.5 gap-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Sign In
                </button>

                <button @click="logout"
                    class="w-full h-8 text-blue-700 border border-blue-700 rounded-md p-0.5 gap-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                    </svg>
                    Sign Out
                </button>
            </div>

            <div class='flex flex-col items-center justify-center gap-y-4'>
                <a :href="'/visitor-registration/SignIn/reg/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[300px] h-20 sm:h-[83px] p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/createNew.png" class="pl-2 h-14 w-16 sm:w-16" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-[16px] font-bold text-blue-700">Guest <br>New Registration
                        </h3>
                        <p class="text-[10px] text-gray-500">Create New Account</p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/checkin/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[300px] h-20 sm:h-[83px] p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/check_in.png" class="pl-2 h-14 w-16 sm:w-16" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-[16px] font-bold text-blue-700">Check - In</h3>
                        <p class="w-36 sm:w-44 text-[10px]  text-gray-500">Log your check - in before entering
                            the
                            building
                        </p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/checkout/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[300px] h-20 sm:h-[83px] p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/check_out.png" class="pl-2 h-14 w-16 sm:w-16" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-[16px] font-bold text-blue-700">Check - Out</h3>
                        <p class="w-36 sm:w-44 text-[10px]  text-gray-500">Log your check - out before exiting
                            the
                            building
                        </p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/invite/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[300px] h-20 sm:h-[83px] p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/guest_invitation.png" class="pl-2 h-14 w-16 sm:w-16" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-[16px] font-bold text-blue-700">Invited Guest</h3>
                        <p class="w-44 text-[10px]  text-gray-500">For expected guest with provided invitation
                        </p>
                    </div>
                </a>

                <a v-if="this.isAllowed" :href="'/visitor-registration/SignIn/delivery/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[300px] h-20 sm:h-[83px] p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/delivery_service.png" class="pl-2 h-14 w-16 sm:w-16" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-[16px] font-bold text-blue-700">Delivery Service</h3>
                        <p class="text-[10px]  text-gray-500">Fill out delivery registration form
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div v-if="this.result != ''"
        class="flex items-center justify-center min-h-screen min-w-screen bg-gradient-to-br from-white to-blue-100">

        <div class="w-[320px] mx-5 flex flex-col items-center justify-center">
            <div class="text-center">
                <p class="text-xs text-gray-600">You are an</p>
                <p class="text-blue-800 font-bold text-2xl tracking-wide">Invitee</p>

                <div class="w-72 bg-gray-300 h-[1px] my-5"></div>

            </div>

            <div class="bg-white w-full px-4 py-8 flex flex-col items-center justify-evenly space-y-5 shadow-md shadow-gray-600 rounded-lg">

                <p class="text-sm text-left tracking-wider text-blue-800">Visitor Details</p>
                <table class="w-full text-[10px]">
                    <tr>
                        <td class="font-bold">Name: </td>
                        <td class="text-right">Juan Dela Cruz</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Email: </td>
                        <td class="text-right">jdc@gmail.com</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Contact Number: </td>
                        <td class="text-right">1234567890</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Reference Code: </td>
                        <td class="text-right">ABC123</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Type of ID: </td>
                        <td class="text-right">National ID</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Last Visit: </td>
                        <td class="text-right">Yesterday</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Status: </td>
                        <td class="text-right">Pending Approval</td>
                    </tr>
                </table>

                <div class="flex flex-col items-start justify-center w-full space-y-1">
                    <p class="text-[10px]">Purpose of Visit:</p>
                    <input type="text" disabled value="Meeting"
                        class="rounded bg-gray-50 text-left w-full text-gray-500 text-[10px] border-b border-blue-800 py-1 pl-4" />
                </div>

                <div class="flex flex-col items-start justify-center w-full space-y-1">
                    <p class="text-[10px]">Companion/s:</p>
                    <textarea disabled
                        class="rounded bg-gray-50 resize-none text-left w-full text-gray-500 text-[10px] border-b border-blue-800 py-1 pl-4 focus:outline-none h-14">Test, Test1, Test2</textarea>
                </div>

                <p class="text-sm text-left tracking-wider text-blue-800">Person to Visit Details</p>

                <table class="w-full text-[10px]">
                    <tr>
                        <td class="font-bold">Name: </td>
                        <td class="text-right">John Mark Pareja</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Location: </td>
                        <td class="text-right">Tondo Gaming</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Email Address: </td>
                        <td class="text-right">jmp@gmail.com</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Contact Number: </td>
                        <td class="text-right">1234567890</td>
                    </tr>
                </table>

                <!-- if not approved or pending approval, change button to close or back -->
                <button class="w-full rounded-md border border-blue-800 hover:bg-blue-800 hover:text-white text-xs px-1 py-1.5">
                    Check In Visitor
                </button>
            </div>
        </div>
    </div>

    <FormDialog :isOpen="isQrOpen" :Title="'SCAN QR CODE'">
        <template v-slot:body>
            <div>
                <div class="qrScanner">
                    <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
                        <button @click.prevent="switchCamera()"
                            class="absolute bottom-2 p-1 bg-gray-100 rounded border text-black hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>
                        </button>
                    </qrcode-stream>
                </div>
                <div class="text-center">
                    <span v-show="error != null" class="text-[10px] text-red-500">{{ error }}</span>
                </div>
            </div>
        </template>
    </FormDialog>
</template>

<script>
import axios from 'axios';
import { useStore } from '../../store/visitor';
import FormDialog from '../Elements/Modals/FormDialog.vue';
import { QrcodeStream } from 'vue3-qrcode-reader'
import { userAuthStore } from "@/store/auth";

const store = useStore();
const authStore = userAuthStore();

export default {
    name: 'Visitor Homepage',
    props: {
        data: {
            type: Array,
            default: []
        },
    },

    components: {
        FormDialog
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            isAllowed: true,
            guard_pm_authorized: false,
            isQrOpen: false,
            result: '',
            error: '',
            camera: 'rear',
            permission: {}
        }
    },
    methods: {
        async getData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                    this.isAllowed = this.buildings.building_type.delivery_form
                })
                .catch((e) => {
                });
        },

        openQR() {
            this.isQrOpen = !this.isQrOpen;
        },
        onDecode(result) {
            this.result = result
            this.isQrOpen = !this.isQrOpen;
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

        async logout() {
            await axios.post('/logout').then(({ data }) => {
                userAuthStore().signOut();
                this.$router.push('/')
            });
        }
    },
    created() {
        this.getData();
        if (userAuthStore().role.id == 4) {
            this.guard_pm_authorized = true;
        }
    },
}
</script>