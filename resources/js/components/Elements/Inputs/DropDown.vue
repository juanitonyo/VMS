<template>
    <div class="sm:col-span-3">
        <label :for="id" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <div class="mt-2">
            <select :value="modelValue" @change="updateValue" :name="id" :id="id" :class="[hasError ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : 'focus:ring-2 focus:ring-inset bg-white focus:ring-cyan-600 text-gray-900 ring-gray-300 placeholder:text-gray-400', 'block w-full h-9 px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-800 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm sm:leading-6']">
                <option value="" disabled selected>Choose a Purpose</option>
                <option value="register">register</option>
                <option value="reset-password">reset-password</option>
            </select>
        </div>
        <div class="text-xs text-red-600 dark:text-red-500" v-show="hasError" v-html="errorMessage" />
    </div>
</template>

<script>
export default{
    name:'drop-down',
    setup(props, context) {
        const updateValue = (event) => {
            context.emit('update:modelValue', event.target.value);
        }

        return { updateValue }
    },
    props:{
        label:{
            type: String,
            default: 'Label Text'
        },
        modelValue:{
            type: String,
            default: ''
        },
        id: {
            type: String,
            default: 'drop-down'
        },
        hasError:{
            type: Boolean,
            default: false
        },
        messageMessage:{
            type: String,
            default: ''
        },
        errorMessage:{
            type: String,
            default: ''
        },
        options: {
            type: Array,
        },
    },
}
</script>