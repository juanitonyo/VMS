<template>
    <div class="flex justify-center items-center">
        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div v-show="!isFormComplete" class="flex flex-col items-center gap-y-5 mx-[48px]">

                <div class="flex flex-col gap-y-2 items-center justify-center mt-10">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
                    <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>
                </div>

                <div class="flex flex-col items-center justify-center w-[100px]">
                    <label :style="{ 'background-image': `url(${profile_url})` }"
                        class="flex flex-col items-center justify-center w-full h-[100px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-center bg-cover bg-no-repeat">
                        <div v-show="form.profilePhoto == '' ? true : false"
                            class="flex flex-col items-center justify-center pt-10 pb-6"
                            :class="{ 'hidden': hideLabel_profile }">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input type="file" ref="profile" class="opacity-0 w-full" @input="uploadProfilePhoto"
                            accept="image/png, image/jpeg, image/jpg, image/svg" />
                    </label>
                    <p class="text-[10px] text-gray-400 mt-1">Upload Photo</p>
                </div>
                
                <div class="flex flex-col mt-3">
                    <div class="flex flex-row items-center ">
                        <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                        <input v-model="form.name" type="text" :disabled="isGoogleExist" placeholder="Juan Dela Cruz"
                            :class="form.errors.has('name') ? 'text-[10px] border border-red-700 bg-red-100/25 rounded-[3px] pl-2 h-[28px] w-[230px]' : 'focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]'">
                    </div>
                    <p v-show="form.errors.has('name')" class="text-[10px] items-center ml-24 w-max text-red-500 mb-0 ">{{
                        form.errors.get('name') }}</p>

                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row items-center">
                        <label for="email" class="text-[10px] text-gray-500 mr-3.5 w-20">Email Address</label>
                        <input v-model="form.email" type="email" :disabled="isGoogleExist" placeholder="example@email.com"
                            :class="form.errors.has('email') ? 'text-[10px] border border-red-700 bg-red-100/25 rounded-[3px] pl-2 h-[28px] w-[230px]' : 'focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]'">
                    </div>
                    <p v-show="form.errors.has('email')"
                        class="text-[10px] items-center bottom-[-15px] ml-24 w-max text-red-500">{{
                            form.errors.get('email') }}</p>
                </div>

                <div class="flex flex-col">
                    <div class="flex flex-row items-center">
                        <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Mobile Number</label>
                        <input v-model="form.contact" type="text" placeholder="09*********"
                            :class="form.errors.has('contact') ? 'text-[10px] border border-red-700 bg-red-100/25 rounded-[3px] pl-2 h-[28px] w-[230px]' : 'focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]'">
                    </div>
                    <p v-show="form.errors.has('contact')" class="text-[10px] items-center ml-24 w-max text-red-500">{{
                        form.errors.get('contact') }}</p>
                </div>

                <div class="flex flex-col">
                    <div class="gov-ids flex flex-row items-center">
                        <label for="valid_id" class="text-[10px] text-gray-500 mr-3.5 w-20">Valid ID</label>
                        <v-select v-model="form.validId" id="dropdown" :options="valid_id" label="label"
                            :placeholder="'Valid ID'"
                            :class="form.errors.has('validId') ? 'text-[10px] border border-red-700 bg-red-100/25 rounded-[3px] h-[28px] w-[230px]' : 'focus:outline-none text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-[230px]'"></v-select>
                    </div>
                    <p v-show="form.errors.has('validId')" class="text-[10px] items-center ml-24 w-max text-red-500">{{
                        form.errors.get('validId') }}</p>
                </div>

                
                <div class="flex gap-x-2 w-full justify-end">
                    <div class="flex items-center">
                        <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                        <label for="front-id" :style="{ 'background-image': `url(${front_url})` }"
                            class="flex flex-col items-center justify-center w-[70px] h-[55px] border-2 border-blue-700 rounded-md bg-white hover:bg-blue-100/90 bg-center bg-cover bg-no-repeat">
                            <div v-show="form.front_id == '' ? true : false"
                                class="flex flex-col items-center justify-center pt-5 pb-6"
                                :class="{ 'hidden': hideLabel_front }">
                                <img src="/Visitor_Homepage_Assets/frontID.png" alt="">
                            </div>
                            <input id="front-id" ref="front" type="file" class="opacity-0 w-full h-full cursor-pointer"
                                accept="image/png, image/jpeg, image/jpg, image/svg" @input="uploadFrontID" />
                        </label>
                    </div>

                    <div class="flex items-center">
                        <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                        <label for="back-id" :style="{ 'background-image': `url(${back_url})` }"
                            class="flex flex-col items-center justify-center w-[70px] h-[55px] border-2 border-blue-700 rounded-md bg-white hover:bg-blue-100/90 bg-center bg-cover bg-no-repeat">
                            <div v-show="form.back_id == '' ? true : false"
                                class="flex flex-col items-center justify-center pt-5 pb-6"
                                :class="{ 'hidden': hideLabel_back }">
                                <img src="/Visitor_Homepage_Assets/backID.png" alt="">
                            </div>
                            <input id="back-id" ref="back" type="file" class="opacity-0 w-full h-full cursor-pointer"
                                accept="image/png, image/jpeg, image/jpg, image/svg" @change="uploadBackID" />
                        </label>
                    </div>
                </div>

                <div class="flex mt-10 justify-between gap-x-2 w-full">
                    <a :href="'/visitor-registration/SignIn/reg/' + this.id"
                        class="w-full h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Close</a>
                    <button
                        @click="isGoogleExist ? this.isFormComplete = !this.isFormComplete : this.isFormComplete = !this.isFormComplete"
                        class="w-full h-[33px] rounded-md bg-blue-700 text-white text-xs flex items-center justify-center cursor-pointer">Next</button>
                </div>
            </div>

            <div v-show="isFormComplete" class="flex flex-col items-center justify-center">
                <div class="flex flex-col gap-y-2 items-center justify-center mt-10">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[9px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
                    <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>
                    <form @submit.prevent="submitForm()">
                        <div
                            class="relative flex flex-row items-center justify-center w-[340px] text-gray-600 font-extralight mt-10 gap-x-3">
                            <input v-model="form.policy" type="checkbox" class="absolute top-0 left-0 w-5 h-5"
                                @change="isChecked()">
                            <span class="ml-10 text-xs leading-5">By supplying the information on VMS registration form, I
                                affirm
                                that I have read,
                                understood and
                                hereby
                                accept the terms of Globalland Property Management, Inc. (“Company”) <a href="#"
                                    class="underline text-blue-700 font-semibold"> Web Application Privacy Policy</a> and
                                I
                                hereby consent to the collection, use, storage, processing, retention and disclosure by the
                                Company
                                of
                                all
                                the personal information (hereafter, “Personal Information”) I may have provided herein.
                            </span>
                        </div>

                        <div class="flex flex-row mt-10 justify-center gap-x-2">
                            <button @click="isFormComplete = false" type="button"
                                class="w-full h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Back</button>
                            <button type="submit" :disabled="!enableButton"
                                :class="[enableButton ? 'bg-blue-700' : 'bg-gray-600']"
                                class="w-full h-[33px] bg-blue-700 rounded-md  text-white text-xs flex items-center justify-center cursor-pointer">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

export default {
    name: "Visitor Registration Form",
    props: {
        data: {
            type: Array,
            default: {},
        },
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            form: new Form({
                building_ID: window.location.href.split('/').pop(),
                email: '',
                name: '',
                profilePhoto: '',
                front_id: '',
                back_id: '',
                contact: '',
                validId: '',
                policy: false
            }),
            email: '',
            buildings: {},
            account: {},
            profile_url: null,
            front_url: null,
            back_url: null,
            isFormComplete: false,
            enableButton: false,
            hideLabel_profile: false,
            hideLabel_front: false,
            hideLabel_back: false,
            isGoogleExist: false,

            valid_id: [
                "Digitalized BIR Taxpayer's ID",
                'Digitized Postal ID',
                'Diplomat ID',
                "Driver's License",
                'GSIS Card',
                'IBP ID',
                'OFW ID',
                'OWWA ID',
                'Passport',
                'PRC ID',
                "Senior Citizen's ID Card",
                'SSS Card',
                'UMID Card',
                "Voter's ID"
            ],
        }
    },
    methods: {

        uploadProfilePhoto() {
            this.hideLabel_profile = true;
            let input = this.$refs.profile;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.profile_url = e.target.result;
                    this.form.profilePhoto = e.target.result;
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
                    this.form.front_id = e.target.result;
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
                    this.form.back_id = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        submitForm() {
            this.$Progress.start();
            if (this.isGoogleExist) {
                axios.put('/api/visitors/' + this.account.id, {
                    params: {
                        data: this.form
                    }
                }).then((data) => {
                    this.$Progress.finish();
                    this.$router.push('/visitor-registration/success/' + this.id);
                }).catch((error) => {

                })
            }
            else {
                this.form.post('/api/visitors')
                    .then((data) => {
                        this.$Progress.finish();
                        this.$router.push('/visitor-registration/success/' + this.id);
                    }).catch((error) => {

                    })
            }
        },

        submitPolicy(email) {
            axios.get('/api/visitor-query/' + email + '/' + this.buildings.id)
                .then((data) => {
                    this.account = data.data.data;

                    if (this.account.policy == 1) {
                        this.$router.push('/visitor-registration/Signin/checkin/' + this.id);
                    }

                    else {
                        this.isFormComplete = !this.isFormComplete;
                    }

                })
                .catch((error) => {

                });
        },

        isChecked() {
            this.enableButton = !this.enableButton
        },

        async getData() {
            await axios.get('/api/visitor-registration?buildingUUID=' + this.id)
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((error) => {

                });
        },

        async syncData() {
            await axios.get('/api/sync-visitor/')
                .then((data) => {
                    this.account = data.data.data;

                    if (this.account.google_id != null) {
                        this.isGoogleExist = !this.isGoogleExist;
                        this.form.name = this.account.name;
                        this.form.email = this.account.email;
                    }

                })
                .catch((error) => {

                });
        }

    },
    created() {
        this.getData();
        this.syncData();
    },
}

</script>