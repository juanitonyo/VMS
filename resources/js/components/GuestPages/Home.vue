<template>
    <div>
        <div class="bg-white py-24 px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Homepage</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
                <router-link to="/app/dashboard">GO TO DASHBOARD</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name:'Homepage',
        mounted() {
            console.log("Homepage");
        },
    }

</script>