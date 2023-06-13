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

                <div class="flex flex-row mt-4 gap-x-5">
                    <img :src="'/uploads/profiles-visitor/' +  this.visitor.profilePhoto" alt="Photo not available"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200 text-[10px] text-center">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, {{ this.visitor.name
                        }}</p>
                        <p class="text-[9px] text-blue-800 font-light">Visit: Walk - In</p>
                        <p class="text-[9px] text-blue-800 font-light">Status: {{ this.visitor.status ? 'Approved' : 'Pending Approval' }}</p>
                    </div>
                </div>
                <div>
                    <div class="space-y-3 ">
                        <div class="flex flex-col mt-8 gap-y-3">

                            <div class="flex flex-row items-center justify-between">
                                <label for="visitType" class="text-[10px] text-gray-500">Visit Type</label>
                                <input v-model="visitType" type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="companions" class="text-[10px] text-gray-500">Companion(s)</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                        </div>
                    </div>

                    <p class="text-sm text-blue-900 font-semibold leading-[20px] mt-5">Person To Visit</p>

                    <div class="space-y-3">
                        <div class="flex flex-col mt-8 gap-y-3">

                            <div class="flex flex-row items-center justify-between">
                                <label for="propertyAddress" class="text-[10px] text-gray-500 mr-5">Property Address</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="principalOwner" class="text-[10px] text-gray-500 mr-5">Principal Owner</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>


                            <div class="flex flex-row items-center justify-between">
                                <label for="contact" class="text-[10px] text-gray-500 mr-5">Mobile Number</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="host" class="text-[10px] text-gray-500 mr-5">Host Name</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="hostContact" class="text-[10px] text-gray-500 mr-5">Host Mobile Number</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                        </div>
                    </div>

                    <div class="mt-8">
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
                </div>

                <div class="flex flex-col mt-10 justify-center gap-y-2 mb-8">
                    <button @click.prevent="checkOutVisitor()" :disabled="!this.visitor.status"
                        :class="[this.visitor.status ? 'bg-[#890707] hover:bg-[#750505] cursor-pointer' : 'bg-[#B3B3B3] hover:bg-[#B3B3B3]/75', 'w-[330px] h-[33px] rounded-md  text-white text-xs flex items-center justify-center']">{{
                            this.status ? 'Checkout' : 'Close' }}
                    </button>
                </div>

            </div>

        </div>
    </div>

    <FormDialog :isOpen="show" :Title="'My Account'">
        <template v-slot:body>

            <div class="flex justify-center items-center w-full ">
                <div class="w-[80px] flex flex-col gap-y-1">
                    <label :style="{ 'background-image': `url(${profile_url})` }"
                        class="flex flex-col items-center justify-center w-full h-[80px] border-2 border-blue-700 rounded-full cursor-pointer hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-7 pb-6" :class="{ 'hidden': hideLabel_profile }">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input ref="profile" type="file" class="opacity-0 w-full h-full cursor-pointer" accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadProfile" />
                    </label>
                    <p class="text-[10px] text-gray-400 flex justify-center">Replace Photo</p>
                </div>
            </div>

            <div class="flex flex-col mt-8 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                    <input v-model="visitor.name" type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="email" class="text-[10px] text-gray-500 mr-6">Email Address</label>
                    <input v-model="visitor.email" type="email" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="contact" class="text-[10px] text-gray-500 mr-4">Mobile Number</label>
                    <input v-model="visitor.contact" type="tel" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="id" class="text-[10px] text-gray-500 mr-14">Valid ID</label>
                    <input v-model="visitor.validId" type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>
            </div>

            <div class="mt-5 flex flex-row justify-end mr-3">
                <div class="flex flex-row items-center">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                    <label :style="{ 'background-image': `url(${front_url})` }"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="{ 'hidden': hideLabel_front }">
                            <img src="/Visitor_Homepage_Assets/frontID.png" alt="">
                        </div>
                        <input ref="front" type="file" class="opacity-0 w-full h-full cursor-pointer" accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadFront" />
                    </label>
                </div>

                <div class="flex flex-row items-center ml-2">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                    <label :style="{ 'background-image': `url(${back_url})` }"
                        class="flex flex-col items-center justify-center w-[65px] h-[53px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" :class="{ 'hidden': hideLabel_back }">
                            <img src="/Visitor_Homepage_Assets/backID.png" alt="">
                        </div>
                        <input ref="back" type="file" class="opacity-0 w-full h-full cursor-pointer" accept="image/png, image/jpeg, image/jpg, image/svg" @change="uploadBack" />
                    </label>
                </div>
            </div>
            <p class="text-blue-800 text-base font-semibold mt-5">Last Activity</p>

            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-left">
                    <label for="fullname" class="text-[10px] text-gray-500 ml-3">Type</label>
                    <p class="text-[10px] ml-[69px]">{{ this.permission != null ? 'Invitee' : 'Walk-In' }}</p>
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row justify-left items-center">
                    <label for="email" class="text-[10px] text-gray-500 ml-3">Check In</label>
                    <p class="text-[10px] ml-[50px]">{{ this.visitor.latest_log == null ? 'N/A' : moment(this.visitor.latest_log.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row justify-left items-center">
                    <label for="contact" class="text-[10px] text-gray-500 ml-3">Approved</label>
                    <p class="text-[10px] ml-[45px]">{{ this.visitor.status ? 'Approved' : 'Pending Approval' }}</p>
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
    </FormDialog>
</template>

<script>
import axios from 'axios';
import FormDialog from '../../../Elements/Modals/FormDialog.vue';
import moment from 'moment';
import { useStore } from '../../../../store/visitor';

const store = useStore();

export default{
    name: 'Check Out Form',
    props: {
        data: {
            type: Array,
            default: []
        },
    },
    components: {
        FormDialog,
        moment
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            visitor: {},
            purpose: [],
            hideLabel_profile: false,
            hideLabel_front: false,
            hideLabel_back: false,
            profile_url: '',
            front_url: '',
            back_url: '',
            enableButton: false,
            status: true,
            show: false
        }
    },
    methods: {
        isPop() {
            this.show = !this.show;
        },

        showSuccess() {
            
        },

        checkOutVisitor() {
            axios.put("/api/visitor-logs/" + this.visitor.id)
                .then((data) => {
                    this.$router.push('/visitor-registration/success/checkout/' + this.id);
                }).catch((e) => {

                });
        },

        async getBuildingData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        },
        
        async syncData() {
            await axios.get('/api/sync-visitor?id=' + store.hiddenID)
                .then((data) => {
                    this.visitor = data.data.data;

                    this.profile_url = '/uploads/profiles-visitor/' + this.visitor.profilePhoto
                    this.hideLabel_profile = true;
                    this.front_url = '/uploads/frontID/' + this.visitor.front_id
                    this.hideLabel_front = true;
                    this.back_url = '/uploads/backID/' + this.visitor.back_id
                    this.hideLabel_back = true
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
        },

        async checkLog() {
            await axios.get('/api/check-log/')
                .then((data) => {
                    this.log = data.data.data;
                    this.visitType = this.log.visit_type.name
                }).catch((e) => {

                });
        },
    },
    created() {
        this.getBuildingData();
        this.syncData();
        this.checkLog();
        this.moment = moment;
    },
}
</script>