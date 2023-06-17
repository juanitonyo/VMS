<template>
    <div class="flex justify-center items-center">
        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center gap-y-5">
                <div class="flex justify-end items-center w-[360px] h-10 mt-8">
                    <button @click.prevent="isPop()">
                        <img src="/Visitor_Homepage_Assets/hamburgerMenu.png">
                    </button>
                </div>

                <div class="flex flex-col gap-y-2 items-center justify-center">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class="flex flex-row mt-4 gap-x-5">
                    <img :src="this.profile_url" alt="Photo not available"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200 text-[10px] text-center">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, {{ this.visitor.name
                        }}</p>
                        <p class="text-[9px] text-blue-800 font-light">Visit: {{ this.permission.authenticated ? 'Invitee' :
                            'Walk-In' }}</p>
                        <p class="text-[9px] text-blue-800 font-light">Status: {{ this.visitor.status ? 'Approved' :
                            'Pending Approval' }}</p>
                    </div>
                </div>

                <form @submit.prevent="checkInVisitor()">
                    <div class="check_purpose space-y-3 mt-5">
                        <v-select v-model="selectedPurpose" id="dropdown"
                            :placeholder="'What is the purpose of your visit? Tap here to select'" :options="visitType"
                            label="label" class="text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-80"></v-select>
                        <!-- split the companions -->
                        <textarea type="text" placeholder="Do you have other guests with you? Please type the name(s) here."
                            class="withguest text-[9px] border border-blue-700 rounded-[3px] pl-2 pt-1 w-80 h-[100px] resize-none"></textarea>
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

                    <div class="host flex flex-col space-y-2 mt-3">
                        <input type="text" disabled value="" placeholder="Principal buyer's details"
                            class="bg-[#EEEEEE] placeholder:italic text-[9px] rounded-[3px] pl-3 h-[28px] w-80">
                        <input type="text" disabled value="" placeholder="Principal buyer’s contact number"
                            class="bg-[#EEEEEE] placeholder:italic text-[9px] rounded-[3px] pl-3 h-[28px] w-80">
                        <label for="visitName" class="text-gray-400 text-[10px]">
                            <!-- <input type="text" placeholder="Who will you visit? Enter the host’s name here"
                                class=" text-[9px] border border-blue-700 rounded-[3px] pl-3 h-[28px] w-80"> -->
                            <v-select :options="user" label="label"
                                :placeholder="'Who will you visit? Enter the host’s name here'"
                                class="text-[10px] border border-blue-700 rounded-[3px] h-7 w-80"></v-select>
                        </label>
                        <label for="visitContact" class="text-gray-400 text-[10px]">
                            <input type="text" placeholder="Enter the host’s mobile number. Example : 09191234567"
                                class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-80">
                        </label>
                    </div>

                    <div>
                        <p class="text-xs text-blue-900 font-semibold leading-[20px] my-3">How are you feeling today?</p>

                        <div class="flex gap-x-3 w-80">

                            <button :disabled="good" :class="badHealth ? '' : 'hover:scale-105 ease-in-out duration-300'"
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 focus:border-2 focus:border-blue-500 focus:scale-105"
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

                    <!-- if no hdf, stay here. else single-->
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
                        <button type="submit" :disabled="!enableButton"
                            :class="[enableButton ? 'bg-green-600' : 'bg-gray-600']"
                            class="w-80 h-[33px] rounded-md  text-white text-xs flex items-center justify-center cursor-pointer">
                            Check In
                        </button>
                        <router-link :to="'/visitor-registration/SignIn/checkin/' + this.id"
                            class="w-80 h-[33px] rounded-md bg-[#B3B3B3] hover:bg-[#B3B3B3]/75 text-white text-xs flex items-center justify-center cursor-pointer">Close</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <FormDialog :isOpen="show" :Title="'My Account'">
        <template v-slot:body>

            <div class="flex justify-center items-center w-full ">
                <div class="w-full flex items-center justify-center flex-col gap-y-1">
                    <label :style="{ 'background-image': `url(${profile_url})` }"
                        class="flex flex-col items-center justify-center w-[92px] h-[80px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <img v-show="this.account.visitor.profile_photo == null" src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input type="file" ref="profile" class="opacity-0"
                            accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadProfile" />
                    </label>
                    <p class="text-[10px] text-gray-400 flex justify-center">Replace Photo</p>
                </div>
            </div>

            <div class="flex flex-col mt-8 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                    <input v-model="visitor.name" type="text"
                        class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="email" class="text-[10px] text-gray-500 mr-7">Email Address</label>
                    <input v-model="visitor.email" type="email"
                        class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="contact" class="text-[10px] text-gray-500 mr-5">Mobile Number</label>
                    <input v-model="visitor.contact" type="tel"
                        class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="id" class="text-[10px] text-gray-500 mr-14">Valid ID</label>
                    <input v-model="visitor.valid_id" type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>

            <div class="mt-5 flex flex-row justify-end mr-3">
                <div class="flex flex-row items-center">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                    <label :style="{ 'background-image': `url(${front_url})` }"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <img v-show="this.account.visitor.front_id == null" src="/Visitor_Homepage_Assets/frontID.png" alt="Photo not Available">
                        </div>
                        <input ref="front" type="file" class="opacity-0" @input="uploadFrontID"
                            accept="image/png, image/jpeg, image/jpg, image/svg" />
                    </label>
                </div>

                <div class="flex flex-row items-center ml-2">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                    <label :style="{ 'background-image': `url(${back_url})` }"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <img v-show="this.account.visitor.back_id == null" src="/Visitor_Homepage_Assets/backID.png" alt="">
                        </div>
                        <input ref="back" type="file" class="opacity-0" @input="uploadBackID"
                            accept="image/png, image/jpeg, image/jpg, image/svg" />
                    </label>
                </div>
            </div>
            <p class="text-blue-800 text-base font-semibold mt-5">Last Activity</p>

            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-left">
                    <label for="fullname" class="text-[10px] text-gray-500 ml-3">Type</label>
                    <p class="text-[10px] ml-[67px]">{{ this.permission != null ? 'Invitee' : 'Walk-In' }}</p>
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row justify-left items-center">
                    <label for="email" class="text-[10px] text-gray-500 ml-3">Check In</label>
                    <p class="text-[10px] ml-[50px]">{{ this.visitor.latest_log == null ? 'N/A' :
                        moment(this.visitor.latest_log.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row justify-left items-center">
                    <label for="contact" class="text-[10px] text-gray-500 ml-3">Approved</label>
                    <p class="text-[10px] ml-[42px]">{{ this.visitor.status ? 'Approved' : 'Pending Approval' }}</p>
                </div>
            </div>

            <div class="mt-5">
                <button @click.prevent="updateVisitorInfo" type="button"
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
    </FormDialog>
    <FormDialog :isOpen="pop" :Title="'Health Declaration'">
        <template v-slot:body>
            <form>
                <p class="text-[10px] text-center">Are you currently experiencing or have experienced any of these symptoms
                    in
                    the last 24 hours?</p>

                <div class="space-y-2 my-5">

                    <div class="w-full flex h-[45px] gap-x-3 shadow-sm shadow-slate-400 p-2 rounded-md select-none"
                        v-for="symptom in symptoms" :key="symptom.id" @click="toggleCheckbox(symptom)">
                        <input v-model="symptom.state" type="checkbox" :id="symptom.id" v-bind:checked="symptom.state"
                            >
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
</template>

<script>
import axios from 'axios';
import Form from 'vform';
import FormDialog from '../../../Elements/Modals/FormDialog.vue';
import { userAuthStore } from "@/store/auth";
import { useStore } from '@/store/visitor';
import moment from 'moment';

const store = useStore();

export default {
    name: 'Check In Form',
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
        FormDialog,
        moment
    },
    data() {
        return {
            data: {},
            good: false,
            id: window.location.href.split('/').pop(),
            form: new Form({
                visitor_id: '',
                building_id: '',
                visit_purpose_id: '',
                log_type: ''
            }),
            buildings: {},
            visitor: {},
            visitType: [],
            user: [],
            purpose: [],
            hosts: [],
            checkedIDs: [],
            profile_url: '',
            front_url: '',
            back_url: '',
            selectedPurpose: '',
            enableButton: false,
            isFormComplete: false,
            show: false,
            pop: false,
            badHealth: false,
            goodHealth: false,
            permission: userAuthStore(),
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
        }
    },

    methods: {
        isChecked(event) {
            this.enableButton = !this.enableButton
        },

        isPop() {
            this.show = !this.show;
        },

        isOpen() {
            this.pop = !this.pop
        },
        uploadProfilePhoto() {
            this.hideLabel_profile = true;
            let input = this.$refs.profile;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.profile_url = e.target.result;
                    this.visitor.profile_photo = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        uploadFrontID() {
            this.hideLabel_front = true;
            let input = this.$refs.front;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.front_url = e.target.result;
                    this.visitor.front_id = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        uploadBackID() {
            this.hideLabel_back = true;
            let input = this.$refs.back;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.back_url = e.target.result;
                    this.visitor.back_id = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        checkInVisitor() {
            this.form.visitor_id = this.visitor.id
            this.form.building_id = this.visitor.building_id
            this.form.visit_purpose_id = this.selectedPurpose.value
            this.form.log_type = this.permission.authenticated ? 'Invitee' : 'Walk-In'

            this.form.post('/api/visitor-logs/')
                .then((data) => {
                    this.sendEmail();
                }).catch((e) => {
                    
                });
            },
            
            sendEmail() {
                axios.get('/api/send-email?id=' + store.hiddenID + '&buildingID=' + this.id)
                .then((data) => {
                    store.setHiddenParam(store.hiddenID);
                    this.$router.push('/visitor-registration/success/checkin/' + this.id);
                }).catch((error) => {

                })
        },

        updateVisitorInfo() {
            axios.put('/api/visitors/' + this.visitor.id, {
                params: {
                    data: this.visitor
                }
            }).then((data) => {
                this.show = !this.show
            }).catch((e) => {

            });
        },

        async getData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        },

        async syncData(id) {
            await axios.get('/api/sync-visitor?id=' + id)
                .then((data) => {
                    this.visitor = data.data.data;

                    if(this.visitor.profile_photo != null) {
                        this.profile_url = '/uploads/profiles-visitor/' + this.visitor.profile_photo
                    }
                    if (this.visitor.front_id != null) {
                        this.front_url = '/uploads/frontID/' + this.visitor.front_id
                    }
                    if (this.visitor.back_id != null) {
                        this.back_url = '/uploads/backID/' + this.visitor.back_id
                    }
                })
                .catch((e) => {
                });
        },

        async syncVisitType() {
            await axios.get('/api/get-visit-types/')
                .then((data) => {
                    this.visitType = data.data.data;
                })
                .catch((e) => {

                });
        },

        toggleCheckbox(symptom) {
            symptom.state = !symptom.state;
            this.saveToArray(symptom.id, symptom.state);
        },

        submitForm() {
            this.badHealth = true
            this.good = true;
            this.form = this.checkedIDs.join(" and ");
            console.log(this.form)
            this.isOpen();
        },

        saveToArray(id) {
            if (this.checkedIDs.includes(id)) {
                this.checkedIDs.pop(id);
            }
            else {
                this.checkedIDs.push(id)
            }

            console.log(this.checkedIDs);
        },

        isGood() {
            this.goodHealth = !this.goodHealth;
            this.badHealth = false
            this.good = true;
        },
        isBad() {
            this.goodHealth = false;
            this.good = false;
            this.pop = !this.pop;
        },
    },

    created() {
        this.syncData(store.hiddenID);
        this.getData();
        this.syncVisitType();
        this.moment = moment;
        if (store.hiddenID == null) {
            this.$router.back();
        }
    },
}
</script>