<template>
    <div class="w-20 h-20 bg-blue-300" @click.prevent="isOpen()"></div>
    <div class="relative w-80" @click.prevent="isOpen()">
        <div :class="[open ? 'translate-x-full left-80 ': '-translate-x-full left-0', 'absolute left-0 w-80 h-screen bg-gray-100 transition-all']">
            <p class="text-black">test</p>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            open: false
        }
    },

    methods: {
        isOpen() {
            this.open = !this.open;
        }
    }
}
</script>