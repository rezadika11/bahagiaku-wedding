<script setup lang="ts">
import GuestFooter from '@/components/GuestFooter.vue';
import GuestNavbar from '@/components/GuestNavbar.vue';
import WhatsAppWidget from '@/components/WhatsAppWidget.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();
</script>

<template>
    <div class="min-h-screen bg-gray-50 text-gray-900 font-sans">
        <!-- Navbar -->
        <GuestNavbar />

        <slot />

        <!-- Footer -->
        <GuestFooter />

        <!-- WhatsApp Widget -->
        <WhatsAppWidget />
    </div>
</template>

<style scoped>
/* Custom scroll behavior if needed */
html {
    scroll-behavior: smooth;
}
</style>
