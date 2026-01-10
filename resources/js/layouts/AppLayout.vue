<script setup lang="ts">
import ToastContainer from '@/components/ToastContainer.vue';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const toastRef = ref<InstanceType<typeof ToastContainer>>();

// Watch for flash messages
watch(
    () => page.props.flash,
    (flash: any) => {
        if (flash?.success) toastRef.value?.success(flash.success);
        if (flash?.error) toastRef.value?.error(flash.error);
        if (flash?.warning) toastRef.value?.warning(flash.warning);
        if (flash?.info) toastRef.value?.info(flash.info);
    },
    { deep: true },
);

// Check on mount for initial flash messages
onMounted(() => {
    const flash = page.props.flash as any;
    if (flash?.success) toastRef.value?.success(flash.success);
    if (flash?.error) toastRef.value?.error(flash.error);
    if (flash?.warning) toastRef.value?.warning(flash.warning);
    if (flash?.info) toastRef.value?.info(flash.info);
});
</script>

<template>
    <ToastContainer ref="toastRef" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>
