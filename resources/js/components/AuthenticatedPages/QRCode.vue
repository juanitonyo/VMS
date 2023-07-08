<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">QR CODE SUMMARY</h1>
                    <p class="mt-2 text-xs text-gray-700">A summary of QR codes of all the buildings</p>
                </div>

                <div class="relative">
                    <input v-model="this.search" @input="getData" type="text" name="search" class="py-2 border border-gray-500 rounded-md pl-2 text-xs w-80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="absolute w-4 h-4 top-2.5 right-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>

            <p class="mt-3 text-xs">Showing
                <select v-model="limitPage" @change="getData" name="length" class="text-center bg-white">
                    <option selected value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                Entries
            </p>

            <div class="flex flex-col">
                <div v-for="item in data.data" class="flex mt-3 gap-2">

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + this.url + '/host-registration/' + item.qr_id"
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Unit Owner</p>
                                <p class="font-semibold">{{ item.building_name }}</p>
                                <p class="text-[10px] font-extralight text-gray-400 w-80">{{ item.address }}</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">{{ item.description ?? '' }}
                                </p>
                                <a :href="this.url + '/homeowner-registration/' + item.qr_id" target="_blank"
                                    class="font-light text-xs mt-3 text-blue-500">> Proceed to host registration</a>
                            </div>
                        </div>
                    </div>

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + this.url + '/visitor-registration/' + item.qr_id"
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Visitor</p>
                                <p class="font-semibold">{{ item.building_name }}</p>
                                <p class="text-[10px] font-extralight text-gray-400 w-80">{{ item.address }}</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">{{ item.description ?? '' }}
                                </p>
                                <a :href="this.url + '/visitor-registration/' + item.qr_id" target="_blank"
                                    class="font-light text-xs mt-3 text-blue-500">> Proceed to visitor registration</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between mt-3">
                <p class="text-xs">Showing {{ [this.data.from ?? false ? this.data.from : '0'] + ' to ' + [this.data.to ?? false ? this.data.to : '0'] + ' of ' + [this.data.total ?? false ? this.data.total : '0'] }} entries.</p>
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { TailwindPagination } from 'laravel-vue-pagination';

export default {
    props: {
        data: {
            type: Object,
            default: {}
        }
    },

    components: {
        TailwindPagination
    },
    data() {
        return {
            data: {},
            url: '',
            search: '',
            limitPage: 10
        }
    },
    methods: {
        async getData(page = 1) {
            await axios.get('/api/building?page=' + page + '&search=' + this.search + '&limit=' + this.limitPage).then((data) => {
                this.data = data.data.data
                console.log(this.data)
            }).catch((error) => {

            })
        },
    },
    created() {
        // this.getVisitorData();
        this.getData();
        this.url = new URL(window.location.href).origin
    }
}

</script>