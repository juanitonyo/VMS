<template>
    <div class="max-w-sc font-poppins">
        <router-view :key="$route.fullPath"></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>

</script>