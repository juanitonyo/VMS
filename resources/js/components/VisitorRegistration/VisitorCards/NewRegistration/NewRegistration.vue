<template>
    <div class="min-w-full flex absolute sm:top-0 items-center justify-center overflow-hidden">
        <div
            class="relative overflow-hidden shadow-sm shadow-slate-400 w-[340px] sm:w-[600px] lg:w-[960px] h-[1080px] m-8 p-5 lg:p-10 rounded-md">
            <span class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-green-300 via-green-500 to-green-600"></span>
            <div class="text-center my-5">
                <p class=" text-2xl md:text-3xl font-semibold">Building Name</p>
                <p class="text-gray-600 text-[12px] md:text-sm p-1">Building Address</p>
                <p class="text-lg md:text-xl font-bold text-green-600">Visitor Registration</p>
            </div>

            <div class="my-14 md:my-12 md:mx-10">
                    <!-- <div class="mx-auto w-64 text-center ">
                        <div class="relative w-64">
                            <img class="w-64 h-64 rounded-full absolute"
                                src="https://images.pexels.com/photos/2690323/pexels-photo-2690323.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                alt="" />
                            <div
                                class="w-64 h-64 group hover:bg-gray-200 opacity-60 rounded-full absolute flex justify-center items-center cursor-pointer transition duration-500">
                                <img class="hidden group-hover:block w-12"
                                    src="https://www.svgrepo.com/show/33565/upload.svg" alt="" />
                            </div>
                        </div>
                    </div> -->
                    <form @submit.prevent="saveLog()">
                    <div class="flex justify-center">
                        <div>
                            <label
                                class="flex flex-col items-center justify-center w-20 h-20 md:w-36 md:h-36 rounded-full border-4 border-green-400 hover:bg-green-100 bg-cover bg-no-repeat">
                                <div class="flex flex-col justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-12 h-12 text-gray-600 group-hover:text-black" viewBox="0 0 16 12"
                                        fill="currentColor">
                                        <path
                                            d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z" />
                                        <path
                                            d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                                <input type="file" ref="buildingLogo" class="opacity-0" @input="uploadImage" />
                            </label>
                            <p class="text-xs md:text-base text-center my-3">Upload Photo</p>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs md:text-sm font-medium leading-6 text-gray-900">Email
                            address</label>
                        <div class="mt-2">
                            <input v-model="form.email" id="email" name="email" type="email" autocomplete="email"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="fname" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">First
                            Name</label>
                        <div class="mt-2">
                            <input v-model="form.fname" id="fname" name="fname" type="fname" autocomplete="fname"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="lname" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Last
                            Name</label>
                        <div class="mt-2">
                            <input v-model="form.lname" id="lname" name="lname" type="lname" autocomplete="lname"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="contact"
                            class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Contact Number</label>
                        <div class="mt-2">
                            <input v-model="form.contact" id="contact" name="contact" type="contact" autocomplete="contact"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="valid_id"
                            class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Valid ID</label>
                        <div class="mt-2">
                            <v-select v-model="form.validId" id="dropdown" placeholder="Select" :options="valid_id" label="label"
                                class="text-xs"></v-select>
                        </div>
                    </div>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Save</button>
                </form>
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