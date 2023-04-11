<template>
    <div class="sm:col-span-3">
        <label :for="id" class="block text-sm font-medium leading-6 text-gray-900">{{ label }}</label>
            <VueMultiselect
                v-model="option"
                @select="onSelect"
                :options="options"
                :name="id" 
                :id="id" 
                autocomplete="given-name"
                :close-on-select="true"
                :clear-on-select="false"
                :placeholder="placeholder"
                :class="[hasError ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : 'focus:ring-2 focus:ring-inset focus:ring-cyan-600 text-gray-900 ring-gray-300 placeholder:text-gray-400']"
            />
        <div class="text-xs text-red-600 dark:text-red-500" v-show="hasError" v-html="errorMessage" />
    </div>
</template>

<script>

import VueMultiselect from 'vue-multiselect';

export default{
    components:{
        VueMultiselect
    },
    name:'drop-down',
    data() {
        return {
            selectedOptions: [],
        }
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
        errorMessage:{
            type: String,
            default: ''
        },
        options: {
            type: Array,
            required: true
        },
        placeholder: {
            type: String,
            default: ''
        }
    },
    methods: {
        onSelect(selectedOptions) {
            this.$emit('selectedOption', selectedOptions);
        }
    }
}
</script>