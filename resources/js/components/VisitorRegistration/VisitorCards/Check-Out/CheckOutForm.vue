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
                    <img src="https://picsum.photos/400/400" alt="No Photo"
                        class="flex items-center justify-center w-20 h-20 rounded-full border border-slate-200">
                    <div class="flex flex-col justify-center pl-2 w-36">
                        <p class="text-[16px] text-blue-900 font-semibold leading-[20px]">Welcome back, {{ this.visitor.name
                        }}</p>
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
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                            <div class="flex flex-row items-center justify-between">
                                <label for="companions" class="text-[10px] text-gray-500">Companion(s)</label>
                                <input type="text" disabled
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                            </div>

                        </div>
                    </div>

                    <p class="text-[16px] text-blue-900 font-semibold leading-[20px] mt-5">Person To Visit</p>

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
                </div>

                <div class="flex flex-col mt-10 justify-center gap-y-2 mb-8">
                    <button @click.prevent="checkOutVisitor()"
                        :class="[this.status ? 'bg-[#890707] hover:bg-[#750505]' : 'bg-[#B3B3B3] hover:bg-[#B3B3B3]/75', 'w-[330px] h-[33px] rounded-md  text-white text-xs flex items-center justify-center cursor-pointer']">{{
                            this.status ? 'Checkout' : 'Close' }}
                    </button>
                </div>

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
import Account from '../../../Elements/Modals/MyAccount.vue';

export default{
    name: 'Check Out Form',
    props: {
        data: {
            type: Array,
            default: []
        },
    },
    components: {
        Account,
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            visitor: {},
            purpose: [],
            enableButton: false,
            status: true,
            show: false,
            pop: false,
        }
    },
    methods: {
        isPop() {
            this.show = !this.show;
        },

        showSuccess() {
            
        },

        checkOutVisitor() {
            axios.put("/api/visitor-logs/" + this.visitor.id, {
                params: {
                    data: this.visitor
                }
            }).then((data) => {
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
            await axios.get('/api/sync-visitor/')
                .then((data) => {
                    this.visitor = data.data.data;
                    console.log(this.visitor)
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                }); 
        },
    },
    created() {
        this.getBuildingData();
        this.syncData();
    },
}
</script>