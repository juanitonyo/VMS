<template>
    <div class="sm:col-span-3">
        <div class="flex justify-between">
            <label :for="id" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
            <div class="text-[10px] text-red-600 dark:text-red-500 mt-1" v-show="hasError" v-html="errorMessage" />
        </div>
        <input :value="modelValue" @input="updateValue" type="text" :name="id" :id="id" autocomplete="given-name"
            :class="[hasError ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700' : 'focus:outline-none text-gray-900 placeholder:text-gray-400', 'block w-full px-3 rounded-md border border-gray-300 py-1 text-xs sm:leading-6']" />


    </div>
</template>

<script>

export default {
    name: 'normal-input',
    setup(props, context) {
        const updateValue = (event) => {
            context.emit('update:modelValue', event.target.value);
        }

        return { updateValue }
    },
    props: {
        label: {
            type: String,
            default: 'Label Text'
        },
        modelValue: {
            type: String,
            default: ''
        },
        id: {
            type: String,
            default: 'normal-input'
        },
        hasError: {
            type: Boolean,
            default: false
        },
        errorMessage: {
            type: String,
            default: ''
        },
        height: {
            type: String,
            default: ''
        },
    },
}

</script>