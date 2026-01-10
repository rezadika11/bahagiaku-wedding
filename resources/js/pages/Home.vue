<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import FeaturesSection from './Home/FeaturesSection.vue';
import HeroSection from './Home/HeroSection.vue';
import PricingSection from './Home/PricingSection.vue';
import TestimonialsSection from './Home/TestimonialsSection.vue';
import ThemesSection from './Home/ThemesSection.vue';

defineProps<{
    canLogin?: boolean;
}>();
</script>

<template>
    <Head title="Wedding Invitations" />

    <GuestLayout :can-login="canLogin">
        <HeroSection />
        <FeaturesSection />
        <ThemesSection />
        <PricingSection />
        <TestimonialsSection />
    </GuestLayout>
</template>
