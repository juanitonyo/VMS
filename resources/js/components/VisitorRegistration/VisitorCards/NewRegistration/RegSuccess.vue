<template>
    <div class="flex justify-center items-center min-h-screen min-w-screen bg-background bg-cover">
        <div class="flex flex-col items-center justify-center gap-y-5 h-screen w-screen sm:w-auto sm:shadow-lg shadow-none sm:px-5 px-0 sm:py-10 py-0 sm:rounded-lg rounded-none bg-white">

            <div class="flex flex-col items-center justify-center gap-y-3">
                <img src="/Visitor_Homepage_Assets/successIcon.png" class="w-12 h-12">
                <p class="text-lg tracking-wide text-green-500 font-bold">Registration Successful</p>
            </div>

            <div class="mb-5">
                <p class="text-[10px] text-gray-400 text-center">Complete your check in by tapping any of the button
                    below</p>
            </div>

            <div class="flex flex-col gap-y-5">
                <!-- <router-link :to="'/visitor-registration/details/' + this.id"
                class="w-[280px] h-[35px] rounded-md bg-[#3066BE] text-white text-xs flex items-center justify-center cursor-pointer">Check
                In</router-link> -->

                <router-link :to="'/visitor-registration/checkin/' + this.id">
                    <div
                        class=" relative w-[300px] h-[180px] border-2 border-blue-700 rounded-xl flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-150 shadow-md shadow-slate-300 ">
                        <p class="text-xs text-blue-700 absolute top-3">Are you visiting someone? Tap here</p>
                        <img src="/Visitor_Homepage_Assets/visiting.png" alt="No Photo">
                    </div>
                </router-link>

                <router-link :to="this.isDeliveryAllowed ? '/visitor-registration/delivery/' + this.id : ''">
                    <div
                        :class="[this.isDeliveryAllowed ? 'hover:scale-105 ease-in-out duration-150 shadow-md shadow-slate-300 border-red-700' : 'border-gray-700', 'relative w-[300px] h-[180px] border-2 rounded-xl flex flex-col justify-center items-center gap-y-2']">
                        <p
                            :class="[this.isDeliveryAllowed ? 'text-red-600' : 'text-gray-600 opacity 70', 'text-xs absolute top-3']">
                            Are you a delivery crew/ rider? Tap here</p>
                        <img src="/Visitor_Homepage_Assets/delivery.png" alt="No Photo"
                            :class="[this.isDeliveryAllowed ? '' : 'opacity-70', 'mt-5']">
                        <span v-if="!this.isDeliveryAllowed"
                            class="w-full bg-gray-200 justify-center text-xs text-center text-gray-600 absolute p-2">Not
                            Allowed</span>
                    </div>
                </router-link>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useStore } from '../../../../store/visitor';

const store = useStore();

export default {
    name: 'Success',
    data() {
        return {
            id: window.location.href.split('/').pop(),
            isDeliveryAllowed: false,
            building: {}
        }
    },
    methods: {
        async getData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.building = data.data.data;
                    this.isDeliveryAllowed = this.building.building_type.delivery_form
                })
                .catch((error) => {

                });
        },
    },

    created() {
        this.getData();
        store.setHiddenLog('Walk-In');
        store.setHiddenParam(store.hiddenID);
    }
}
</script>