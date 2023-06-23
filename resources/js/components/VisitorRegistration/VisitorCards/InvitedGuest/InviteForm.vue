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
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class="flex flex-row mt-4 gap-x-5">
                    <img :src="'/uploads/profiles/' + this.visitor.profilePhoto" alt="Photo not available"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200 text-[10px] text-center">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, {{ this.visitor.name
                        }}</p>
                        <p class="text-[9px] text-blue-800 font-light">Visit: Invitee</p>
                        <p class="text-[9px] text-blue-800 font-light">Status: Pending Approval</p>
                    </div>
                </div>

                <form>
                    <div class="check_purpose space-y-3 mt-5">
                        <v-select id="dropdown" :placeholder="'What is the purpose of your visit? Tap here to select'"
                            :options="purpose" label="label"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-1 h-[28px] w-80"></v-select>
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
                    <div v-show="status == true">
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
                        <input type="checkbox" class="absolute top-1 left-0 w-5 h-5 " @change="isChecked()">
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

    <FormDialog :isOpen="pop" :Title="'Health Declaration'">
        <template v-slot:body>
            <form>
                <p class="text-[10px] text-center">Are you currently experiencing or have experienced any of these symptoms
                    in
                    the last 24 hours?</p>

                <div class="space-y-2 my-5">

                    <div class="w-full flex h-[45px] gap-x-3 shadow-sm shadow-slate-400 p-2 rounded-md select-none"
                        v-for="symptom in this.symptoms">
                        <input v-model="symptom.state" type="checkbox" v-bind:id="symptoms.id"
                            v-on:click="saveToArray(symptom.id)">
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
                            placeholder="--.- °C"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1').replace(/^0[^.]/, '0');">
                    </div>
                </div>


                <div class="mt-5">
                    <button @click.prevent="submitForm()" type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-blue-600/90">
                        Submit
                    </button>
                    <button
                        class="mt-1 inline-flex w-full justify-center rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-400/90"
                        @click.prevent="isOpen()" type="button">
                        Close
                    </button>
                </div>
            </form>
        </template>
    </FormDialog>

    <FormDialog :isOpen="show" :Title="'My Account'">
        <template v-slot:body>

            <div class="flex justify-center items-center w-full">
                <div class="w-[80px] flex flex-col gap-y-1">
                    <label :style="{ 'background-image': `url(${profile_url})` }"
                        class="flex flex-col items-center justify-center w-full h-[80px] border-2 border-blue-700 rounded-full cursor-pointer hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-7 pb-6">
                            <img v-if="this.visitor.profile_photo == null" src="/Visitor_Homepage_Assets/uploadphoto.png"
                                alt="">
                        </div>
                        <input ref="profile" type="file" class="opacity-0 w-full h-full cursor-pointer"
                            accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadProfile" />
                    </label>
                    <p class="text-[10px] text-gray-400 flex justify-center">Replace Photo</p>
                </div>
            </div>

            <div class="flex flex-col justify-center mx-[12px]">
                <div class="flex flex-col mt-8 ">
                    <div class="flex flex-row items-center justify-center">
                        <label for="fullname" class="text-[10px] text-gray-500 w-[144px]">Name</label>
                        <input v-model="visitor.name" type="text"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-full">
                    </div>
                </div>
                <div class="flex flex-col mt-3 ">
                    <div class="flex flex-row items-center justify-center">
                        <label for="email" class="text-[10px] text-gray-500 w-36">Email Address</label>
                        <input v-model="visitor.email" type="email"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-full">
                    </div>
                </div>
                <div class="flex flex-col mt-3 ">
                    <div class="flex flex-row items-center justify-between">
                        <label for="contact" class="text-[10px] text-gray-500 w-[144px]">Mobile Number</label>
                        <input v-model="visitor.contact" type="tel"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-full">
                    </div>
                </div>
                <div class="flex flex-col mt-3 ">
                    <div class="flex flex-row items-center justify-between">
                        <label for="id" class="text-[10px] text-gray-500 w-[144px]">Valid ID</label>
                        <input v-model="visitor.valid_id" type="text"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-full">
                    </div>
                </div>

                <div class="mt-5 flex flex-row justify-end mr-3">
                    <div class="flex flex-row">
                        <p class="w-10 text-[10px] text-gray-500">Front</p>
                        <label :style="{ 'background-image': `url(${front_url})` }"
                            class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img v-if="this.visitor.front_id == null" src="/Visitor_Homepage_Assets/frontID.png" alt="">
                            </div>
                            <input ref="front" type="file" class="opacity-0 w-full h-full cursor-pointer"
                                accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadFront" />
                        </label>
                    </div>

                    <div class="flex flex-row ml-2">
                        <p class="w-10 text-[10px] text-gray-500">Back</p>
                        <label :style="{ 'background-image': `url(${back_url})` }"
                            class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img v-if="this.visitor.back_id == null" src="/Visitor_Homepage_Assets/backID.png" alt="">
                            </div>
                            <input ref="back" type="file" class="opacity-0 w-full h-full cursor-pointer"
                                accept="image/png, image/jpeg, image/jpg, image/svg" @change="uploadBack" />
                        </label>
                    </div>
                </div>
                <p class="text-blue-800 text-base font-semibold mt-5">Last Activity</p>

                <div class="mt-3">
                    <div class="flex flex-row items-center justify-center">
                        <label for="fullname" class="text-[10px] text-gray-500 w-[144px]">Type</label>
                        <p
                            class="text-[10px] border rounded-[3px] border-blue-700 h-[28px] py-1.5 pl-2 w-full">
                            {{ this.permission != null ? 'Invitee' : 'Walk-In' }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex flex-row justify-center items-center">
                        <label for="email" class="text-[10px] text-gray-500 w-[144px]">Check In</label>
                        <p class="text-[10px] border rounded-[3px] border-blue-700 h-[28px] py-1.5 pl-2 w-full">
                            {{ this.visitor.latest_log == null ? 'N/A' :
                                moment(this.visitor.latest_log.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                    </div>
                </div>
                <div class="mt-3 ">
                    <div class="flex flex-row justify-center items-center">
                        <label for="contact" class="text-[10px] text-gray-500 w-[144px]">Approved</label>
                        <p
                            class="text-[10px] border rounded-[3px] border-blue-700 h-[28px] py-1.5 pl-2 w-full">
                            {{ this.visitor.status ? 'Approved' : 'Pending Approval' }}</p>
                    </div>
                </div>

                <div class="mt-14">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-blue-600/90">
                        Update
                    </button>
                </div>
            </div>

        </template>
    </FormDialog>
</template>

<script>
import axios from 'axios';
import FormDialog from '../../../Elements/Modals/FormDialog.vue';

export default {
    name: 'Invite Form',
    props: {
        data: {
            type: Array,
            default: []
        },
        symptoms: {
            type: Array,
            default: []
        }
    },

    components: {
        FormDialog
    },

    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            open: false,
            pop: false,
            show: false,
            goodHealth: false,
            badHealth: false,
            buildings: {},
            visitor: {},
            purpose: [],
            enableButton: false,
            status: true,
            symptoms: [
                {
                    id: 0,
                    image: '/hdf/Fever.png',
                    state: false,
                    eng: 'Fever',
                    tag: 'Lagnat'
                },
                {
                    id: 1,
                    image: '/hdf/Cough.png',
                    state: false,
                    eng: 'Dry Cough',
                    tag: 'Tuyong Ubo'
                },
                {
                    id: 2,
                    image: '/hdf/Sore Throat.png',
                    state: false,
                    eng: 'Sore Throat',
                    tag: 'Namamagang Lalamunan'
                },
                {
                    id: 3,
                    image: '/hdf/Breathlessness.png',
                    state: false,
                    eng: 'Shortness of Breath',
                    tag: 'Hirap sa Paghinga'
                },
                {
                    id: 4,
                    image: '/hdf/No Smell.png',
                    state: false,
                    eng: 'Loss of Smell / Taste',
                    tag: 'Pagkawala ng Pang-Amoy o Panglasa'
                },
                {
                    id: 5,
                    image: '/hdf/Colds.png',
                    state: false,
                    eng: 'Runny Nose',
                    tag: 'Sipon'
                },
                {
                    id: 6,
                    image: '/hdf/Fatigue.png',
                    state: false,
                    eng: 'Fatigue',
                    tag: 'Pagkapagod'
                },
                {
                    id: 7,
                    image: '/hdf/Aches.png',
                    state: false,
                    eng: 'Aches and Pain',
                    tag: 'Pananakit ng Katawan'
                },
                {
                    id: 8,
                    image: '/hdf/Diarrhea.png',
                    state: false,
                    eng: 'Diarrhea',
                    tag: 'Pagdudumi'
                },
                {
                    id: 9,
                    image: '/hdf/Headache.png',
                    state: false,
                    eng: 'Headache',
                    tag: 'Pananakit ng Ulo'
                },
                {
                    id: 10,
                    image: '/hdf/None.png',
                    state: false,
                    eng: 'None of the Above',
                    tag: 'Wala sa mga Nabanggit'
                },
            ],
            health_form: [],
        }
    },

    methods: {
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
        async syncData() {
            await axios.get('/api/sync-visitor/')
                .then((data) => {
                    this.visitor = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        },
        async getData() {
            axios.get('/api/visitor-registration/' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        },

        saveToArray(id) {
            if (this.health_form.includes(id)) {
                this.health_form.pop(id);
            }
            else {
                this.health_form.push(id)
            }

            console.log(this.health_form);
        },

        submitForm() {
            this.form = this.health_form.join(" and ");
            console.log(this.form)
        }
    },

    created() {
        this.syncData();
        this.getData();
    },
}
</script>