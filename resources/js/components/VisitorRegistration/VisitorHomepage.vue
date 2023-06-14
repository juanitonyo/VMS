<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen flex justify-center">
            <div class="flex flex-col items-center justify-center gap-y-4">

                <img src="/logo/vms_logo.png" alt="logo" class="w-[180px]">

                <div class="flex flex-col items-center justify-center">
                    <h2 class="text-sm font-light tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[11px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class='flex flex-col items-center justify-center gap-y-4 mt-4'>
                    <a :href="'/visitor-registration/SignIn/reg/' + this.id"
                        class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105  w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img src="/Visitor_Homepage_Assets/createNew.png" class="pl-2 h-16 w-26" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-52 text-base font-bold text-blue-700">Guest <br>New Registration</h3>
                            <p class="text-[10px] text-gray-500">Create New Account</p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/SignIn/checkin/' + this.id"
                        class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img src="/Visitor_Homepage_Assets/check_in.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Check - In</h3>
                            <p class="w-56 text-[10px] text-gray-500">Log your check - in before entering the building
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/SignIn/checkout/' + this.id"
                        class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img src="/Visitor_Homepage_Assets/check_out.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Check - Out</h3>
                            <p class="text-[10px] text-gray-500">Log your check - out before exiting the building
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/SignIn/invite/' + this.id"
                        class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img src="/Visitor_Homepage_Assets/guest_invitation.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Invited Guest</h3>
                            <p class="w-40 text-[10px] text-gray-500">For expected guest with provided invitation
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/SignIn/delivery/' + this.id"
                        class=" select-none flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 active:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img src="/Visitor_Homepage_Assets/delivery_service.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Delivery Service</h3>
                            <p class="text-[10px] text-gray-500">Fill out delivery registration form
                            </p>
                        </div>
                    </a>
                </div>
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
        }
    },
    created() {
        axios.get('/api/visitor-registration?buildingUUID=' + this.id)
            .then((data) => {
                this.buildings = data.data.data;
            })
            .catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });

    },
}
</script>