<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { Button } from '@/components/ui/button';

const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 10;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <nav 
        :class="[
            'fixed w-full z-50 transition-all duration-300',
            isScrolled ? 'bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm' : ''
        ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-8 h-8 bg-teal-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        B
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Bahagiaku</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-teal-600 transition-colors font-medium">Fitur</a>
                    <a href="#themes" class="text-gray-700 hover:text-teal-600 transition-colors font-medium">Tema</a>
                    <a href="#pricing" class="text-gray-700 hover:text-teal-600 transition-colors font-medium">Harga</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-teal-600 transition-colors font-medium">Testimoni</a>
                </div>
                <div class="flex items-center gap-4">
                    <Button as-child class="bg-teal-500 hover:bg-teal-600 text-white rounded-full shadow-lg shadow-teal-500/30 hover:shadow-teal-500/40">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20membuat%20undangan%20digital" target="_blank" rel="noopener noreferrer">
                            Buat Undangan
                        </a>
                    </Button>
                </div>
            </div>
        </div>
    </nav>
</template>
