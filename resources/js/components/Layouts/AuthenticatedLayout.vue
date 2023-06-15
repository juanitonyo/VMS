<template>
    <div class="min-h-full font-poppins" v-if="permissions">
        <!-- <MobileMenu/> -->
        <Sidebar/>
        <TopBar/>
        <div class="flex flex-1 flex-col lg:pl-64">
            <main class="flex-1 m-3">
                <router-view :key="$route.fullPath"></router-view>
                <vue-progress-bar></vue-progress-bar>
            </main>
        </div>
    </div>
</template>
<script setup>
    // import MobileMenu from '../Elements/Dashboard/MobileMenu.vue';
    import Sidebar from '../Elements/Dashboard/Sidebar.vue';
    import TopBar from '../Elements/Dashboard/TopBar.vue';
    import { userAuthStore } from "@/store/auth";
    import { useRouter, useRoute } from 'vue-router';  

    let permissions = userAuthStore().role.permissions;
    
    if(!permissions) {
        useRouter().push({
                name: 'login',
        });
    }
    

</script>