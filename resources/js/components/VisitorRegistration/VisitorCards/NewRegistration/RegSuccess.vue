<template>
    <div class="flex flex-col items-center justify-center min-w-screen min-h-screen gap-y-20">

        <div class="flex flex-col items-center justify-center gap-y-10">
            <img src="/Visitor_Homepage_Assets/successIcon.png" alt="no photo" class="w-[160px] h-[160px]">
            <p class="text-lg text-green-500 font-bold">Registration Successful</p>
        </div>

        <div>
            <p class="text-xs text-[#1F4583] text-center">Click Check in to record your <span class="font-bold">check in</span> details
            </p>
        </div>

        <div>
            <router-link :to="'/visitor-registration/details/' + this.id"
                class="w-[280px] h-[35px] rounded-md bg-[#3066BE] text-white text-xs flex items-center justify-center cursor-pointer">Check
                In</router-link>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Success',
}
</script>