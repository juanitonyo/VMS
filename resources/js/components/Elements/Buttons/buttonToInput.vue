<template>
    <div>

        <a :href="'/visitor-registration/create/' + this.id" v-if="isButton" @click="onClick" tag="button" class="text-blue-800 border border-blue-800 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 mt-2 w-[325px] cursor-pointer">{{ label }}</a>

        <div v-else class="relative">
            <input :value="value" @input="onInput" :placeholder="'Email Address / Reference Code '"
                :class="'placeholder:text-gray-400 text-black border border-blue-800 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-xs px-5 py-2.5 text-left inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 mt-2 w-[325px]'">
            <button class="absolute right-3.5 top-2 bottom-0 hover:scale-105">
                <img src="/Visitor_Homepage_Assets/qrButton.png" alt="No Photo" class="w-6 h-6">
            </button>
        </div>

    </div>
</template>

<script>

import axios from 'axios';
export default {
    name: 'buttonToInput',
    props: {
        isButton: {
            type: Boolean,
            default: true
        },
        label: {
            type: String,
            default: 'Create Account'
        },
        value: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
        }
    },
    methods: {
        onClick() {
            this.$emit('click')
        },
        onInput(event) {
            this.$emit('input', event.target.value)
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