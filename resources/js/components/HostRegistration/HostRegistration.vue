<template>
    <div class="min-h-screen p-6 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <form @submit.prevent="submitForm()">
                <div class="bg-white rounded-md shadow-lg shadow-blue-200 p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <div class="building text-center">
                                <p class="text-lg font-semibold">User Registration</p>
                                <p class="font-medium text-lg text-blue-800">{{ this.buildings.buildingName }}</p>
                                <p class="text-[10px]">{{ this.buildings.address }}</p>
                            </div>

                            <div class="flex justify-center items-center flex-col lg:mt-16 my-4">
                                <div class="lg:w-40 w-28">
                                    <label for="profile"
                                        class="flex flex-col lg:w-40 w-28 lg:h-40 h-28 border-2 hover:bg-gray-200 opacity-60 rounded-full justify-center items-center cursor-pointer transition duration-500">
                                        <img class="lg:w-8 w-6 mt-3 lg:mt-0"
                                            src="https://www.svgrepo.com/show/33565/upload.svg" />
                                        <input id="profile" type="file"
                                            class="flex items-center h-5 border rounded px-4 w-full opacity-0">
                                    </label>
                                </div>
                                <p class="text-[10px]">Upload Photo</p>
                            </div>

                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5 relative">
                                    <label for="fname" class="text-xs">First Name</label>
                                    <input type="text" name="fname" id="fname" placeholder="Juan"
                                        :class="form.errors.has('first name') ? 'text-xs border border-red-700 bg-red-100/25 rounded px-4 mt-1 h-8 w-full' : 'h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50'"
                                        v-model="form.fname" />
                                    <p v-show="form.errors.has('fname')"
                                        class="text-[10px] items-center absolute w-max text-red-500">
                                        {{ form.errors.get('fname') }}</p>
                                </div>

                                <div class="md:col-span-5 mt-3">
                                    <label for="lname" class="text-xs">Last Name</label>
                                    <input type="text" name="lname" id="lname" placeholder="Dela Cruz"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="form.lname" />
                                </div>

                                <div class="md:col-span-3">
                                    <label for="email" class="text-xs">Email Address</label>
                                    <input type="text" name="email" id="email"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50 placeholder:text-xs"
                                        v-model="form.email" placeholder="example@domain.com" autocomplete="off" />
                                </div>

                                <div class="md:col-span-2 relative">
                                    <label for="password" class="text-xs">Password</label>
                                    <input :type="showPassword ? 'text' : 'password'" name="password" id="Password"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50 placeholder:text-xs"
                                        v-model="form.password" placeholder="password" autocomplete="off" />
                                    <button type="button" @click.prevent="showHide()" class="absolute right-2 top-[55%]">
                                        <svg v-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <svg v-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>


                                    </button>
                                </div>

                                <div class="md:col-span-3">
                                    <label for="location" class="text-xs">Unit Number / Location</label>
                                    <input type="text" name="location" id="location" placeholder="Enter Unit / Location"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="form.location" />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="contact" class="text-xs">Mobile Number</label>
                                    <input type="tel" name="contact" id="contact" placeholder="09*********"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="form.contact" />
                                </div>

                                <div class="md:col-span-3">
                                    <label for="gov_id" class="text-xs">Government - Issued Valid ID</label>
                                    <div
                                        class="valid_ids h-8 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                        <v-select v-model="form.gov_id" id="gov_id" :options="gov_id"
                                            :placeholder="'Valid ID'"
                                            class="text-[10px] rounded-[3px] pl-2 h-9 w-full"></v-select>
                                    </div>
                                </div>

                                <div class="md:col-span-1">
                                    <p class="text-xs">Front</p>
                                    <label for="frontId"
                                        class="mt-1 flex flex-col items-center justify-center w-full h-[73px] border border-gray-200 rounded-md cursor-pointer bg-gray-50 hover:bg-blue-100/90 bg-cover bg-no-repeat">
                                        <div class="flex flex-col items-center justify-center pt-6 pb-6">
                                            <img src="/Visitor_Homepage_Assets/frontID.png">
                                        </div>
                                        <input id="frontId" ref="front" type="file"
                                            class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50 opacity-0"
                                            @input="uploadImage" />
                                    </label>
                                </div>

                                <div class="md:col-span-1">
                                    <p class="text-xs">Back</p>
                                    <label for="backId"
                                        class="mt-1 flex flex-col items-center justify-center w-full h-[73px] border border-gray-200 rounded-md cursor-pointer bg-gray-50 hover:bg-blue-100/90 bg-cover bg-no-repeat">
                                        <div class="flex flex-col items-center justify-center pt-6 pb-6">
                                            <img src="/Visitor_Homepage_Assets/backID.png">
                                        </div>
                                        <input id="backId" ref="front" type="file"
                                            class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50 opacity-0"
                                            @input="uploadImage" />
                                    </label>
                                </div>


                                <div class="md:col-span-5 mt-3">
                                    <div class="inline-flex items-center">
                                        <input type="checkbox" name="policy" id="policy" class="form-checkbox" />
                                        <label for="policy" class="ml-2 text-xs">By supplying information in the homeowner
                                            registration, you agree with our privacy policy and terms
                                            and
                                            conditions.</label>
                                    </div>
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Submit
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';
import NormalInput from '../Elements/Inputs/NormalInput.vue';

export default {
    name: 'Visitor Prompt',
    props: {
        data: {
            type: Array,
            default: []
        },
    },

    components: {
        NormalInput
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
            showPassword: false,
            setShowPassword: false,
            profile: '',
            frontId: '',
            backId: '',
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
                fname: '',
                lname: '',
                email: '',
                password: '',
                location: '',
                contact: '',
                gov_id: '',
                policy: true,
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
                    // this.$router.push('/host-registration/success/' + this.id);
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },

        showHide() {
            this.showPassword = !this.showPassword
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