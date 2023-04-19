<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen pt-10">
            <div class="flex flex-col items-center gap-y-5">

                <div class="flex flex-col gap-y-2 items-center justify-center">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[9px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class='flex flex-col items-center justify-center gap-y-4 mt-10'>

                    <a :href="'/visitor-registration/new/reg/' + this.id"
                        class=" flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img alt="No Icon" src="/Visitor_Homepage_Assets/createNew.png" class="pl-2 h-16 w-26" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-52 leading-5 text-base font-bold text-blue-700">Guest <br>New Registration</h3>
                            <p class="text-[10px] text-gray-500">Create New Account</p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/new/checkin/' + this.id"
                        class=" flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img alt="No Icon" src="/Visitor_Homepage_Assets/check_in.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Check - In</h3>
                            <p class="w-56 text-[10px] text-gray-500">Log your check - in before entering the building
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/#/' + this.id"
                        class=" flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img alt="No Icon" src="/Visitor_Homepage_Assets/check_out.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Check - Out</h3>
                            <p class="text-[10px] text-gray-500">Log your check - out before exiting the building
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/#/' + this.id"
                        class=" flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img alt="No Icon" src="/Visitor_Homepage_Assets/guest_invitation.png" class="h-16 w-16" />
                        </div>

                        <div class="flex flex-col justify-center pl-4">
                            <h3 class="w-56 text-base font-bold text-blue-700">Invited Guest</h3>
                            <p class="w-40 text-[10px] text-gray-500">For expected guest with provided invitation
                            </p>
                        </div>
                    </a>

                    <a :href="'/visitor-registration/#/' + this.id"
                        class=" flex overflow-hidden rounded-lg border-2 border-blue-700 hover:scale-105 w-[325px] h-24 p-3 shadow-md shadow-slate-400 justify-start ease-in-out duration-300">

                        <div class="block sm:shrink-0">
                            <img alt="No Icon" src="/Visitor_Homepage_Assets/delivery_service.png" class="h-16 w-16" />
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