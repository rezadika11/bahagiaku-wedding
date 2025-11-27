<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/layouts/GuestLayout.vue';
import HeroSection from './Home/HeroSection.vue';
import FeaturesSection from './Home/FeaturesSection.vue';
import ThemesSection from './Home/ThemesSection.vue';
import PricingSection from './Home/PricingSection.vue';
import TestimonialsSection from './Home/TestimonialsSection.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="Wedding Invitations" />

    <GuestLayout :can-login="canLogin" :can-register="canRegister">
        <HeroSection />
        <FeaturesSection />
        <ThemesSection />
        <PricingSection />
        <TestimonialsSection />
    </GuestLayout>
</template>