<template>
    <div>
        <button type="button" class="rounded-md bg-indigo-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline 
            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            {{ label }}
        </button>
    </div>
</template>

<script>
export default{
    name:'PrimaryButton',
    props: {
        label:{
            type: String,
            default: 'Button'
        }
    },

}
</script>