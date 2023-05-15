<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center gap-y-5">
                <div class="flex justify-end items-center w-[360px] h-10 mt-8">
                    <button @click.prevent="isPop()">
                        <img src="/Visitor_Homepage_Assets/hamburgerMenu.png" alt="No Photo">
                    </button>
                </div>

                <div class="flex flex-col gap-y-2 items-center justify-center">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <p class="text-blue-800 text-lg font-semibold">Delivery</p>

                <div class="flex flex-col items-center justify-center w-[80px]">
                    <label for="dropzone-file" :style="{ 'background-image': `url(${profile_url})` }"
                        @click="$refs.profile.click()"
                        class="flex flex-col items-center justify-center w-full h-[80px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-7 pb-6" :class="{ 'hidden': hideLabel }">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input id="dropzone-file" ref="profile" type="file" class="opacity-0" @input="uploadImage" />
                    </label>
                </div>

                <form @submit.prevent="submitForm()">

                    <div class="relative mt-5">
                        <input type="text" id="courierName" name="courierName" v-model="form.courierName"
                            class="block px-2 pb-1 pt-2 w-full text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="courierName"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Company
                            /Business / Courier Name</label>
                    </div>

                    <div class="relative mt-5">
                        <input type="text" id="riderName" name="riderName" v-model="form.riderName"
                            class="block px-2 pb-1 pt-2 w-full text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="riderName"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Rider
                            Name (optional)</label>
                    </div>

                    <div class="relative mt-5">
                        <input type="tel" id="contact" name="contact" v-model="form.contact"
                            class="block px-2 pb-1 pt-2 w-full text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="contact"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Mobile
                            Number</label>
                    </div>

                    <p class="text-xs text-blue-900 font-semibold leading-[20px] mt-3">Person To Visit</p>


                    <div class="flex flex-col justify-center items-center">

                        <div class="flex flex-row mt-2 gap-x-2" v-for="(input, k) in inputs.slice(0, 10)" :key="k">
                            <div class="buildingDropdown flex flex-col gap-y-1">
                                <v-select v-model="input.buildingName" id="dropdown" :options="purpose" label="label"
                                    placeholder="Building/Phase"
                                    class="text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-[180px] "></v-select>
                            </div>

                            <div class="flex flex-col gap-y-1">
                                <input v-model="input.flrBlk" type="text" placeholder="Floor/Block"
                                    class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                            </div>

                            <div class="flex flex-col gap-y-1">
                                <input v-model="input.unitLot" type="text" placeholder="Unit/Lot"
                                    class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                            </div>

                        </div>

                        <div class="flex flex-row justify-center items-center gap-3 mb-2 w-full">
                            <button type="button" :class="inputs.length == 1 ? 'bg-gray-500' : 'bg-red-500 text-white'"
                                :disabled="inputs.length == 1" class="text-xs text-white rounded-md h-[33px] w-full mt-3"
                                @click="remove(k)">- Remove a
                                location</button>
                            <button type="button" :class="inputs.length == 10 ? 'bg-gray-500' : 'bg-blue-800 text-white'"
                                :disabled="inputs.length == 10"
                                class="text-xs text-white rounded-md h-[33px] w-full mt-3" @click="add(k)">+ Add more
                                location</button>
                        </div>

                    </div>
                    <!-- dont show below if health form for the building is false -->
                    <div>
                        <p class="text-xs text-blue-900 font-semibold leading-[20px] my-3">How are you feeling today?</p>

                        <div class="flex gap-x-3">

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300 focus:border-2 focus:border-blue-500 focus:scale-105"
                                @click="isGood" type="button">
                                <img src="/Visitor_Homepage_Assets/happy.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I am prefectly fine</span>
                            </button>

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300 focus:border-2 focus:border-blue-500 focus:scale-105"
                                @click="isBad" type="button" v-on:blur="">
                                <img src="/Visitor_Homepage_Assets/sad.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I feel not so good today</span>
                            </button>

                        </div>

                    </div>

                    <div v-show="goodHealth"
                        class="relative flex flex-row items-center justify-center w-[320px] text-gray-600 font-extralight mt-5 gap-x-3">
                        <input type="checkbox" class="absolute top-1 left-0 w-5 h-5" @change="isChecked()">
                        <span class=" ml-8 text-[11px] leading-4">I hereby affirm that I am in good physical condition and
                            do
                            not suffer from any COVID-19 symptoms which would prevent on reporting physically in my office /
                            work station/ project site..
                        </span>
                    </div>

                    <div v-show="badHealth" class="flex justify-end mt-5">
                        <button @click.prevent="isBad" class="underline text-red-500 text-[10px]">With Symptoms. Tap to view
                            form</button>
                    </div>

                    <div class="flex flex-row justify-center items-center gap-3 mb-10 mt-5">
                        <router-link :to="'/visitor-registration/SignIn/delivery/' + this.id"
                            class="w-[155px] h-[33px] mt-3 rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Close</router-link>
                        <router-link :to="enableButton ? '/visitor-registration/success/delivery/' + this.id : '/#'">
                            <button type="submit" :disabled="!enableButton"
                                :class="[enableButton ? 'bg-green-600' : 'bg-gray-600']"
                                class="w-[155px] h-[33px] mt-3 rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Next</button>
                        </router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <HealthForm :isOpen="pop" :Title="'Health Declaration'">
        <template v-slot:body>
            <form>
                <p class="text-[10px] text-center">Are you currently experiencing or have experienced any of these symptoms
                    in
                    the last 24 hours?</p>

                <div class="space-y-2 my-5">

                    <div class="w-full flex h-[45px] gap-x-3 shadow-sm shadow-slate-400 p-2 rounded-md select-none"
                        v-for="symptom in symptoms">
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
                            class="peer bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md w-full pl-10 p-1.5"
                            placeholder="--.- °C" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1').replace(/^0[^.]/, '0');">
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

    <Account :isPop="show" :Title="'My Account'">
        <template v-slot:body>

            <div class="flex justify-center items-center">
                <div class="w-[80px] flex flex-col gap-y-1">
                    <label for="dropzone-file" :style="{ 'background-image': `url(${profile_url})` }"
                        @click="$refs.profile.click()"
                        class="flex flex-col items-center justify-center w-full h-[80px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-7 pb-6" :class="{ 'hidden': hideLabel }">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input id="dropzone-file" ref="profile" type="file" class="opacity-0" @input="uploadImage" />
                    </label>
                    <p class="text-[10px] text-gray-400 flex justify-center">Replace Photo</p>
                </div>
            </div>

            <div class="flex flex-col mt-8 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="email" class="text-[10px] text-gray-500 mr-6">Email Address</label>
                    <input type="email" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="contact" class="text-[10px] text-gray-500 mr-4">Mobile Number</label>
                    <input type="tel" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="id" class="text-[10px] text-gray-500 mr-14">Valid ID</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>

            <div class="mt-5 flex flex-row justify-end mr-3">
                <div class="flex flex-row items-center">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                    <label for="dropzone-file" :style="{ 'background-image': `url(${front_url})` }"
                        @click="$refs.front.click()"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="{ 'hidden': hideLabel }">
                            <img src="/Visitor_Homepage_Assets/frontID.png" alt="">
                        </div>
                        <input id="dropzone-file" ref="front" type="file" class="opacity-0" @input="uploadImage" />
                    </label>
                </div>

                <div class="flex flex-row items-center ml-2">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                    <label for="dropzone-file" :style="{ 'background-image': `url(${back_url})` }"
                        @click="$refs.back.click()"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="{ 'hidden': hideLabel }">
                            <img src="/Visitor_Homepage_Assets/backID.png" alt="">
                        </div>
                        <input id="dropzone-file" ref="back" type="file" class="opacity-0" @change="uploadImage" />
                    </label>
                </div>
            </div>
            <p class="text-blue-800 text-base font-semibold mt-5">Last Activity</p>

            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="fullname" class="text-[10px] text-gray-500 mr-[70px]">Type</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="email" class="text-[10px] text-gray-500 mr-[53px]">Check In</label>
                    <input type="email" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[231px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row r justify-center">
                    <label for="deliveryHistory" class="text-[10px] text-gray-500 mr-[55px]">Delivery</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[68px] w-[231px]">
                </div>
            </div>

            <div class="mt-5">
                <button type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-blue-600/90">
                    Update
                </button>
                <button
                    class="mt-1 inline-flex w-full justify-center rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-400/90"
                    @click="isPop" type="button">
                    Close
                </button>
            </div>

        </template>
    </Account>
</template>

<script>
import axios from 'axios';
import Form from 'vform'
import HealthForm from '../../../Elements/Modals/HealthForm.vue';
import Account from '../../../Elements/Modals/MyAccount.vue';

export default {

    name: 'Delivery Form',
    props: {
        data: {
            type: Array,
            default: []
        },
    },

    components: {
        HealthForm, Account,
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            open: false,
            pop: false,
            show: false,
            goodHealth: false,
            badHealth: false,
            enableButton: false,
            isFormComplete: false,
            form: new Form({
                id: '',
                courierName: '',
                riderName: '',
                contact: ''
            }),
            symptoms: [
                {
                    image: '/hdf/Fever.png',
                    eng: 'Fever',
                    tag: 'Lagnat'
                },
                {
                    image: '/hdf/Cough.png',
                    eng: 'Dry Cough',
                    tag: 'Tuyong Ubo'
                },
                {
                    image: '/hdf/Sore Throat.png',
                    eng: 'Sore Throat',
                    tag: 'Namamagang Lalamunan'
                },
                {
                    image: '/hdf/Breathlessness.png',
                    eng: 'Shortness of Breath',
                    tag: 'Hirap sa Paghinga'
                },
                {
                    image: '/hdf/No Smell.png',
                    eng: 'Loss of Smell / Taste',
                    tag: 'Pagkawala ng Pang-Amoy o Panglasa'
                },
                {
                    image: '/hdf/Colds.png',
                    eng: 'Runny Nose',
                    tag: 'Sipon'
                },
                {
                    image: '/hdf/Fatigue.png',
                    eng: 'Fatigue',
                    tag: 'Pagkapagod'
                },
                {
                    image: '/hdf/Aches.png',
                    eng: 'Aches and Pain',
                    tag: 'Pananakit ng Katawan'
                },
                {
                    image: '/hdf/Diarrhea.png',
                    eng: 'Diarrhea',
                    tag: 'Pagdudumi'
                },
                {
                    image: '/hdf/Headache.png',
                    eng: 'Headache',
                    tag: 'Pananakit ng Ulo'
                },
                {
                    image: '/hdf/None.png',
                    eng: 'None of the Above',
                    tag: 'Wala sa mga Nabanggit'
                },

            ],
            inputs: [
                {
                    buildingName: '',
                    flrBlk: '',
                    unitLot: ''
                }
            ]
        }
    },

    methods: {
        add(index) {
            this.inputs.push({ name: '' });
        },
        remove(index) {
            this.inputs.splice(index, 1);
        },
        isGood() {
            this.goodHealth = !this.goodHealth;
            this.badHealth = false
        },
        isBad() {
            this.badHealth = true
            this.pop = !this.pop;
        },
        isOpen() {
            this.goodHealth = false
            this.pop = !this.pop;
        },
        isPop() {
            this.show = !this.show;
        },
        isChecked() {
            this.enableButton = !this.enableButton
        },
        submitForm(){
            this.$Progress.start();
            this.form.post('/api/delivery/')
                .then((data) => {
                    this.$Progress.finish();
                    this.isFormComplete = true
                }).catch((error) => {
                    this.$Progress.fail();
                })
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