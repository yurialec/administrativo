<!-- src/components/LoadingOverlay.vue -->

<template>
    <div v-if="loading" class="loading-overlay d-flex flex-column justify-content-center align-items-center text-white"
        :class="{ 'loading-fullscreen': fullscreen }">
        <div class="spinner-border text-primary" role="status" :style="{ width: size, height: size }">
            <span class="visually-hidden"></span>
        </div>
    </div>
</template>

<script setup>
defineProps({
    loading: {
        type: Boolean,
        default: false
    },
    fullscreen: {
        type: Boolean,
        default: false
    },
    size: {
        type: String,
        default: '3rem'
    }
})
</script>

<style scoped>
.loading-overlay {
    position: absolute;
    inset: 0;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.45);
    transition: opacity 0.5s ease;
    backdrop-filter: blur(2px);
    border-radius: inherit;
}

.loading-fullscreen {
    position: fixed;
    z-index: 9999;
}
</style>