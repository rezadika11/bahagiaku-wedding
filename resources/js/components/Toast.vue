<script setup lang="ts">
import { AlertCircle, CheckCircle, Info, XCircle } from 'lucide-vue-next';
import { computed, onMounted, ref } from 'vue';

export interface Toast {
    id: number;
    type: 'success' | 'error' | 'warning' | 'info';
    message: string;
}

const props = defineProps<{
    toast: Toast;
}>();

const emit = defineEmits<{
    remove: [id: number];
}>();

const show = ref(false);

const iconComponent = computed(() => {
    switch (props.toast.type) {
        case 'success':
            return CheckCircle;
        case 'error':
            return XCircle;
        case 'warning':
            return AlertCircle;
        case 'info':
            return Info;
        default:
            return Info;
    }
});

const iconColor = computed(() => {
    switch (props.toast.type) {
        case 'success':
            return 'text-teal-500';
        case 'error':
            return 'text-red-500';
        case 'warning':
            return 'text-yellow-500';
        case 'info':
            return 'text-blue-500';
        default:
            return 'text-blue-500';
    }
});

onMounted(() => {
    setTimeout(() => (show.value = true), 10);
    setTimeout(() => {
        show.value = false;
        setTimeout(() => emit('remove', props.toast.id), 300);
    }, 3000);
});
</script>

<template>
    <div
        :class="[
            'max-w-xs rounded-xl border border-gray-200 bg-white shadow-lg transition-all duration-300',
            show ? 'translate-x-0 opacity-100' : 'translate-x-full opacity-0',
        ]"
        role="alert"
    >
        <div class="flex p-4">
            <div class="shrink-0">
                <component
                    :is="iconComponent"
                    :class="['mt-0.5 size-4 shrink-0', iconColor]"
                />
            </div>
            <div class="ms-3">
                <p class="text-sm text-gray-700">
                    {{ toast.message }}
                </p>
            </div>
        </div>
    </div>
</template>
