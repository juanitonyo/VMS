<template>
    <TransitionRoot appear as="template" :show="isOpen">
        <Dialog as="div" class="relative z-10" @close="isOpen = false">
            <TransitionChild as="template" enter="ease-out duration-800" enter-from="opacity-0" enter-to="opacity-100"
                leave="ease-in duration-800" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-screen items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="ease-out duration-800"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-800"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                            <div class="flex flex-col p-5 w-96">
                                <div class="flex items-center justify-center">
                                    <DialogTitle as="h3" class="text-lg font-bold leading-6 text-blue-800 ">
                                        {{ Title }}
                                    </DialogTitle>
                                </div>
                                <div class="mt-2">
                                    <slot name="body"></slot>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
  
<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
export default {
    props: {
        isOpen: {
            type: Boolean,
            default: true
        },
        Title: {
            type: String,
            default: ''
        }
    },
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        XMarkIcon
    }
}
</script>