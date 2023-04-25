<template>
    <div class="font-poppins min-h-full">

        <router-view :key="$route.fullPath"></router-view>
        <vue-progress-bar></vue-progress-bar>

    </div>
</template>

<script>

</script>