<template>
    <div class="flex flex-col items-center justify-center">

        <div class="flex flex-col gap-y-2 items-center justify-center absolute top-10 lg:top-16">
            <h2 class="text-lg font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
            <h4 class="text-gray-400 text-[9px] text-center px-20 pb-5 lg:px-56">{{ this.buildings.address }}</h4>
            <p class="text-xl font-bold tracking-normal text-blue-700 ">Visitor Registration</p>

            <div class="relative flex flex-row items-center justify-center w-[330px] text-xs text-gray-400 mt-10 gap-x-3">
                <input type="checkbox" class="absolute top-0 left-0 w-5 h-5">
                <span class="ml-10">By supplying the information on VMS registration form, I affirm that I have read, understood and
                    hereby
                    accept the terms of Globalland Property Management, Inc. (“Company”) <a href="" class="underline text-blue-700 font-semibold"> Web Application Privacy Policy</a>  and
                    I
                    hereby consent to the collection, use, storage, processing, retention and disclosure by the Company of
                    all
                    the personal information (hereafter, “Personal Information”) I may have provided herein.
                </span>
            </div>
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