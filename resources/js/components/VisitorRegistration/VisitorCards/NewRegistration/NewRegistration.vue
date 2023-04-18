<template>
    <div class="flex flex-col items-center justify-center">

        <div class="flex flex-col gap-y-2 items-center justify-center absolute top-10 lg:top-20">
            <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
            <h4 class="text-gray-400 text-[9px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
            <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>
        </div>

        <div class="flex flex-col items-center justify-center w-[100px] absolute top-48">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-[100px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                </div>
                <input id="dropzone-file" type="file" class="hidden" />
            </label>
            <p class="text-[10px] text-gray-400 mt-1">Upload Photo</p>

            <form action="">

                <div class="flex items-center mt-8">
                    <label for="fullname" class="text-[10px] text-gray-500 mr-16">Name</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>

                <div class="flex items-center mt-3">
                    <label for="email" class="text-[10px] text-gray-500 mr-3.5 w-20">Email Address</label>
                    <input type="email" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>

                <div class="flex items-center mt-3">
                    <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Mobile Number</label>
                    <input type="text" class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[230px]">
                </div>

                <div class="flex items-center mt-3 gov-ids">
                    <label for="contact" class="text-[10px] text-gray-500 mr-3.5 w-20">Valid ID</label>
                    <!-- <input type="text"
                        class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[23px] w-[196px]"> -->
                    <v-select id="dropdown" :options="valid_id" label="label"
                        class="text-[10px] border border-blue-700 rounded-[3px] h-[28px] w-[230px]"></v-select>
                </div>

                <div class="mt-5 flex flex-row justify-end">
                    <div class="flex flex-row items-center flex-start">
                        <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Front</p>
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-[62px] h-[51px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>

                    <div class="flex flex-row items-center ml-2">
                        <p class="w-10 text-[10px] text-gray-500 mr-2">Upload Back</p>
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-[62px] h-[51px] border-2 border-blue-700 rounded-md cursor-pointer bg-white hover:bg-blue-100/90">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                </div>

                <div class="flex flex-row mt-10 justify-center gap-x-8">
                    <a :href="'/visitor-registration/details/' + this.id" class="w-[145px] h-[33px] rounded-md bg-[#B3B3B3] text-white text-xs flex items-center justify-center cursor-pointer">Close</a>
                    <a :href="'/visitor-registration/policy/' + this.id" class="w-[145px] h-[33px] rounded-md bg-blue-700 text-white text-xs flex items-center justify-center cursor-pointer">Next</a>
                </div>
            </form>
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
            form: new Form({
                id: '',
                refId: window.location.href.split('/').pop(),
                email: '',
                fname: '',
                lname: '',
                contact: '',
                validId: ''
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
        saveLog() {
            this.$Progress.start();
            this.form.post('/api/visitors')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.form = new Form({
                        id: '',
                        email: '',
                        fname: '',
                        lname: '',
                        contact: '',
                        validId: ''
                    }),
                    this.open = !this.open;
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
        },
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