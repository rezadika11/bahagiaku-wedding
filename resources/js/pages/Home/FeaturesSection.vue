<template>
    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-teal-600 font-semibold tracking-wide uppercase">Fitur Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Segala yang Anda Butuhkan
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Fitur lengkap untuk memudahkan tamu undangan dan membuat momen spesialmu semakin berkesan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">RSVP & Ucapan</h3>
                    <p class="text-gray-600">Konfirmasi kehadiran tamu secara real-time dan terima ucapan doa dari mereka.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Peta Lokasi</h3>
                    <p class="text-gray-600">Integrasi Google Maps untuk memudahkan tamu menemukan lokasi acara.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 3-2 3-2zm0 0v-8"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Musik Latar</h3>
                    <p class="text-gray-600">Pilih lagu favoritmu untuk mengiringi undangan digital yang romantis.</p>
                </div>

                <!-- Feature 4 - NEW -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Beragam Pilihan Tema</h3>
                    <p class="text-gray-600">Pilih dari berbagai tema menarik yang sesuai dengan konsep pernikahan Anda.</p>
                </div>

                <!-- Feature 5 - NEW -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Undangan Tanpa Batas</h3>
                    <p class="text-gray-600">Kirim undangan ke sebanyak mungkin tamu tanpa batasan jumlah.</p>
                </div>

                <!-- Feature 6 - NEW -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kirim Undangan Instan</h3>
                    <p class="text-gray-600">Bagikan undangan langsung via WhatsApp, email, atau media sosial dalam sekejap.</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
// No additional imports needed for this component
</script>