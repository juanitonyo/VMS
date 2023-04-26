<template>
    <div class="min-h-screen p-6 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <form>
                <div class="bg-white rounded-md shadow-lg shadow-blue-200 p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <div class="building text-center">
                                <p class="text-lg font-semibold">User Registration</p>
                                <p class="font-medium text-lg text-blue-800">{{ this.buildings.buildingName }}</p>
                                <p class="text-[10px]">{{ this.buildings.address }}</p>
                            </div>

                            <div class="flex justify-center lg:mt-16">
                                <div class="lg:w-40 w-28">
                                    <label for="profile"
                                        class="flex flex-col lg:w-40 w-28 lg:h-40 h-28 border-2 hover:bg-gray-200 opacity-60 rounded-full justify-center items-center cursor-pointer transition duration-500">
                                        <img class="lg:w-8 w-6 mt-3 lg:mt-0" src="https://www.svgrepo.com/show/33565/upload.svg" />
                                        <input id="profile" type="file"
                                            class="flex items-center h-5 border rounded px-4 w-full opacity-0">
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="fname" class="text-xs">First Name</label>
                                    <input type="text" name="fname" id="fname"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                </div>

                                <div class="md:col-span-5">
                                    <label for="lname" class="text-xs">Last Name</label>
                                    <input type="text" name="lname" id="lname"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                </div>

                                <div class="md:col-span-5">
                                    <label for="email" class="text-xs">Email Address</label>
                                    <input type="text" name="email" id="email"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50 placeholder:text-xs"
                                        value="" placeholder="example@domain.com" />
                                </div>

                                <div class="md:col-span-3">
                                    <label for="location" class="text-xs">Unit Number / Location</label>
                                    <input type="text" name="location" id="location"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="contact" class="text-xs">Mobile Number</label>
                                    <input type="tel" name="contact" id="contact"
                                        class="h-8 text-xs border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                </div>

                                <div class="md:col-span-3">
                                    <label for="gov_id" class="text-xs">Government - Issued Valid ID</label>
                                    <div
                                        class="valid_ids h-8 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                        <v-select :options="valid_id" :placeholder="'Valid ID'"
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
                                        <label for="policy" class="ml-2 text-xs">You agree with our privacy policy and terms
                                            and
                                            conditions.</label>
                                    </div>
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
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

export default {
    name: 'Visitor Prompt',
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