<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-1000">
      <TransitionChild as="template" enter="duration-100 ease-out" enter-from="opacity-0" enter-to="opacity-100"
        leave="duration-100 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black backdrop-filter backdrop-blur-sm bg-opacity-75" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-200 ease-out" enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel :class="modalWidth"
              class="w-full transform overflow-hidden rounded-xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-xl font-bold leading-6 text-gray-900 ">
                {{ dialogTitle }}
              </DialogTitle>

              <div class="mt-2" :class="modalHeight">
                <!-- <hr class="my-2"> -->
                <p class="text-sm text-gray-900">
                  <slot name="dialogBody"></slot>
                </p>
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
export default {
  props: {
    isOpen: {
      type: Boolean,
      default: true
    },
    dialogTitle: {
      type: String,
      default: 'Title'
    },
    modalWidth: {
      type: String,
      default: 'max-w-2xl'
    },
    modalHeight: {
      type: String,
      default: ''
    },


  },
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  }

}

</script>