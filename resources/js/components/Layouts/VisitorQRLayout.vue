<template>
    <div class="font-poppins min-h-screen">
        <router-view :key="$route.fullPath"></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
export default {
    name: 'Visitor',
}
</script>