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

                <form>
                    <div class="check_purpose space-y-3 mt-5">
                        <v-select id="dropdown" :placeholder="'What is the purpose of your visit? Tap here to select'"
                            :options="purpose" label="label"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-80"></v-select>
                        <input type="text" placeholder="Do you have other guests with you? Please type the name(s) here."
                            class="withguest text-[9px] border border-blue-700 rounded-[3px] pl-3 pt-1 pb-[80px] w-80">
                    </div>

                    <p class="text-sm text-blue-900 font-semibold leading-[20px] mt-5">Person To Visit</p>

                    <div class="space-y-3">
                        <div class="flex flex-col mt-4 gap-y-3">

                            <div class="flex flex-row items-center justify-between">
                                <label for="unitOwner" class="text-[10px] text-gray-500 mr-5">Unit Owner's Name</label>
                                <input type="text"
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[207px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="propertyAddress" class="text-[10px] text-gray-500 mr-5">Property Address</label>
                                <input type="text"
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[207px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="contact" class="text-[10px] text-gray-500 mr-5">Mobile Number</label>
                                <input type="tel"
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[207px]">
                            </div>

                        </div>
                    </div>


                    <!-- show only when status approved -->
                    <div>
                        <p class="text-sm text-blue-900 font-semibold leading-[20px] my-3">How are you feeling today?</p>

                        <div class="flex gap-x-3">

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300 focus:border-2 focus:border-blue-500 focus:scale-105"
                                @click="isGood" type="button">
                                <img src="/Visitor_Homepage_Assets/happy.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I am prefectly fine</span>
                            </button>

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300 focus:border-2 focus:border-blue-500 focus:scale-105"
                                @click.prevent="isOpen()">
                                <img src="/Visitor_Homepage_Assets/sad.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I feel not so good today</span>
                            </button>

                        </div>

                    </div>

                    <div v-show="goodHealth"
                        class="relative flex flex-row items-center justify-center w-[320px] text-gray-600 font-extralight mt-5 gap-x-3">
                        <input type="checkbox" class="absolute top-1 left-0 w-5 h-5 ">
                        <span class=" ml-8 text-[11px] leading-4">I hereby affirm that I am in good physical condition and
                            do
                            not suffer from any COVID-19 symptoms which would prevent on reporting physically in my office /
                            work station/ project site..
                        </span>
                    </div>

                    <div v-show="badHealth" class="flex justify-end mt-5">
                        <a href="#" class="underline text-red-500 text-[10px]">With Symptoms. Tap to view form</a>
                    </div>

                    <div class="flex flex-col mt-10 justify-center gap-y-2 mb-8">
                        <router-link :to="enableButton ? '/visitor-registration/success/invite/' + this.id : '/#'">
                            <input type="submit" value="Next" :disabled="!enableButton"
                                :class="[enableButton ? 'bg-green-600' : 'bg-gray-600']"
                                class="w-80 h-[33px] rounded-md  text-white text-xs flex items-center justify-center cursor-pointer">
                        </router-link>
                        <router-link :to="'/visitor-registration/SignIn/invite/' + this.id"
                            class="w-80 h-[33px] rounded-md bg-[#B3B3B3] hover:bg-[#B3B3B3]/75 text-white text-xs flex items-center justify-center cursor-pointer">Close</router-link>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <HealthForm :isOpen="pop">
        <template v-slot:healthFormBody>
            <form>
                <p class="text-[10px] text-center">Are you currently experiencing or have experienced any of these symptoms
                    in
                    the last 24 hours?</p>

                <div class="space-y-2 my-5">

                    <div class="w-full flex h-[45px] gap-x-3 shadow shadow-slate-200 p-2 rounded-md select-none" v-for="symptom in symptoms">
                        <input type="checkbox">
                        <img :src="symptom.image">
                        <div class="flex flex-col">
                            <p class="text-xs font-bold">{{ symptom.eng }}</p>
                            <p class="text-xs italic text-gray-500">{{ symptom.tag }}</p>
                        </div>
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585a1.5 1.5 0 0 1 1 1.415z" />
                                <path
                                    d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
                            </svg>
                        </div>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md w-full pl-10 p-1.5"
                            placeholder="--.- °C">
                    </div>
                </div>


                <div class="mt-5">
                    <button @click="isBad" type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-blue-600/90">
                        Submit
                    </button>
                    <button
                        class="mt-1 inline-flex w-full justify-center rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-400/90"
                        @click="isOpen" type="button">
                        Close
                    </button>
                </div>
            </form>
        </template>
    </HealthForm>
</template>

<script>
import axios from 'axios';
import HealthForm from '../../../Elements/Modals/HealthForm.vue';

export default {
    name: 'Invite Form',
    props: {
        data: {
            type: Array,
            default: []
        },
    },

    components: {
        HealthForm
    },

    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            open: false,
            pop: false,
            goodHealth: false,
            badHealth: false,
            buildings: {},
            purpose: [],
            enableButton: false,
            status: 'Pending Approval',
            symptoms: [
                {
                    image:'/hdf/Fever.png',
                    eng:'Fever',
                    tag:'Lagnat'
                },
                {
                    image:'/hdf/Cough.png',
                    eng:'Dry Cough',
                    tag:'Tuyong Ubo'
                },
                {
                    image:'/hdf/Sore Throat.png',
                    eng:'Sore Throat',
                    tag:'Namamagang Lalamunan'
                },
                {
                    image:'/hdf/Breathlessness.png',
                    eng:'Shortness of Breath',
                    tag:'Hirap sa Paghinga'
                },
                {
                    image:'/hdf/No Smell.png',
                    eng:'Loss of Smell / Taste',
                    tag:'Pagkawala ng Pang-Amoy o Panglasa'
                },
                {
                    image:'/hdf/Colds.png',
                    eng:'Runny Nose',
                    tag:'Sipon'
                },
                {
                    image:'/hdf/Fatigue.png',
                    eng:'Fatigue',
                    tag:'Pagkapagod'
                },
                {
                    image:'/hdf/Aches.png',
                    eng:'Aches and Pain',
                    tag:'Pananakit ng Katawan'
                },
                {
                    image:'/hdf/Diarrhea.png',
                    eng:'Diarrhea',
                    tag:'Pagdudumi'
                },
                {
                    image:'/hdf/Headache.png',
                    eng:'Headache',
                    tag:'Pananakit ng Ulo'
                },
                {
                    image:'/hdf/None.png',
                    eng:'None of the Above',
                    tag:'Wala sa mga Nabanggit'
                },

            ]
        }
    },

    methods: {
        isGood() {
            this.goodHealth = !this.goodHealth;
            this.badHealth = false
        },
        isBad(){
            this.badHealth = true
            this.pop = !this.pop;
        },
        isOpen() {

            this.goodHealth = false
            this.pop = !this.pop;
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