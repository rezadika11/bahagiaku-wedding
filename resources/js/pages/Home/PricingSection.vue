<template>
    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-teal-600 font-semibold tracking-wide uppercase">Paket Harga</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Pilih Paket Sesuai Kebutuhan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Basic -->
                <div class="border border-gray-200 rounded-2xl p-8 hover:border-teal-500 transition-colors relative">
                    <h3 class="text-xl font-bold text-gray-900">Basic</h3>
                    <div class="mt-4 flex items-baseline text-gray-900">
                        <span class="text-4xl font-extrabold tracking-tight">Rp 99rb</span>
                    </div>
                    <p class="mt-2 text-gray-500">Untuk acara sederhana.</p>

                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Masa aktif 3 bulan
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            3 Pilihan Tema
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            RSVP & Ucapan
                        </li>
                    </ul>
                    <Button as-child class="mt-8 w-full bg-teal-50 text-teal-700 hover:bg-teal-100">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20paket%20Basic" target="_blank" rel="noopener noreferrer">Pilih Basic</a>
                    </Button>
                </div>

                <!-- Premium -->
                <div class="border-2 border-teal-500 rounded-2xl p-8 relative shadow-xl transform scale-105 bg-white z-10">
                    <Badge class="absolute top-0 right-0 bg-teal-500 text-white rounded-bl-lg rounded-tr-lg">POPULAR</Badge>
                    <h3 class="text-xl font-bold text-gray-900">Premium</h3>
                    <div class="mt-4 flex items-baseline text-gray-900">
                        <span class="text-4xl font-extrabold tracking-tight">Rp 149rb</span>
                    </div>
                    <p class="mt-2 text-gray-500">Fitur lengkap, desain terbaik.</p>

                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Masa aktif 6 bulan
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Semua Pilihan Tema
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Musik Latar Custom
                        </li>
                         <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Galeri Foto Unlimited
                        </li>
                    </ul>
                    <Button as-child class="mt-8 w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white hover:from-teal-600 hover:to-teal-700 shadow-lg shadow-teal-500/30">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20paket%20Premium" target="_blank" rel="noopener noreferrer">Pilih Premium</a>
                    </Button>
                </div>

                <!-- Exclusive -->
                <div class="border border-gray-200 rounded-2xl p-8 hover:border-teal-500 transition-colors">
                    <h3 class="text-xl font-bold text-gray-900">Exclusive</h3>
                    <div class="mt-4 flex items-baseline text-gray-900">
                        <span class="text-4xl font-extrabold tracking-tight">Rp 249rb</span>
                    </div>
                    <p class="mt-2 text-gray-500">Layanan prioritas VIP.</p>

                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Masa aktif Selamanya
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Custom Domain (.com)
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Prioritas Support
                        </li>
                    </ul>
                    <Button as-child class="mt-8 w-full bg-teal-50 text-teal-700 hover:bg-teal-100">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20pesan%20paket%20Exclusive" target="_blank" rel="noopener noreferrer">Pilih Exclusive</a>
                    </Button>
                </div>
            </div>
         </div>
    </section>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
</script>