<template>
    <div class="min-h-full font-poppins">
        <router-view :key="$route.fullPath"></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
export default {
    name: 'Guest',
}
</script>