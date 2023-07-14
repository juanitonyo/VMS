<template>
    <div class="flex justify-center items-center min-h-screen min-w-screen sm:bg-background sm:bg-cover sm:bg-center">
        <div v-show="!isFormComplete" class="flex flex-col items-center justify-evenly sm:shadow-lg shadow-none sm:px-5 px-0 sm:py-10 py-0 sm:rounded-lg rounded-none bg-white">

            <div class="flex flex-col items-center justify-between mt-3 w-80 gap-y-2">
                <div class="flex flex-col gap-y-1 items-center justify-between">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.building_name }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center mb-4">{{ this.buildings.address }}</h4>
                    <p class="text-xl font-bold tracking-normal text-blue-700 ">User Registration</p>
                </div>

                <div class="flex flex-col items-center justify-center w-[100px]">
                    <label :style="{ 'background-image': `url(${profile_url})` }"
                        class="flex flex-col items-center justify-center w-full h-[100px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-50/90 bg-center bg-cover bg-no-repeat">
                        <div v-show="form.profile_photo == null ? true : false"
                            class="flex flex-col items-center justify-center pt-10 pb-6">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input type="file" ref="profile" class="opacity-0 w-px" @input="uploadProfilePhoto"
                            accept="image/png, image/jpeg, image/jpg, image/svg" />
                    </label>
                    <p class="text-[10px] text-gray-400 mt-1">Upload Photo</p>
                </div>
            </div>

            <div class="flex flex-col gap-3 mt-6">
                
                <div class="relative flex flex-col mb-2">
                    <div class="flex flex-row items-center ">
                        <label for="fullname" class="text-[10px] text-gray-500 mr-[41px]">First Name</label>
                        <div class="flex flex-col">
                            <input v-model="form.fname" type="text" placeholder="Juan"
                                class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col mb-2">
                    <div class="flex flex-row items-center ">
                        <label for="fullname" class="text-[10px] text-gray-500 mr-[41px]">Last Name</label>
                        <div class="flex flex-col">
                            <input v-model="form.fname" type="text" placeholder="Dela Cruz"
                                class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col mb-2">
                    <div class="flex flex-row items-center">
                        <label for="email" class="text-[10px] text-gray-500 mr-3.5 w-20">Email Address</label>
                        <div class="flex flex-col">
                            <input v-model="form.email" type="email" :disabled="isGoogleExist"
                                placeholder="example@email.com"
                                class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col mb-2">
                    <div class="flex flex-row items-center">
                        <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Mobile Number</label>
                        <div class="flex flex-col">
                            <input v-model="form.contact" type="text" placeholder="09*********" maxlength="11"
                                class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[210px]">
                        </div>
                    </div>
                </div>

                <div class="relative flex flex-col mb-2">
                    <div class="gov-ids flex flex-row items-center">
                        <label for="valid_id" class="text-[10px] text-gray-500 mr-3.5 w-20">Valid ID</label>
                        <div class="flex flex-col">
                            <v-select v-model="form.valid_id" id="dropdown" :options="valid_id" label="label"
                                :placeholder="'Valid ID'"
                                class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-[210px]"></v-select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 w-full justify-end mr-4 mt-3">
                <div class="flex items-center">
                    <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                    <label for="front-id" :style="{ 'background-image': `url(${front_url})` }"
                        class="flex flex-col items-center justify-center w-[70px] h-[55px] border-2 border-blue-700 rounded-md bg-white hover:bg-blue-100/90 bg-center bg-cover bg-no-repeat">
                        <div v-show="form.front_id == null ? true : false"
                            class="flex flex-col items-center justify-center pt-5 pb-6">
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
                        <div v-show="form.back_id == null ? true : false"
                            class="flex flex-col items-center justify-center pt-5 pb-6">
                            <img src="/Visitor_Homepage_Assets/backID.png" alt="">
                        </div>
                        <input id="back-id" ref="back" type="file" class="opacity-0 w-full h-full cursor-pointer"
                            accept="image/png, image/jpeg, image/jpg, image/svg" @change="uploadBackID" />
                    </label>
                </div>
            </div>

            <div class="relative flex flex-col mt-5 gap-1">
                <div class="flex items-center justify-between w-[305px]">
                    <label for="contact" class="text-[10px] text-gray-500">Do you have a proptech account
                        number?</label>
                    <div class="flex items-center text-[10px] gap-1">
                        <label for="yes">Yes</label>
                        <input type="radio" name="choice" id="yes" value="yes" @click="showInput = true">

                        <label for="no">No</label>
                        <input type="radio" name="choice" id="no" value="no" @click="showInput = false">
                    </div>
                </div>
                <div class="flex flex-col">
                    <input type="text" placeholder="Enter Account Number" 
                        class="focus:outline-none text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[305px]"
                        v-if="showInput">
                </div>
            </div>

            <div class="flex mb-6 mt-4 justify-between gap-x-2 w-full">
                <a
                    class="w-full h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">
                    Close</a>
                <button
                    class="w-full h-[33px] rounded-md bg-blue-700 text-white text-xs flex items-center justify-center cursor-pointer">
                    Next</button>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

export default {
    name: 'Host Registration',
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
            showPassword: false,
            checkPolicy: false,
            isFormComplete: false,
            profile_url: '',
            hideLabel_profile: false,
            frontId: '',
            backId: '',
            showInput: false,
            gov_id: [
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
            form: new Form({
                lname: '',
                fname: '',
                email: '',
                password: '',
                contact: null,
                front_id: null,
                back_id: null,
                gov_id: null,
                profile_photo: null,
                policy: true,
                account_number: '',
                role: 'host'
            }),
        }
    },

    methods: {
        submitForm() {
            this.$Progress.start();
            this.form.post('/api/hostreg')
                .then((data) => {
                    this.$Progress.finish();
                    this.$router.push('/homeowner-registration/success/' + this.id);
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },

        noAccountNumber() {
            this.isProptech = !this.isProptech;
        },

        showHide() {
            this.showPassword = !this.showPassword
        },
        isChecked() {
            this.checkPolicy = !this.checkPolicy
        },
        checkForm() {
            this.isFormComplete = !this.isFormComplete
        },

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

        document.cookie = 'buildingUUID=' + this.id + '; path=/';
    },
}
</script>