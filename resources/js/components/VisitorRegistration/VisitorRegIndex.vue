<template>
    <div class="lg:-mt-14 flex flex-col justify-center min-h-screen">

        <div class="flex flex-col gap-y-2 items-center justify-center mb-5">
            <h2 class="text-2xl lg:text-5xl font-semibold">{{ this.buildings.buildingName }}</h2>
            <h4 class="text-gray-500 text-base">{{ this.buildings.address }}</h4>
        </div>

        <div class='flex flex-col lg:flex-row lg:mx-10 items-center justify-center gap-y-2 lg:gap-x-2'>

            <a href="#"
                class="relative flex overflow-hidden rounded-lg border border-gray-100 w-80 h-44 p-4 shadow ring-black ring-opacity-5 justify-start hover:bg-black hover:bg-opacity-5">
                <span
                    class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-green-500 to-green-600"></span>

                <div class="flex flex-col justify-center">

                    <div class="hidden sm:block sm:shrink-0">
                        <img alt="No Icon" src="https://icon-library.com/images/registration-icon-png/registration-icon-png-13.jpg"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">New Registration</h3>
                    <p class="max-w-[40ch] text-xs text-gray-500">
                        Fill out Visitor Management Form
                    </p>
                </div>
            </a>

            <a href="#"
                class="relative flex overflow-hidden rounded-lg border border-gray-100 w-80 h-44 p-4 shadow ring-black ring-opacity-5 justify-start hover:bg-black hover:bg-opacity-5">
                <span
                    class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-blue-300 via-blue-500 to-blue-600"></span>

                <div class="flex flex-col justify-center">

                    <div class="hidden sm:block sm:shrink-0">
                        <img alt="No Icon" src="https://static.thenounproject.com/png/4713553-200.png"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">Returning Guest</h3>
                    <p class="max-w-[40ch] text-xs text-gray-500">
                        Fill out Visitor Management Form
                    </p>
                </div>
            </a>

            <a href="#"
                class="relative flex overflow-hidden rounded-lg border border-gray-100 w-80 h-44 p-4 shadow ring-black ring-opacity-5 justify-start hover:bg-black hover:bg-opacity-5">
                <span
                    class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-purple-300 via-purple-500 to-purple-600"></span>

                <div class="flex flex-col justify-center">

                    <div class="hidden sm:block sm:shrink-0">
                        <img alt="No Icon" src="https://pixlok.com/wp-content/uploads/2022/02/Exit-Icon-SVG-0987678.png"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">Guest Checkout</h3>
                    <p class="max-w-[40ch] text-xs text-gray-500">
                        Self - Checkout
                    </p>
                </div>
            </a>

            <a href="#"
                class="relative flex overflow-hidden rounded-lg border border-gray-100 w-80 h-44 p-4 shadow ring-black ring-opacity-5 justify-start hover:bg-black hover:bg-opacity-5">
                <span
                    class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-600"></span>

                <div class="flex flex-col justify-center">

                    <div class="hidden sm:block sm:shrink-0">
                        <img alt="No Icon" src="https://icons.veryicon.com/png/o/miscellaneous/zr_icon/invitation-card.png"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">With Invitation</h3>
                    <p class="max-w-[40ch] text-xs text-gray-500">
                        Enter Reference Code / Scan QR Code
                    </p>
                </div>
            </a>

            <a href="#"
                class="relative mb-10 lg:mb-0 flex overflow-hidden rounded-lg border border-gray-100 w-80 h-44 p-4 shadow ring-black ring-opacity-5 justify-start hover:bg-black hover:bg-opacity-5">
                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-red-300 via-red-500 to-red-600"></span>

                <div class="flex flex-col justify-center">

                    <div class="hidden sm:block sm:shrink-0">
                        <img alt="No Icon" src="https://cdn-icons-png.flaticon.com/512/1179/1179540.png"
                            class="h-16 w-16 rounded-lg object-cover shadow-sm" />
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">Delivery Service</h3>
                    <p class="max-w-[40ch] text-xs text-gray-500">
                        Fill out Delivery Registration Form
                    </p>
                </div>
            </a>

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