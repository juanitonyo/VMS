<template>
    <div class="min-w-full flex absolute top-40 sm:top-3 md:top-40 lg:top-12 items-center justify-center overflow-hidden">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 m-5 p-5 md:p-10">
            <h1 class="flex justify-center items-center text-xs md:text-base text-gray-600">You are about to enter ...</h1>

            <div class="flex flex-col items-center justify-center md:m-3">
                <p class="text-base md:text-3xl font-bold">BUILDING NAME HERE</p>
                <img src="https://picsum.photos/600/300?grayscale" alt="no logo/photo"
                    class="shadow ring-1 ring-black ring-opacity-5 m-3">
            </div>

            <div class="flex text-center justify-center items-center text-xs md:text-sm text-gray-600">
                <p>By clicking <strong class="text-black">proceed</strong>, you agree with our <a href="" class="text-cyan-500">privacy policy</a> and <a href="" class="text-cyan-500">terms and conditions</a>.</p>
            </div>

            <div class="buttons flex flex-col mt-5 text-center">
                <router-link to="/visitor-registration/index/"
                    class="bg-cyan-500 border rounded-md text-white text-sm md:text-base font-medium py-1 outline-none">Proceed</router-link>
                <router-link to="/app/buildings"
                    class="border border-cyan-500 rounded-md text-sm md:text-base font-medium py-1 mt-1.5 outline-none">Go
                    Back</router-link>
            </div>
        </div>
    </div>
</template>

<script>

export default{
    
}

</script>