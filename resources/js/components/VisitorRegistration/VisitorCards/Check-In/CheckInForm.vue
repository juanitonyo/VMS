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
                        <p class="text-[9px] text-blue-800 font-light">Status: {{ this.status }}</p>
                    </div>
                </div>

                <form @submit.prevent="showSuccess()">
                    <div class="check_purpose space-y-3 mt-5">
                        <v-select id="dropdown" :placeholder="'What is the purpose of your visit? Tap here to select'"
                            :options="purpose" label="label"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-80"></v-select>
                        <input type="text" placeholder="Do you have other guests with you? Please type the name(s) here."
                            class="withguest text-[9px] border border-blue-700 rounded-[3px] pl-3 pt-1 pb-[80px] w-80">
                    </div>

                    <p class="text-[16px] text-blue-900 font-semibold leading-[20px] mt-3">Person To Visit</p>

                    <div class="flex flex-row mt-2 gap-x-3">
                        <div class="buildingSelect flex flex-col gap-y-1">
                            <label for="buildingName" class="text-gray-400 text-[10px]">Building/Phase</label>
                            <v-select id="dropdown" :options="purpose" label="label"
                                class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[165px]"></v-select>
                        </div>

                        <div class="flex flex-col gap-y-1">
                            <label for="flrBlk" class="text-gray-400 text-[10px]">Floor/Block</label>
                            <input type="text"
                                class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                        </div>

                        <div class="flex flex-col gap-y-1">
                            <label for="unitLot" class="text-gray-400 text-[10px]">Unit/Lot</label>
                            <input type="text"
                                class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 mt-3">
                        <input type="text" disabled value="" placeholder="Principal buyer's details"
                            class="bg-[#EEEEEE] placeholder:italic text-[9px] rounded-[3px] pl-3 h-[28px] w-80">
                        <input type="text" disabled value="" placeholder="Principal buyer’s contact number"
                            class="bg-[#EEEEEE] placeholder:italic text-[9px] rounded-[3px] pl-3 h-[28px] w-80">
                        <label for="visitName" class="text-gray-400 text-[10px]">
                            <input type="text" placeholder="Who will you visit? Enter the host’s name heree"
                                class=" text-[9px] border border-blue-700 rounded-[3px] pl-3 h-[28px] w-80">
                        </label>
                        <label for="visitContact" class="text-gray-400 text-[10px]">
                            <input type="text" placeholder="Enter the host’s mobile number. Example : 09191234567"
                                class="text-[9px] border border-blue-700 rounded-[3px] pl-3 h-[28px] w-80">
                        </label>
                    </div>

                    <div
                        class="relative flex flex-row items-center justify-center w-[310px] text-gray-600 font-extralight mt-3 gap-x-3">
                        <input type="checkbox" class="absolute top-0 left-0 w-5 h-5" @change="isChecked()">
                        <span class="ml-10 text-[10px] leading-4">By supplying the information on VMS registration form, I
                            affirm
                            that I have read,
                            understood and
                            hereby
                            accept the terms of Globalland Property Management, Inc. (“Company”) <a href=""
                                class="underline text-blue-700 font-semibold"> Web Application Privacy Policy</a> and
                            I
                            hereby consent to the collection, use, storage, processing, retention and disclosure by the
                            Company
                            of
                            all
                            the personal information (hereafter, “Personal Information”) I may have provided herein.
                        </span>
                    </div>

                    <div class="flex flex-col mt-10 justify-center gap-y-2 mb-8">
                        <router-link :to="enableButton ? '/visitor-registration/success/checkin/' + this.id : '/#'">
                            <input type="submit" value="Check In" :disabled="!enableButton"
                                :class="[enableButton ? 'bg-green-600' : 'bg-gray-600']"
                                class="w-80 h-[33px] rounded-md  text-white text-xs flex items-center justify-center cursor-pointer">
                        </router-link>
                        <router-link :to="'/visitor-registration/new/checkin/' + this.id"
                            class="w-80 h-[33px] rounded-md bg-[#B3B3B3] hover:bg-[#B3B3B3]/75 text-white text-xs flex items-center justify-center cursor-pointer">Close</router-link>
                    </div>

                </form>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

export default {
    name: 'Check In Form',
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
            form: new Form({
                id: '',
                refId: window.location.href.split('/').pop(),
                purpose: '',
                companions: '',
                buildingName: '',
                flrBlk: '',
                unitLot: '',
                policy: false,
            }),
            buildings: {},
            purpose: [],
            enableButton: false,
            isFormComplete: false,
            status: 'Pending Approval'
        }
    },

    methods: {
        isChecked(event) {
            this.enableButton = !this.enableButton
        },

        showSuccess() {
            // validate form
            this.form.post('/api/visitors/')
                .then((data) => {
                    this.isFormComplete = true
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },
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