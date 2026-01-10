<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { AlertTriangle } from 'lucide-vue-next';
import { ref, watch } from 'vue';

interface Props {
    open: boolean;
    title?: string;
    message?: string;
    confirmText?: string;
    cancelText?: string;
    variant?: 'danger' | 'warning' | 'info';
}

const props = withDefaults(defineProps<Props>(), {
    title: 'Confirm Action',
    message: 'Are you sure you want to proceed?',
    confirmText: 'Confirm',
    cancelText: 'Cancel',
    variant: 'danger',
});

const emit = defineEmits<{
    confirm: [];
    cancel: [];
    'update:open': [value: boolean];
}>();

const isOpen = ref(props.open);

watch(
    () => props.open,
    (value) => {
        isOpen.value = value;
    },
);

const handleConfirm = () => {
    emit('confirm');
    close();
};

const handleCancel = () => {
    emit('cancel');
    close();
};

const close = () => {
    isOpen.value = false;
    emit('update:open', false);
};

const iconColor = () => {
    switch (props.variant) {
        case 'danger':
            return 'text-red-500';
        case 'warning':
            return 'text-yellow-500';
        case 'info':
            return 'text-blue-500';
        default:
            return 'text-red-500';
    }
};
</script>

<template>
    <!-- Backdrop -->
    <Transition
        enter-active-class="transition-opacity duration-200"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="isOpen"
            class="fixed inset-0 z-50 bg-black/50"
            @click="handleCancel"
        />
    </Transition>

    <!-- Dialog -->
    <Transition
        enter-active-class="transition-all duration-200"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition-all duration-200"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
    >
        <div
            v-if="isOpen"
            class="fixed top-1/2 left-1/2 z-50 w-full max-w-md -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-xl"
            role="dialog"
            aria-modal="true"
        >
            <!-- Icon -->
            <div class="mb-4 flex items-center justify-center">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100"
                >
                    <AlertTriangle :class="['h-6 w-6', iconColor()]" />
                </div>
            </div>

            <!-- Title -->
            <h3 class="mb-2 text-center text-lg font-semibold text-gray-900">
                {{ title }}
            </h3>

            <!-- Message -->
            <p class="mb-6 text-center text-sm text-gray-600">
                {{ message }}
            </p>

            <!-- Actions -->
            <div class="flex gap-3">
                <Button variant="outline" class="flex-1" @click="handleCancel">
                    {{ cancelText }}
                </Button>
                <Button
                    variant="destructive"
                    class="flex-1"
                    @click="handleConfirm"
                >
                    {{ confirmText }}
                </Button>
            </div>
        </div>
    </Transition>
</template>
