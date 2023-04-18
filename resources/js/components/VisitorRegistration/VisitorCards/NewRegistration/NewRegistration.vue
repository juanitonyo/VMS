<template>
    <div>
        <div v-show="!isFormComplete" class="flex flex-col items-center justify-center min-w-screen min-h-screen">

            <div class="flex flex-col gap-y-2 items-center justify-center absolute top-10 lg:top-16">
                <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                <h4 class="text-gray-400 text-[9px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
                <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>
            </div>

            <div class="flex flex-col items-center justify-center w-[100px] absolute top-48">
                <label for="dropzone-file" :style="{ 'background-image': `url(${image_url})` }"
                    @click="$refs.profile.click()"
                    class="flex flex-col items-center justify-center w-full h-[100px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                    <div class="flex flex-col items-center justify-center pt-10 pb-6" :class="{ 'hidden': hideLabel }">
                        <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                    </div>
                    <input id="dropzone-file" ref="profile" type="file" class="opacity-0" @input="uploadImage"/>
                </label>
                <p class="text-[10px] text-gray-400 mt-1">Upload Photo</p>

                <form action="">

                    <div class="flex items-center mt-8">
                        <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                        <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                    </div>

                    <div class="flex items-center mt-6">
                        <label for="email" class="text-[10px] text-gray-500 mr-3.5 w-20">Email Address</label>
                        <input type="email"
                            class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                    </div>

                    <div class="flex items-center mt-6">
                        <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Mobile Number</label>
                        <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                    </div>

                    <div class="flex items-center mt-6 gov-ids">
                        <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Valid ID</label>
                        <v-select id="dropdown" :options="valid_id" label="label"
                            class="text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-[230px]"></v-select>
                    </div>

                    <div class="mt-5 flex flex-row justify-end">
                        <div class="flex flex-row items-center flex-start">
                            <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                            <label for="dropzone-file" :style="{ 'background-image': `url(${image_url})` }"
                                @click="$refs.front.click()"
                                class="flex flex-col items-center justify-center w-[62px] h-[51px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                    :class="{ 'hidden': hideLabel }">
                                    <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                                </div>
                                <input id="dropzone-file" ref="front" type="file" class="opacity-0" @input="uploadImage" />
                            </label>
                        </div>

                        <div class="flex flex-row items-center ml-2">
                            <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                            <label for="dropzone-file" :style="{ 'background-image': `url(${image_url})` }"
                                @click="$refs.back.click()"
                                class="flex flex-col items-center justify-center w-[62px] h-[51px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                    :class="{ 'hidden': hideLabel }">
                                    <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                                </div>
                                <input id="dropzone-file" ref="back" type="file" class="opacity-0" @input="uploadImage" />
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-row mt-10 justify-center gap-x-8">
                        <a :href="'/visitor-registration/details/' + this.id"
                            class="w-[145px] h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Close</a>
                        <a @click="showPolicy" href="#"
                            class="w-[145px] h-[33px] rounded-md bg-blue-700 text-white text-xs flex items-center justify-center cursor-pointer">Next</a>
                    </div>
                </form>
            </div>
        </div>

        <div v-show="isFormComplete" class="flex flex-col items-center justify-center">
            <div class="flex flex-col gap-y-2 items-center justify-center absolute top-10 lg:top-16">
                <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                <h4 class="text-gray-400 text-[9px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
                <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>
                <form @submit.prevent="">
                    <div
                        class="relative flex flex-row items-center justify-center w-[340px] text-gray-600 font-extralight mt-10 gap-x-3">
                        <input v-model="form.policy" type="checkbox" class="absolute top-0 left-0 w-5 h-5"
                            @change="isChecked()">
                        <span class="ml-10 text-xs leading-5">By supplying the information on VMS registration form, I
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

                    <div class="flex flex-row mt-10 justify-center gap-x-8">
                        <router-link :to="'/visitor-registration/details/' + this.id"
                            class="w-[145px] h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Close</router-link>
                        <router-link :to="'/visitor-registration/success/' + this.id">
                            <button :disabled="!enableButton" :class="[enableButton ? 'bg-blue-700' : 'bg-gray-600']"
                                class="w-[145px] h-[33px] bg-blue-700 rounded-md  text-white text-xs flex items-center justify-center cursor-pointer">Submit</button>
                        </router-link>
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
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            image_url: '',
            buildings: {},
            isFormComplete: false,
            enableButton: false,
            hideLabel: false,
            form: new Form({
                name: '',
                email: '',
                contact: '',
                valid_id: '',
                front: '',
                back: '',
                profile: '',
                policy: false,
            }),
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
        uploadImage() {
            this.hideLabel = true
            let input = this.$refs.front;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image_url = e.target.result;
                    this.form.logo = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },
        showPolicy() {
            //validate form
            this.$Progress.start();
            this.form.post('/api/visitors/')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    createToast({
                        title: 'Success!',
                        description: 'Data has been saved.'
                    },
                        {
                            position: 'top-left',
                            showIcon: 'true',
                            type: 'success',
                            toastBackgroundColor: '#00bcd4',
                            hideProgressBar: 'true',
                            toastBackgroundColor: '#00bcd4',
                        })
                }).catch((error) => {
                    this.$Progress.fail();
                })

            this.isFormComplete = true
        },
        isChecked(event) {
            this.enableButton = !this.enableButton
        }
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

<!-- <div>
    <label for="valid_id"
        class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Valid ID</label>
    <div class="mt-2">
        <v-select id="dropdown" placeholder="Select" :options="valid_id" label="label"
            class="text-xs"></v-select>
    </div>
</div> -->