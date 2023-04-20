<template>
    <div class="flex justify-center items-center">

        <div class="w-[420px] rounded-lg shadow-md shadow-slate-300 min-h-screen">
            <div class="flex flex-col items-center gap-y-5">
                <div class="flex justify-end items-center w-[360px] h-10 mt-8">
                    <button>
                        <img src="/Visitor_Homepage_Assets/hamburgerMenu.png" alt="No Photo">
                    </button>
                </div>

                <div class="flex flex-col gap-y-2 items-center justify-center">
                    <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                    <h4 class="text-gray-400 text-[10px] text-center">{{ this.buildings.address }}</h4>
                </div>

                <p class="text-blue-800 text-lg font-semibold">Delivery</p>

                <div class="flex flex-col items-center justify-center w-[80px]">
                    <label for="dropzone-file" :style="{ 'background-image': `url(${profile_url})` }"
                        @click="$refs.profile.click()"
                        class="flex flex-col items-center justify-center w-full h-[80px] border-2 border-blue-700 rounded-full cursor-pointer bg-white hover:bg-blue-100/90 bg-cover bg-no-repeat">
                        <div class="flex flex-col items-center justify-center pt-7 pb-6" :class="{ 'hidden': hideLabel }">
                            <img src="/Visitor_Homepage_Assets/uploadphoto.png" alt="">
                        </div>
                        <input id="dropzone-file" ref="profile" type="file" class="opacity-0" @input="uploadImage" />
                    </label>
                </div>

                <form>

                    <div class="relative mt-5">
                        <input type="text" id="courierName"
                            class="block px-2 pb-1 pt-2 w-[320px] text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="courierName"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Company
                            /Business / Courier Name</label>
                    </div>

                    <div class="relative mt-5">
                        <input type="text" id="riderName"
                            class="block px-2 pb-1 pt-2 w-[320px] text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="riderName"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Rider
                            Name (optional)</label>
                    </div>

                    <div class="relative mt-5">
                        <input type="tel" id="contact"
                            class="block px-2 pb-1 pt-2 w-[320px] text-[11px] h-[32px] text-gray-900 bg-transparent rounded-md border border-blue-600 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="contact"
                            class="absolute cursor-text text-[10px] text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1">Mobile
                            Number</label>
                    </div>

                    <p class="text-xs text-blue-900 font-semibold leading-[20px] mt-3">Person To Visit</p>


                    <div class="flex flex-col justify-center items-center">

                        <div class="flex flex-row mt-2 gap-x-2" v-for="(input, k) in inputs.slice(0, 10)" :key="k">
                            <div class="buildingDropdown flex flex-col gap-y-1">
                                <v-select v-model="input.buildingName" id="dropdown" :options="purpose" label="label"
                                    placeholder="Building/Phase"
                                    class="text-[10px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[173px] "></v-select>
                            </div>

                            <div class="flex flex-col gap-y-1">
                                <input v-model="input.flrBlk" type="text" placeholder="Floor/Block"
                                    class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                            </div>

                            <div class="flex flex-col gap-y-1">
                                <input v-model="input.unitLot" type="text" placeholder="Unit/Lot"
                                    class="text-[9px] border border-blue-700 rounded-[3px] pl-2 h-[28px] w-[65px]">
                            </div>

                        </div>

                        <div class="flex flex-row justify-center items-center gap-3 mb-2">
                            <button :class="inputs.length == 1 ? 'bg-gray-500' : 'bg-red-500 text-white'"
                                :disabled="inputs.length == 1" class="text-xs text-white rounded-md h-[33px] w-[155px] mt-3"
                                @click="remove(k)">- Remove a
                                location</button>
                            <button :class="inputs.length == 10 ? 'bg-gray-500' : 'bg-blue-800 text-white'"
                                :disabled="inputs.length == 10"
                                class="text-xs text-white rounded-md h-[33px] w-[155px] mt-3" @click="add(k)">+ Add more
                                location</button>
                        </div>

                    </div>

                    <div>
                        <p class="text-xs text-blue-900 font-semibold leading-[20px] my-3">How are you feeling today?</p>

                        <div class="flex gap-x-3">

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300"
                                @click="isGood">
                                <img src="/Visitor_Homepage_Assets/happy.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I am prefectly fine</span>
                            </button>

                            <button
                                class="w-[156px] h-[85px] border border-black rounded-md flex flex-col justify-center items-center gap-y-2 hover:scale-105 ease-in-out duration-300">
                                <img src="/Visitor_Homepage_Assets/sad.png" class="w-[36px] h-[35px]">
                                <span class="text-[10px] text-gray-500">I feel not so good today</span>
                            </button>

                        </div>

                    </div>

                    <div v-show="goodHealth" class="relative flex flex-row items-center justify-center w-[320px] text-gray-600 font-extralight mt-5 gap-x-3">
                        <input type="checkbox" class="absolute top-1 left-0 w-5 h-5">
                        <span class=" ml-8 text-[11px] leading-4">I hereby affirm that I am in good physical condition and do
                            not suffer from any COVID-19 symptoms which would prevent on reporting physically in my office /
                            work station/ project site..
                        </span>
                    </div>

                    <div class="flex flex-row justify-center items-center gap-3 mb-5 mt-5">
                        <button class="text-xs text-white bg-gray-500 rounded-md h-[33px] w-[155px] mt-3">Close</button>
                        <button class="text-xs text-white bg-blue-700 rounded-md h-[33px] w-[155px] mt-3">Next</button>
                    </div>


                </form>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {

    name: 'Delivery Form',
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
            goodHealth: false,
            inputs: [
                {
                    buildingName: '',
                    flrBlk: '',
                    unitLot: ''
                }
            ]
        }
    },

    methods: {
        add(index) {
            this.inputs.push({ name: '' });
        },
        remove(index) {
            this.inputs.splice(index, 1);
        },
        isGood() {
            this.goodHealth = !this.goodHealth;
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