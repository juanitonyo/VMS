<template>
    <TransitionRoot as="template" :show="setOpen">
      <Dialog as="div" class="relative z-10 font-poppins" @close="setOpen">
        <div class="fixed inset-0 bg-black bg-opacity-50 " />
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-400 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-400 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                <DialogPanel class="pointer-events-auto w-screen max-w-md">
                  <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl rounded-l-md">
                    <div class="bg-gray-700 py-6 px-4 sm:px-6 rounded-tl-md">
                      <div class="flex items-center justify-between">
                        <DialogTitle class="text-base font-semibold leading-6 text-white">{{ title }}</DialogTitle>
                        <div class="ml-3 flex h-7 items-center">
                          <button type="button" class="rounded-md bg-gray-700 text-gray-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" @click="setOpen = false">
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                          </button>
                        </div>
                      </div>
                      <div class="mt-1">
                        <p class="text-sm text-gray-200">{{ description }}</p>
                      </div>
                    </div>
                    <slot name="slider-body"></slot>
                    
                  </div>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
<script>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
export default {
  props: {
    setOpen: {
      type: Boolean,
      default: 'false',
    },
    title: {
      type: String,
      default: 'Slider Title',
    },
    description: {
      type: String,
      default: 'A very awesome description',
    },
    buttonTitle: {
      type: String,
      default: 'Submit',
    },

  },
  components: {
    Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, XMarkIcon
  },
  data() {

        },
        methods:{
          
        }

}
</script>