<template>
    <div class="flex justify-center items-center min-h-screen min-w-screen" :class="pm ? 'bg-gradient-to-br from-white to-blue-100' : ''">
        <div class="flex flex-col items-center justify-center gap-y-4">

            <img src="/logo/vms_logo.png" alt="logo" class="w-[180px]">

            <div class="flex flex-col items-center justify-center">
                <h2 class="text-sm font-light tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                <h4 class="text-[10px] text-gray-400 text-center w-80">{{ this.buildings.address }}</h4>
            </div>

            <div v-show="pm" class="actions flex items-center justify-center gap-1.5 w-[280px] text-xs font-light">
                <button
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

                <button
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
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[325px] h-20 sm:h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/createNew.png" class="pl-2 h-14 sm:h-16 w-16 sm:w-26" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-base font-bold text-blue-700">Guest <br>New Registration</h3>
                        <p class="text-[9px] sm:text-[10px] text-gray-500">Create New Account</p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/checkin/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[325px] h-20 sm:h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/check_in.png" class="pl-2 h-14 sm:h-16 w-16 sm:w-26" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-base font-bold text-blue-700">Check - In</h3>
                        <p class="w-36 sm:w-52 text-[9px] sm:text-[10px] text-gray-500">Log your check - in before entering the
                            building
                        </p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/checkout/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[325px] h-20 sm:h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/check_out.png" class="pl-2 h-14 sm:h-16 w-16 sm:w-26" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-base font-bold text-blue-700">Check - Out</h3>
                        <p class="w-36 sm:w-52 text-[9px] sm:text-[10px] text-gray-500">Log your check - out before exiting the
                            building
                        </p>
                    </div>
                </a>

                <a :href="'/visitor-registration/SignIn/invite/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[325px] h-20 sm:h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">


                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/guest_invitation.png" class="pl-2 h-14 sm:h-16 w-16 sm:w-26" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-base font-bold text-blue-700">Invited Guest</h3>
                        <p class="w-40 text-[9px] sm:text-[10px] text-gray-500">For expected guest with provided invitation
                        </p>
                    </div>
                </a>

                <a v-if="this.isAllowed" :href="'/visitor-registration/SignIn/delivery/' + this.id"
                    class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[280px] sm:w-[325px] h-20 sm:h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                    <div class="block sm:shrink-0">
                        <img src="/Visitor_Homepage_Assets/delivery_service.png" class="pl-2 h-14 sm:h-16 w-16 sm:w-26" />
                    </div>

                    <div class="flex flex-col justify-center pl-4">
                        <h3 class="w-36 sm:w-52 text-sm sm:text-base font-bold text-blue-700">Delivery Service</h3>
                        <p class="text-[9px] sm:text-[10px] text-gray-500">Fill out delivery registration form
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useStore } from '../../store/visitor';

const store = useStore();

export default {
    name: 'Visitor Homepage',
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
            isAllowed: true,
            pm: false
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
        }
    },
    created() {
        this.getData();
    },
}
</script>