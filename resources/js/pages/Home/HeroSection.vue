<template>
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 right-0 -z-10 opacity-10">
            <svg width="800" height="800" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#14b8a6" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-5.3C93.5,8.6,82.2,21.5,71.1,32.8C60,44.1,49.1,53.8,37.3,61.8C25.5,69.8,12.8,76.1,-0.5,77C-13.8,77.9,-27.6,73.4,-40.3,65.9C-53,58.4,-64.6,47.9,-73.3,35.2C-82,22.5,-87.8,7.6,-86.3,-6.7C-84.8,-21,-76,-34.7,-65.4,-45.6C-54.8,-56.5,-42.4,-64.6,-29.4,-72.4C-16.4,-80.2,-2.8,-87.7,9.8,-85.8L22.4,-84Z" transform="translate(100 100)" />
            </svg>
        </div>
        <div class="absolute bottom-0 left-0 -z-10 opacity-10">
            <svg width="600" height="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#14b8a6" d="M41.5,-71.3C54.6,-64.6,66.6,-56.2,76.5,-45.6C86.4,-35,94.2,-22.2,93.6,-9.6C93,3,84,15.4,74.5,26.4C65,37.4,55,47,43.9,55.3C32.8,63.6,20.6,70.6,7.6,72.1C-5.4,73.6,-19.2,69.6,-31.8,62.8C-44.4,56,-55.8,46.4,-64.4,34.8C-73,23.2,-78.8,9.6,-78.1,-3.7C-77.4,-17,-70.2,-30,-60.6,-40.8C-51,-51.6,-39,-60.2,-26.8,-67.4C-14.6,-74.6,-2.2,-80.4,9.6,-78.1L21.4,-75.8Z" transform="translate(100 100)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 border border-teal-100 text-teal-600 text-sm font-medium mb-6">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                    </span>
                    Platform Undangan Digital #1 di Indonesia
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                    Bagikan Momen Bahagiamu dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-teal-700">Elegan & Modern</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                    Buat undangan pernikahan digital impianmu dalam hitungan menit. Desain premium, fitur lengkap, dan harga terjangkau.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Button size="lg" as-child class="bg-teal-600 hover:bg-teal-700 text-white rounded-full shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:-translate-y-1 px-8 py-4 text-lg">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20membuat%20undangan%20digital" target="_blank" rel="noopener noreferrer">Buat Undangan Sekarang</a>
                    </Button>
                    <Button size="lg" variant="outline" as-child class="rounded-full text-teal-700 bg-teal-50 hover:bg-teal-100 border-teal-200 hover:-translate-y-1 px-8 py-4 text-lg">
                        <a href="#themes">Lihat Contoh Tema</a>
                    </Button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
</script>