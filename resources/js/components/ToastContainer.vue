<script setup lang="ts">
import { ref } from 'vue';
import Toast, { type Toast as ToastType } from './Toast.vue';

const toasts = ref<ToastType[]>([]);
let nextId = 1;

const addToast = (type: ToastType['type'], message: string) => {
    const id = nextId++;
    toasts.value.push({ id, type, message });
};

const removeToast = (id: number) => {
    const index = toasts.value.findIndex((t) => t.id === id);
    if (index > -1) {
        toasts.value.splice(index, 1);
    }
};

defineExpose({
    success: (message: string) => addToast('success', message),
    error: (message: string) => addToast('error', message),
    warning: (message: string) => addToast('warning', message),
    info: (message: string) => addToast('info', message),
});
</script>

<template>
    <div
        class="pointer-events-none fixed top-4 right-4 z-50 flex flex-col gap-2"
    >
        <Toast
            v-for="toast in toasts"
            :key="toast.id"
            :toast="toast"
            @remove="removeToast"
            class="pointer-events-auto"
        />
    </div>
</template>
