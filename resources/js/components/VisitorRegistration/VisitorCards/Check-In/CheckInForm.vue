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
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <div class="flex flex-row mt-4 gap-x-5">
                    <img src="https://picsum.photos/400/400"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, {{ this.visitor.name
                        }}</p>
                        <p class="text-[9px] text-blue-800 font-light">Visit: Walk - In</p>
                        <p class="text-[9px] text-blue-800 font-light">Status: {{ this.visitor.status ? 'Approved' :
                            'Pending Approval' }}</p>
                    </div>
                </div>

                <form @submit.prevent="showSuccess()">
                    <div class="check_purpose space-y-3 mt-5">
                        <v-select v-model="selectedPurpose" id="dropdown" :placeholder="'What is the purpose of your visit? Tap here to select'"
                            :options="visitType" label="label"
                            class="text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-80"></v-select>
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
                            <v-select :options="user" label="label" :placeholder="'Who will you visit? Enter the host’s name here'"
                                class="text-[10px] border border-blue-700 rounded-[3px] h-7 w-full"></v-select>
                        </label>
                        <label for="visitContact" class="text-gray-400 text-[10px]">
                            <input type="text" placeholder="Enter the host’s mobile number. Example : 09191234567"
                                class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-80">
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
                        <button @click.prevent="checkInVisitor()" :disabled="!enableButton"
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
                    <input type="email" class="text-[10px] border border-blue-700 rounded-[3px]  h-[28px] w-[230px]">
                </div>
            </div>
            <div class="flex flex-col mt-3 relative">
                <div class="flex flex-row items-center justify-center">
                    <label for="contact" class="text-[10px] text-gray-500 mr-[45px]">Approved</label>
                    <input type="tel" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
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
import Form from 'vform';
import Account from '../../../Elements/Modals/MyAccount.vue';

export default {
    name: 'Check In Form',
    props: {
        data: {
            type: Array,
            default: []
        },
    },
    components: {
        Account
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
            visitor: {},
            visitType: [],
            user: [],
            purpose: [],
            hosts: [],
            selectedPurpose: '',
            enableButton: false,
            isFormComplete: false,
            status: 'Pending Approval',
            show: false,
        }
    },

    methods: {
        isChecked(event) {
            this.enableButton = !this.enableButton
        },

        isPop() {
            this.show = !this.show;
        },

        showSuccess() {
            // validate form
            this.form.post('/api/visitor-logs/')
                .then((data) => {
                    this.isFormComplete = true
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },

        checkInVisitor() {
            console.log(this.selectedPurpose);
            axios.post('/api/visitor-logs?visitor_id=' + this.visitor.id + '&building_id=' + this.visitor.building_ID + '&visitPurpose_id=' + this.selectedPurpose.value)
                .then((data) => {
                    this.$router.push('/visitor-registration/success/checkin/' + this.id);
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

        async syncData() {
            await axios.get('/api/sync-visitor/')
                .then((data) => {
                    this.visitor = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
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

        // async syncHosts() {
        //     await axios.get('/api/get-hosts')
        //         .then((data) => {
        //             this.hosts = data.data.data;
        //         })
        //         .catch((e) => {

        //         });
        // }
    },

    created() {
        this.syncData();
        this.getData();
        this.syncVisitType();
        // this.syncHost();
    },
}
</script>