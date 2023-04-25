<template>
    <div>
        <div class="w-32 h-32">
            <qrcode-stream @decode="onDecode" @init="onInit" />
        </div>
        <p class="error">{{ error }}</p>
        <p class="decode-result">Last result: <b>{{ result }}</b></p>

    </div>
</template>

<script>
import { QrcodeStream } from 'vue3-qrcode-reader'
export default {
    data() {
        return {
            result: '',
            error: ''
        }
    },

    components: {
        QrcodeStream
    },

    methods: {
        onDecode(result) {
            this.result = result
        },

        async onInit(promise) {
            try {
                await promise
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    this.error = "ERROR: you need to grant camera access permission"
                } else if (error.name === 'NotFoundError') {
                    this.error = "ERROR: no camera on this device"
                } else if (error.name === 'NotSupportedError') {
                    this.error = "ERROR: secure context required (HTTPS, localhost)"
                } else if (error.name === 'NotReadableError') {
                    this.error = "ERROR: is the camera already in use?"
                } else if (error.name === 'OverconstrainedError') {
                    this.error = "ERROR: installed cameras are not suitable"
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = "ERROR: Stream API is not supported in this browser"
                } else if (error.name === 'InsecureContextError') {
                    this.error = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
                } else {
                    this.error = `ERROR: Camera error (${error.name})`;
                }
            }
        }
    }
}

</script>