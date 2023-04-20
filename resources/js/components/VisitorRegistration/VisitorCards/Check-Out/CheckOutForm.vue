<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center gap-y-5">
                <div class="flex justify-end items-center w-[360px] h-10 mt-8">
                    <button>
                        <img src="/Visitor_Homepage_Assets/hamburgerMenu.png" alt="No Photo">
                    </button>
                </div>

                <div class="flex flex-col gap-y-2 items-center justify-center">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class="flex flex-row mt-4 gap-x-5">
                    <img src="https://picsum.photos/400/400" alt="No Photo"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, Visitor</p>
                        <p class="text-[9px] text-blue-800 font-light">Visit: Walk - In</p>
                        <p class="text-[9px] text-blue-800 font-light">Status: Status Here</p>
                    </div>
                </div>
                <div>
                    <div class="space-y-3 ">
                        <div class="flex flex-col mt-8 gap-y-3">

                            <div class="flex flex-row items-center justify-between">
                                <label for="visitType" class="text-[10px] text-gray-500">Visit Type</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="companions" class="text-[10px] text-gray-500">Companion(s)</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                        </div>
                    </div>

                    <p class="text-[16px] text-blue-900 font-semibold leading-[20px] mt-5">Person To Visit</p>

                    <div class="space-y-3">
                        <div class="flex flex-col mt-8 gap-y-3">

                            <div class="flex flex-row items-center justify-between">
                                <label for="propertyAddress" class="text-[10px] text-gray-500 mr-5">Property Address</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="principalOwner" class="text-[10px] text-gray-500 mr-5">Principal Owner</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>


                            <div class="flex flex-row items-center justify-between">
                                <label for="contact" class="text-[10px] text-gray-500 mr-5">Mobile Number</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="host" class="text-[10px] text-gray-500 mr-5">Host Name</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="hostContact" class="text-[10px] text-gray-500 mr-5">Host Mobile Number</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[240px]">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex flex-col mt-10 justify-center gap-y-2 mb-8">
                    <router-link
                        :to="this.status ? '/visitor-registration/success/checkout/' + this.id : '/visitor-registration/new/checkout/' + this.id"
                        :class="[this.status ? 'bg-[#890707] hover:bg-[#750505]' : 'bg-[#B3B3B3] hover:bg-[#B3B3B3]/75', 'w-80 h-[33px] rounded-md  text-white text-xs flex items-center justify-center cursor-pointer']">{{
                            this.status ? 'Checkout' : 'Close' }}</router-link>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Check Out Form',
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
            purpose: [],
            enableButton: false,
            status: true,
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