<template>
    <div class="sm:col-span-3">
        <label :for="id" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
        <div class="mt-2">
            <input :value="modelValue" @input="updateValue" type="text" :name="id" :id="id" autocomplete="given-name" :class="[hasError ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : 'focus:ring-2 focus:ring-inset focus:ring-cyan-600 text-gray-900 ring-gray-300 placeholder:text-gray-400', 'block w-full px-3 rounded-md border py-1.5 shadow-sm ring-1 ring-inset sm:text-sm sm:leading-6']" />
        </div>
        <div class="text-xs text-red-600 dark:text-red-500" v-show="hasError" v-html="errorMessage" />
    </div>
</template>

<script>

export default{
    name:'normal-input',
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
            default: 'normal-input'
        },
        hasError:{
            type: Boolean,
            default: false
        },
        errorMessage:{
            type: String,
            default: ''
        },
    },
}

</script>