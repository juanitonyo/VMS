<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen pt-10">
            <div class="flex flex-col items-center gap-y-5">

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

                    <router-link :to="'/visitor-registration/delivery/' + this.id">
                        <div
                            class=" relative w-[300px] h-[180px] border-2 border-red-700 rounded-xl flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-150 shadow-md shadow-slate-300 ">
                            <p class="text-xs text-red-600 absolute top-3">Are you a delivery crew/ rider? Tap here</p>
                            <img src="/Visitor_Homepage_Assets/delivery.png" alt="No Photo" class="mt-5">
                        </div>
                    </router-link>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name: 'Success',
    data() {
        return {
            id: window.location.href.split('/').pop(),        
        }
    },
}
</script>